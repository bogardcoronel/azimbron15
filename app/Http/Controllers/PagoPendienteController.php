<?php

namespace azimbron15\Http\Controllers;

use azimbron15\Models\Pagos;
use Illuminate\Http\Request;

use azimbron15\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PagoPendienteController extends Controller
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

    public function pagoPendienteDeptos()
    {
        $deptosDeudores = $this->deptosDeudores();
        $pagosPendientes = array();
            foreach ($deptosDeudores as $deptoDeudor) {
                $pagoPendiente = $this->pagosPendientes($deptoDeudor->id);
                foreach ($pagoPendiente as $pagoPend) {
                    $pagoPend->depto = $deptoDeudor->departamento;
                }
                $pagosPendientes = array_merge($pagosPendientes, $pagoPendiente);
            }
        return view('pagosPendientes.pagoPendienteDeptos', compact('pagosPendientes'));
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $condominio = Auth::user()->condominio->id;
        $pagosPendientes = $this->pagosPendientes($condominio);
        return view('pagosPendientes.index', compact('pagosPendientes'));
    }

    public function deptosDeudores(){
        $deptos = DB::table('condominios')->leftJoin('pagos_realizados', 'condominios.id', '=', 'pagos_realizados.condominio_id')
            ->leftJoin('pagos_conceptos', 'pagos_realizados.id', '=', 'pagos_conceptos.pagos_realizados_id')
            ->leftJoin('pagos', 'pagos_conceptos.pagos_id', '=', 'pagos.id')
            ->whereNull('pagos_realizados.condominio_id')->get();
        return $deptos;
    }

    public function pagosPendientes($condominio){
        $pagosRealizados = DB::table('pagos')->leftJoin('pagos_conceptos', 'pagos.id', '=', 'pagos_conceptos.pagos_id')
            ->leftJoin('pagos_realizados', 'pagos_realizados.id', '=', 'pagos_conceptos.pagos_realizados_id')
            ->where('pagos_realizados.condominio_id', '=', $condominio)->pluck('pagos.id');

        $pagosPendientes = DB::table('pagos')->leftJoin('pagos_conceptos', 'pagos.id', '=', 'pagos_conceptos.pagos_id')
            ->leftJoin('pagos_realizados', 'pagos_realizados.id', '=', 'pagos_conceptos.pagos_realizados_id')
            ->whereNotIn('pagos.id',$pagosRealizados)->where('pagos.opcional','=','false')->get();
        return $pagosPendientes;
    }

    public function pagosPendientesSelect($condominio){
        $pagosRealizados = DB::table('pagos')->leftJoin('pagos_conceptos', 'pagos.id', '=', 'pagos_conceptos.pagos_id')
            ->leftJoin('pagos_realizados', 'pagos_realizados.id', '=', 'pagos_conceptos.pagos_realizados_id')
            ->where('pagos_realizados.condominio_id', '=', $condominio)->pluck('pagos.id');

        $pagosPendientes = DB::table('pagos')->leftJoin('pagos_conceptos', 'pagos.id', '=', 'pagos_conceptos.pagos_id')
            ->leftJoin('pagos_realizados', 'pagos_realizados.id', '=', 'pagos_conceptos.pagos_realizados_id')
            ->whereNotIn('pagos.id',$pagosRealizados)->pluck('pagos.concepto','pagos.id');
        return $pagosPendientes;
    }
    
}
