<?php

namespace App\Http\Controllers;

use App\Models\Locacao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Http\Repositories\LocacaoRepository;

class LocacaoController extends Controller
{
    public function __construct(Locacao $locacao) {
        $this->locacao = $locacao;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $locacaoRepository = new LocacaoRepository($this->locacao);

        if($request->has('filtro')){
            $locacaoRepository->filtro($request->filtro);
        }

        if($request->has('atributos')){
            $locacaoRepository->selectAtributos($request->atributos);
        }
        //$locacao = DB::select('call listLocacoes()');
        //http://localhost:8000/api/marca?atributos=id,nome,imagem&atributos_modelo=id, marca_id,nome,imagem&filtro=nome:=:Ford
        return response()->json($locacaoRepository->getResultado(), 201);
        //return response()->json($locacao, 201);
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
     * @param  \App\Http\Requests\StoreLocacaoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate($this->locacao->rules(), $this->locacao->feedback());

        /*$locacao = $this->locacao->create([
            'cliente_id' => $request->cliente_id,
            'carro_id' => $request->carro_id,
            'data_inicio_periodo' => $request->data_inicio_periodo,
            'data_final_previsto_periodo' => $request->data_final_previsto_periodo,
            //'data_final_realizado_periodo' => $request->data_final_realizado_periodo,
            'valor_diaria' => $request->valor_diaria,
            'km_inicial' => $request->km_inicial,
            //'km_final' => $request->km_final,
        ]);*/

        $locacao = DB::select('call addLocacao(?,?,?,?,?,?)' ,[
            $request->cliente_id,
            $request->carro_id,
            $request->data_inicio_periodo,
            $request->data_final_previsto_periodo, 
            $request->valor_diaria,
            $request->km_inicial
        ]);
        /*$locacao = DB::select("call addLocacao(
                $request->cliente_id,
                $request->carro_id,
                $request->data_inicio_periodo,
                $request->data_final_previsto_periodo, 
                $request->valor_diaria,
                $request->km_inicial
            );"
        );*/
        
        return response()->json($locacao, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Locacao  $locacao
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $locacao = $this->locacao->find($id);
        if($locacao === null) {
            return response()->json(['erro' => 'Recurso pesquisado não existe'], 404) ;
        } 

        return response()->json($locacao, 201);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Locacao  $locacao
     * @return \Illuminate\Http\Response
     */
    public function edit(Locacao $locacao)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateLocacaoRequest  $request
     * @param  \App\Models\Locacao  $locacao
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $locacao = $this->locacao->find($id);

        if($locacao === null) {
            return response()->json(['erro' => 'Impossível realizar a atualização. O recurso solicitado não existe'], 404);
        }

        if($request->method() === 'PATCH') {

            $regrasDinamicas = array();

            foreach($locacao->rules() as $input => $regra) {
                if(array_key_exists($input, $request->all())) {
                    $regrasDinamicas[$input] = $regra;
                }
            }

            $request->validate($regrasDinamicas, $locacao->feedback());

        } else {
            $request->validate($locacao->rules(), $locacao->feedback());
        }

        $locacao->update([
            'cliente_id' => $request->cliente_id??$locacao->cliente_id,
            'carro_id' => $request->carro_id??$locacao->carro_id,
            'data_inicio_periodo' => $request->data_inicio_periodo??$locacao->data_inicio_periodo,
            'data_final_previsto_periodo' => $request->data_final_previsto_periodo??$locacao->data_final_previsto_periodo,
            'data_final_realizado_periodo' => $request->data_final_realizado_periodo??$locacao->data_final_realizado_periodo,
            'valor_diaria' => $request->valor_diaria??$locacao->valor_diaria,
            'km_inicial' => $request->km_inicial??$locacao->km_inicial,
            'km_final' => $request->km_final??$locacao->km_final,
        ]);

        return response()->json($locacao, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Locacao  $locacao
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $locacao = $this->locacao->find($id);

        if($locacao === null) {
            return response()->json(['erro' => 'Impossível realizar a exclusão. O recurso solicitado não existe'], 404);
        }

        $locacao->delete();
        return response()->json(['msg' => 'A Locação foi removida com sucesso!'], 200);
    }

    public function endLocacao(Request $request)
    {
        $locacao = $this->locacao->find($request->id);

        if($locacao === null) {
            return response()->json(['erro' => 'Impossível realizar a atualização. O recurso solicitado não existe'], 404);
        }

        if($request->method() === 'PATCH') {

            $regrasDinamicas = array();

            foreach($locacao->rules() as $input => $regra) {
                if(array_key_exists($input, $request->all())) {
                    $regrasDinamicas[$input] = $regra;
                }
            }

            $request->validate($regrasDinamicas, $locacao->feedback());

        } else {
            $request->validate($locacao->rules(), $locacao->feedback());
        }

        $locacao = DB::select('call encerrarLocacao(?, ?, ?);' ,[
            $request->id,
            $request->data_final_realizado_periodo, 
            $request->km_final
        ]);

        return response()->json($locacao, 200);
    }
}
