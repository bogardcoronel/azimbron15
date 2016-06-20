<?php

namespace azimbron15\Http\Controllers;

use azimbron15\Models\Estatus;
use azimbron15\Models\PagoRealizado;
use azimbron15\Models\Pagos;
use Carbon\Carbon;
use Illuminate\Http\Request;

use azimbron15\Http\Requests;
use Illuminate\Support\Facades\Auth;
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
            'concepto' => 'required|min:5',
            'fechaDePago' => 'required|date_format:d/m/Y',
            'pagosPendientes' => 'required',
            'evidencia' => 'required|max:10000|mimes:jpeg,png',
        ];

        $input = Input::only(
            'concepto',
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

        $pagoRealizado = new PagoRealizado();
        $pagoRealizado->descripcion_pago = $request->input('concepto');
        $pagoRealizado->cantidad_pagada = $request->input('cantidad');
        $pagoRealizado->fecha_reporte_pago = Carbon::now();
        $pagoRealizado->fecha_de_pago = Carbon::createFromFormat('d/m/Y', $request->input('fechaDePago'));
        $pagoRealizado->condominio_id = $condominio;
        $pagoRealizado->estatus_id = $estatus->id;
        $pagoRealizado->evidencia = $request->input('evidencia');
        $pagoRealizado->created_at = Carbon::now();

        if($request->hasFile('evidencia')) {
            $file = $request->file('evidencia');

            $pagosReportados = $request->input('pagosPendientes');
            foreach ($pagosReportados as $pagoReportado) {
                $pagos = Pagos::find($pagoReportado);
                $pagos->pagosConceptos()->firstOrCreate([
                    'descripcion_pago' => $request->input('concepto'),
                    'cantidad_pagada' => $request->input('cantidad'),
                    'fecha_reporte_pago' => Carbon::now(),
                    'fecha_de_pago' => Carbon::createFromFormat('d/m/Y', $request->input('fechaDePago')),
                    'condominio_id' => $condominio,
                    'estatus_id' => $estatus->id,
                    'evidencia' => base64_encode(file_get_contents($file->getRealPath())),
                    'nombre_archivo' => $file->getClientOriginalName(),
                    'mime' => $file->getMimeType(),
                    'tamanho_archivo' => $file->getSize(),
                    'created_at' => Carbon::now()
                ]);
            }

            \Session::flash('success', 'Pago realizado exitosamente.');

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
