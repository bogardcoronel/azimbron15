<?php

namespace azimbron15\Http\Controllers;

use azimbron15\Models\Evidencia;
use Illuminate\Http\Request;

use azimbron15\Http\Requests;
use Illuminate\Support\Facades\Response;

class EvidenciaController extends Controller
{

    public function getImageEvidencia($id){
        $evidencia = Evidencia::find($id);
        $response = Response::make(base64_decode($evidencia->evidencia), 200);
        $response->header('Content-Type', $evidencia->mime);
        return $response;
    }
}
