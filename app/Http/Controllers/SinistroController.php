<?php

namespace App\Http\Controllers;

use App\Models\Sinistro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SinistroController extends Controller
{
    public function store(Request $request)
    {
        //$request->validate($this->locacao->rules(), $this->locacao->feedback());

        $sinistro = DB::select('call registrarSinistro(?,?,?,?,?)' ,[
            $request->locacao_id,
            $request->motivoCausa,
            $request->localidade,
            $request->dataHora, 
            $request->km
        ]);
        
        return response()->json($sinistro, 201);
    }
}
