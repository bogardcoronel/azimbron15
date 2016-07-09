<?php

namespace azimbron15\Http\Controllers;

use azimbron15\Events\PagoAprobadoEvent;
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
use Illuminate\Support\Facades\Validator;
use Jenssegers\Date\Date;

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
        $estatus = Estatus::find(2); // Se coloca Estatus en revisión al hacer un pago

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
            $pagoRealizado->save();

            $evidencia = new Evidencia();
            $evidencia->evidencia = base64_encode(file_get_contents($file->getRealPath()));
            $evidencia->nombre_archivo = $file->getClientOriginalName();
            $evidencia->mime = $file->getMimeType();
            $evidencia->tamanho_archivo = $file->getSize();
            $evidencia->pagoRealizado()->associate($pagoRealizado);
            $evidencia->save();

            $pagoRealizado->pagosConceptos()->sync($pagosReportadosInstances);




            \Session::flash('success', 'Pago realizado exitosamente.');

            //Dispara un evento al realizar el pago
            Event::fire(new PagoRealizadoEvent($pagoRealizado, $file->getRealPath(),$evidencia->mime, $evidencia->nombre_archivo ));

            return Redirect::to('pagosRealizados/create');
        }else{
            return Redirect::back()->withInput()->withErrors($validator);
        }
    }
    
    public function approve($id){
        $pagoRealizado = PagoRealizado::find($id);
        $estatus = Estatus::find(1); //Estatus aprobado
        $pagoRealizado->estatus_id =$estatus->id;
        $pagoRealizado->save();
        \Session::flash('success','El pago del departamento '.$pagoRealizado->condominio->departamento.' con fecha  de pago '.Date::parse($pagoRealizado->fecha_de_pago)->format('l j F Y') .' ha sido aprobado.');

        //Dispara un evento al aprobar el pago
        Event::fire(new PagoAprobadoEvent($pagoRealizado));
        
        return Redirect::to('pagosRealizados/index');
    }

    public function show($id){
        if(Auth::user()->is("Administrador")) {
            $pagoRealizado = PagoRealizado::find($id);
            return view('pagosRealizados.show', compact('pagoRealizado'));
        }else if(Auth::user()->is("Condomino")){
            $condominio = Auth::user()->condominio->id;
            $pagoRealizado = PagoRealizado::where('condominio_id','=',$condominio)->where('id','=',$id)->first();
            if($pagoRealizado) {
                return view('pagosRealizados.show', compact('pagoRealizado'));
            }else{
                return abort(403, 'Unauthorized action.');
            }
        }else{
            return abort(403, 'Unauthorized action.');
        }
    }
}
