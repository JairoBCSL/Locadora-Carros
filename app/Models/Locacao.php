<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Locacao extends Model
{
    use HasFactory;
    protected $table = 'locacoes';
    protected $fillable = [
        'cliente_id',
        'carro_id',
        'data_inicio_periodo',
        'data_final_previsto_periodo',
        'data_final_realizado_periodo',
        'valor_diaria',
        'km_inicial',
        'km_final',
    ];

    public function rules(){
        return[
            'cliente_id' => 'required|exists:clientes,id',
            'carro_id' => 'required|exists:carros,id',
            'data_inicio_periodo' => 'required|date',
            'data_final_previsto_periodo' => 'required|date',
            'data_final_realizado_periodo' => 'date',
            'valor_diaria' => 'required|numeric',
            'km_inicial' => 'required|integer',
            'km_final' => 'integer',
        ];
    }

    public function feedback(){
        return[
            'required' => 'O campo :attribute é obrigatório',
            'exists' => 'O registro não existe',
            'date' => 'Formato de data inválido',
            'numeric' => 'O valor do campo precisa ser numérico',
            'integer' => 'O valor do campo precisa ser inteiro',
        ];
    }
}
