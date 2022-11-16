<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modelo extends Model
{
    use HasFactory;
    protected $fillable = ['marca_id', 'nome', 'imagem', 'numero_portas', 'lugares', 'air_bag', 'abs'];

    public function marca(){
        return $this->belongsTo('App\Models\Marca');
    }

    public function rules(){
        return [
            'marca_id' => 'required|exists:marcas,id',
            'nome' => 'required|min:3',
            'imagem' => 'required|image|mimes:png|max:2048',
            'numero_portas' => 'required|integer|digits_between:1,5',
            'lugares' => 'required|integer|digits_between:1,20',
            'air_bag' => 'required|boolean',
            'abs' => 'required|boolean'
        ];
    }

    public function feedback(){
        return [
            'required' => 'O campo :attribute é obrigatório',
            'exists' => 'A marca não existe',
            'unique' => 'O nome do modelo já existe',
            'nome.mim' => 'O nome deve ter no mínimo 3 caracteres',
            'image' => 'O arquivo não é uma imagem',
            'mimes' => 'O formato de imagem não é aceito. O arquivo precisa ter o formato .png',
            'max' => 'Arquivo muito grande. O arquivo precisa ter o tamanho máximo e 2048',
            'integer' => 'O valor do campo precisa ser do tipo inteiro',
            'numero_portas.digits_between' => 'O número de portas precisa estar entre 1 e 5',
            'lugares.digits_between' => 'O número de lugaress precisa estar entre 1 e 20',
            //'boolean' => 'O valor do campo precisa ser do tipo boolean'
        ];
    }
}
