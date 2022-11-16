<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sinistro extends Model
{
    use HasFactory;

    protected $fillable = ['locacao_id', 'motivoCausa', 'localidade', 'dataHora', 'km'];

    public function rules(){
        return[
            'locacao_id' => 'required|exists:clientes,id',
            'motivoCausa' => 'required|min:3|max:50',
            'dataHora' => 'required|date',
            'km' => 'required|integer',
        ];
    }

    public function feedback(){
        return[
            'required' => 'O campo :attribute é obrigatório',
            'date' => 'Formato de data inválido',
            'integer' => 'O valor do campo precisa ser inteiro',
            'min' => 'Tamanho mínimo para campo :attribute é 3 caracteres',
            'max' => 'Tamanho mínimo para campo :attribute é 50 caracteres',
        ];
    }
}
