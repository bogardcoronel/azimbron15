<?php

namespace azimbron15\Http\Controllers;

use azimbron15\Models\Pagos;
use Carbon\Carbon;
use Illuminate\Http\Request;

use azimbron15\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class PagosController extends Controller
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
        $pagos = Pagos::all();
        return view('pagos.index', compact('pagos'));
    }

    public function create()
    {
        return view('pagos.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'concepto' => 'required|min:5',
            'cantidad' => 'required|digits_between:1,6',
            'fecha_limite_pago' => 'required|date_format:d/m/Y',
        ];

        $input = Input::only(
            'concepto',
            'cantidad',
            'fecha_limite_pago'
        );

        $validator = Validator::make($input, $rules);

        if($validator->fails())
        {
            return Redirect::back()->withInput()->withErrors($validator);
        }else {

            Pagos::create([
                'concepto' => $request->input('concepto'),
                'cantidad' => $request->input('cantidad'),
                'fecha_limite_pago' => Carbon::createFromFormat('d/m/Y', $request->input('fecha_limite_pago')),
                'created_at' => Carbon::now()
            ]);

            \Session::flash('success', 'El pago ha sido registrado exitosamente');
        }

        return view('pagos.create');
    }
}
