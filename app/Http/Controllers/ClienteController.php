<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
//use App\Models\Locacao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Repositories\ClienteRepository;

class ClienteController extends Controller
{
    public function __construct(Cliente $cliente){
        $this->cliente = $cliente;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $clienteRepository = new ClienteRepository($this->cliente);

        if($request->has('filtro')){
            $clienteRepository->filtro($request->filtro);
        }

        if($request->has('atributos')){
            $clienteRepository->selectAtributos($request->atributos);
        }
        //http://localhost:8000/api/marca?atributos=id,nome,imagem&atributos_modelo=id, marca_id,nome,imagem&filtro=nome:=:Ford
        return response()->json($clienteRepository->getResultado(), 201);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreClienteRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate($this->cliente->rules(), $this->cliente->feedback());

        $cliente = $this->cliente->create([
            'nome' => $request->nome,
        ]);

        return response()->json($cliente, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cliente = $this->cliente->find($id);
        if($cliente === null) {
            return response()->json(['erro' => 'Recurso pesquisado não existe'], 404) ;
        } 

        return response()->json($cliente, 201);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function edit(Cliente $cliente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateClienteRequest  $request
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $cliente = $this->cliente->find($id);

        if($cliente === null) {
            return response()->json(['erro' => 'Impossível realizar a atualização. O recurso solicitado não existe'], 404);
        }

        if($request->method() === 'PATCH') {

            $regrasDinamicas = array();

            foreach($cliente->rules() as $input => $regra) {
                if(array_key_exists($input, $request->all())) {
                    $regrasDinamicas[$input] = $regra;
                }
            }

            $request->validate($regrasDinamicas, $cliente->feedback());

        } else {
            $request->validate($cliente->rules(), $cliente->feedback());
        }

        $cliente->update([
            'nome' => $request->nome??$carro->nome,
        ]);

        return response()->json($cliente, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cliente = $this->cliente->find($id);

        if($cliente === null) {
            return response()->json(['erro' => 'Impossível realizar a exclusão. O recurso solicitado não existe'], 404);
        }

        $delete = true;


        $cliente->delete();
        return response()->json(['msg' => 'O cliente foi removido com sucesso!'], 200);
    }
}
