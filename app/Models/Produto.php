<?php
namespace Models;
use Core\Model;
class Produto extends Model{
    protected $table = 'produtos';
    protected $columns = ['id',
                            'quantidade',
                           'nome',
                           'descricao',
                           'valor_un',
                           'unidade_medida',
                           'disponivel'];
    //PROTEGER CONTRA DELETAR NO BANCO DE DADOS, MAS PODE SER EXCLUÍDO NO SISTEMA.
    protected $__protected_delete = true;

    protected $__audit_date = true;
}