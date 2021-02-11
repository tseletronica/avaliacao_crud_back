<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuarios extends Model
{
     protected $fillable = [
        'name', 'email', 'senha','telefone','data_nascimento','cpf_cnpj, endereco'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'senha'];
}
