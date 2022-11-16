<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use App\Models\Modelo;
use App\Models\Carro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Repositories\MarcaRepository;

class MarcaController extends Controller
{
    public function __construct(Marca $marca) {
        $this->marca = $marca;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $marcaRepository = new MarcaRepository($this->marca);

        if($request->has('atributos_modelos')){
            $atributos_modelos = 'modelos:id,'.$request->atributos_modelos;
            $marcaRepository->selectAtributosRegistrosRelacionados($atributos_modelos);
        }else{
            $marcaRepository->selectAtributosRegistrosRelacionados('modelos');
        }

        if($request->has('filtro')){
            $marcaRepository->filtro($request->filtro);
        }

        if($request->has('atributos')){
            $marcaRepository->selectAtributos($request->atributos);
        }
        //http://localhost:8000/api/marca?atributos=id,nome,imagem&atributos_modelo=id, marca_id,nome,imagem&filtro=nome:=:Ford
        return response()->json($marcaRepository->getResultado(), 201);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){

        $request->validate($this->marca->rules(), $this->marca->feedback());

        $imagem = $request->file('imagem');
        $urn = $imagem->store('imagens/marcas', 'public');

        $marca = $this->marca->create([
            'nome' => $request->nome,
            'imagem' => $urn
        ]);

        return response()->json($marca, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  Integer
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $marca = $this->marca->with('modelos')->find($id);
        if($marca === null) {
            return response()->json(['error' => 'Recurso pesquisado não existe'], 404) ;
        } 

        return response()->json($marca, 201);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Marca  $marca
     * @return \Illuminate\Http\Response
     */
    public function edit(Marca $marca)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Integer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $marca = $this->marca->find($id);

        if($marca === null) {
            return response()->json(['error' => 'Impossível realizar a atualização. O recurso solicitado não existe'], 404);
        }

        if($request->method() === 'PATCH') {

            $regrasDinamicas = array();

            //percorrendo todas as regras definidas no Model
            foreach($marca->rules() as $input => $regra) {
                
                //coletar apenas as regras aplicáveis aos parâmetros parciais da requisição PATCH
                if(array_key_exists($input, $request->all())) {
                    $regrasDinamicas[$input] = $regra;
                }
            }

            $request->validate($regrasDinamicas, $marca->feedback());

        } else {
            $request->validate($marca->rules(), $marca->feedback());
        }

        if($request->file('imagem')){
            Storage::disk('public')->delete($marca->imagem);
            $imagem = $request->file('imagem');
            $urn = $imagem->store('imagens/marcas', 'public');
        }

        $marca->update([
            'nome' => $request->nome,
            'imagem' => $urn??$marca->imagem
        ]);

        return response()->json($marca, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Integer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $marca = $this->marca->find($id);

        if($marca === null) {
            return response()->json(['error' => 'Impossível realizar a exclusão. O recurso solicitado não existe'], 404);
        }

        $modelos = Modelo::all()->where('marca_id', $marca->id);
        $delete = true;
        foreach($modelos as $modelo){
            $carros = Carro::all()->where('modelo_id', $modelo->id);
            foreach($carros as $carro){
                $delete = $carro->delete() & $delete;
            }
            Storage::disk('public')->delete($modelo->imagem);
            $delete = $modelo->delete() & $delete;
        }

        Storage::disk('public')->delete($marca->imagem);

        $delete = $marca->delete() & $delete;
        return response()->json(['msg' => 'A marca foi removida com sucesso!'], 200);
        
    }
}
