<?php
namespace Models;
use Core\Model;
class Cliente extends Model{
    protected $table = 'clientes';

    private $user;
    protected $columns = ['id',
                           'nome',
                           'apelido',
                           'data_nascimento',
                           'celular',
                           'telefone',
                           'cpf',
                           'rg',
                           'rg_expedidor',
                           'profissao',
                           'email',
                           'logradouro',
                           'numero',
                           'bairro',
                           'cidade',
                           'estado',
                           'cep',
                           'pais',
                           'obs',
                        ];

    protected $__protected_delete = true;

    protected $__audit_date = true;

}
    