<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;
    protected $fillable = ['nome'];

    public function rules(){
        return [
            'nome' => 'required|min:3|max:40',
        ];
    }

    public function feedback(){
        return [
            'required' => 'O campo :attribute é obrigatório',
            'min' => 'O nome precisa ter no mínimo 3 caracteres',
            'max' => 'O nome precisa ter no máximo 40 caracteres',
        ];
    }
}
