<?php

namespace azimbron15\Http\Controllers;

use azimbron15\Events\PagoRealizadoEvent;
use azimbron15\Models\Estatus;
use azimbron15\Models\Evidencia;
use azimbron15\Models\PagoRealizado;
use azimbron15\Models\Pagos;
use Carbon\Carbon;
use Illuminate\Http\Request;

use azimbron15\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class PagoRealizadoController extends Controller
{


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->is("Administrador")){
            $pagosRealizados = PagoRealizado::All();
        }else{
            $condominio = Auth::user()->condominio->id;
            $pagosRealizados = PagoRealizado::where('condominio_id','=',$condominio)->get();
        }

        return view('pagosRealizados.index', compact('pagosRealizados'));
    }

    public function create()
    {
        $condominio = Auth::user()->condominio->id;
        $pagosPendientes = (new PagoPendienteController())->pagosPendientesSelect($condominio);
        return view('pagosRealizados.create',compact('pagosPendientes'));
    }

    public function store(Request $request)
    {
        $rules = [
            'fechaDePago' => 'required|date_format:d/m/Y',
            'pagosPendientes' => 'required',
            'evidencia' => 'required|max:10000|mimes:jpeg,png',
        ];

        $input = Input::only(
            'fechaDePago',
            'pagosPendientes',
            'evidencia'
        );

        $validator = Validator::make($input, $rules);

        if($validator->fails())
        {
            return Redirect::back()->withInput()->withErrors($validator);
        }


        $condominio = Auth::user()->condominio->id;
        $estatus = Estatus::find(2);

        if($request->hasFile('evidencia')) {
            $file = $request->file('evidencia');
            $pagosReportadosId = $request->input('pagosPendientes');
            $pagosReportadosInstances = Pagos::whereIn('id', $pagosReportadosId)->get();

            $pagoRealizado = new PagoRealizado();
            $pagoRealizado->cantidad_pagada = $request->input('cantidad');
            $pagoRealizado->fecha_reporte_pago = Carbon::now();
            $pagoRealizado->fecha_de_pago = Carbon::createFromFormat('d/m/Y', $request->input('fechaDePago'));
            $pagoRealizado->condominio_id = $condominio;
            $pagoRealizado->estatus_id = $estatus->id;
            $pagoRealizado->created_at = Carbon::now();
            $pagoRealizado->pagosConceptos()->attach($pagosReportadosInstances);
            $pagoRealizado->save();

            $evidencia = new Evidencia();
            $evidencia->evidencia = base64_encode(file_get_contents($file->getRealPath()));
            $evidencia->nombre_archivo = $file->getClientOriginalName();
            $evidencia->mime = $file->getMimeType();
            $evidencia->tamanho_archivo = $file->getSize();
            $evidencia->pagoRealizado()->associate($pagoRealizado);
            $evidencia->save();




            \Session::flash('success', 'Pago realizado exitosamente.');

            //Dispara un evento al realizar el pago
            Event::fire(new PagoRealizadoEvent($pagoRealizado));

            return Redirect::to('pagosRealizados/create');
        }else{
            return Redirect::back()->withInput()->withErrors($validator);
        }
    }
    
    public function getImageEvidencia($id){
        $pagoRealizado = PagoRealizado::find($id);
        $response = Response::make(base64_decode($pagoRealizado->evidencia), 200);
        $response->header('Content-Type', $pagoRealizado->mime);
        return $response;
    }
}
