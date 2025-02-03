<?php
namespace Models;
use Core\Model;
class Fornecedor extends Model{
    protected $table = 'fornecedores';

    private $user;
    protected $columns = ['id',
                           'nome',
                           'nome_vendedor',
                           'email',
                           'telefone_empresa',
                           'celular_vendedor',
                           'descricao',
                           'cnpj_empresa'
                        ];

    protected $__protected_delete = true;

    protected $__audit_date = true;

}