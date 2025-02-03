<?php
namespace Models;
use Core\Model;
class Categoria extends Model{
    protected $table = 'categorias';
    protected $columns = ['id',
                           'nome',
                          ];
    protected $__protected_delete = true;
    protected $__audit_date = true;
}