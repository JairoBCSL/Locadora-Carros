<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carro extends Model
{
    use HasFactory;
    protected $fillable = ['modelo_id', 'placa', 'disponivel', 'km'];

    public function modelo(){
        return $this->belongsTo('App\Models\Modelo');
    }

    public function rules(){
        return [
            'modelo_id' => 'required|exists:modelos,id',
            'placa' => 'required|unique:carros,id|min:7|max:7',
            'disponivel' => 'required|boolean',
            'km' => 'required|integer'
        ];
    }

    public function feedback(){
        return [
            'required' => 'O campo :attribute é obrigatório',
            'exists' => 'O modelo não existe',
            'placa.unique' => 'A placa já consta no banco de dados',
            'placa.min' => 'A placa precisa ter 7 caracteres',
            'placa.max' => 'A placa precisa ter 7 caracteres',
            'boolean' => 'O valor do campo precisa ser do tipo boolean',
            'integer' => 'O valor do campo precisa ser do tipo inteiro',
        ];
    }
}
