<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Modelo;

class Marca extends Model
{
    use HasFactory;
    protected $fillable = ['nome', 'imagem'];

    public function modelos(){
        return $this->hasMany('\App\Models\Modelo');
    }

    public function rules(){
        return [
            'nome' => 'required|unique:marcas,nome,'.$this->id.'|min:3',
            'imagem' => 'required|image|mimes:png|max:2048'
        ];

        /*
        tabela, coluna
        */
    }

    public function feedback(){
        return [
            'required' => 'O campo :attribute é obrigatório',
            'unique' => 'O nome da marca já existe',
            'nome.mim' => 'O nome deve ter no mínimo 3 caracteres',
            'image' => 'O arquivo não é uma imagem',
            'mimes' => 'O formato de imagem não é aceito. O arquivo precisa ter o formato .png',
            'max' => 'Arquivo muito grande. O arquivo precisa ter o tamanho máximo e 2048'
        ];
    }
}
