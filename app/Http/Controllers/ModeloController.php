<?php

namespace App\Http\Controllers;

use App\Models\Carro;
use App\Models\Modelo;
use App\Models\Marca;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Repositories\ModeloRepository;

class ModeloController extends Controller
{

    public function __construct(Modelo $modelo){
        $this->modelo = $modelo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        $modeloRepository = new ModeloRepository($this->modelo);

        if($request->has('atributos_marca')){
            $atributos_marca = 'marca:id,'.$request->atributos_marca;
            $modeloRepository->selectAtributosRegistrosRelacionados($atributos_marca);
        }else{
            $modeloRepository->selectAtributosRegistrosRelacionados('marca');
        }

        if($request->has('filtro')){
            $modeloRepository->filtro($request->filtro);
        }

        if($request->has('atributos')){
            $modeloRepository->selectAtributos($request->atributos);
        }

        $marcas = Marca::all();
        
        //http://localhost:8000/api/modelo?atributos=nome,lugares,marca_id&atributos_marca=nome&filtro=nome:like:%Ka%;nome:like:%Sedan%
        return response()->json($modeloRepository->getResultado(), 201);
        
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
    public function store(Request $request)
    {
        //dd($request->all());
        $request->validate($this->modelo->rules(), $this->modelo->feedback());

        $imagem = $request->file('imagem');
        $urn = $imagem->store('imagens/modelos', 'public');

        $modelo = $this->modelo->create([
            'marca_id' => $request->get('marca_id'),
            'nome' => $request->get('nome'),
            'imagem' => $urn,
            'numero_portas' => $request->get('numero_portas'),
            'lugares' => $request->get('lugares'),
            'air_bag' => $request->get('air_bag'),
            'abs' => $request->get('abs'),
        ]);

        return response()->json($modelo, 201);

        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Modelo  $modelo
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $modelo = $this->modelo->with('marca')->find($id);
        if($modelo === null) {
            return response()->json(['erro' => 'Recurso pesquisado não existe'], 404) ;
        } 

        return response()->json($modelo, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Modelo  $modelo
     * @return \Illuminate\Http\Response
     */
    public function edit(Modelo $modelo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Modelo  $modelo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $modelo = $this->modelo->find($id);

        if($modelo === null) {
            return response()->json(['erro' => 'Impossível realizar a atualização. O recurso solicitado não existe'], 404);
        }

        if($request->method() === 'PATCH') {

            $regrasDinamicas = [];

            foreach($modelo->rules() as $input => $regra) {
                
                if(array_key_exists($input, $request->all())) {
                    $regrasDinamicas[$input] = $regra;
                }
            }
            
            $request->validate($regrasDinamicas, $modelo->feedback());

        } else {
            $request->validate($modelo->rules(), $modelo->feedback());
        }

        if($request->file('imagem')){
            Storage::disk('public')->delete($modelo->imagem);
            $imagem = $request->file('imagem');
            $urn = $imagem->store('imagens/modelos', 'public');
        }

        

        $modelo->update([
            'marca_id' => $request->get('marca_id')??$modelo->marca_id,
            'nome' => $request->get('nome')??$modelo->nome,
            'imagem' => $urn??$modelo->imagem,
            'numero_portas' => $request->get('numero_portas')??$modelo->numero_portas,
            'lugares' => $request->get('lugares')??$modelo->lugares,
            'air_bag' => $request->get('air_bag')??$modelo->air_bag,
            'abs' => $request->get('abs')??$modelo->abs,
        ]);

        return response()->json($modelo, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Modelo  $modelo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $modelo = $this->modelo->find($id);
        //print_r($modelo);

        if($modelo === null) {
            return response()->json(['error' => 'Impossível realizar a exclusão. O recurso solicitado não existe'], 404);
        }

        $carros = Carro::all()->where('modelo_id', $modelo->id);
        $delete = true;
        foreach ($carros as $carro) {
            $delete = $carro->delete() && $delete;
        }
        $delete = $modelo->delete() && $delete;
        if($delete){
            $msg = 'Registro deletado com sucesso';
        }else{
            $msg = 'Erro ao deletar registro';
        }   

        Storage::disk('public')->delete($modelo->imagem);

        $modelo->delete();
        return response()->json(['msg' => 'A marca foi removida com sucesso!'], 200);
    }
}
