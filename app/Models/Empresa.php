<?php
namespace Models;
use Core\Model;
class Empresa extends Model{
    protected $table = 'empresas';

    private $user;
    protected $columns = ['id',
                           'razao_social',
                           'cnpj',
                           'telefone',
                           'celular',
                           'endereco_id',
                           'email',
                           'segmento',
                        ];
    protected $__protected_delete = true;

    protected $__audit_date = true;

    public function getUser(){
        if(!$this->user instanceof Usuario && $this->isStorage()){
            $usuario = new Usuario();
            $this->user = $usuario->where('empresas_id', '=', $this->id)->get();
        }
        return $this->user;
    }

    public function isUser(){
        return ($this->getUser() instanceof Usuario);
    }
    public function promoteUser(){
        $user = $this->getUser();
        if(!$user instanceof Usuario){
            $this->user = new Usuario();
        }
        $this->user->empresas_id = $this->id;
        $this->user->login = $this->cnpj;
        $this->user->save();
    }

    public static function getEmpresaByCNPJ($cnpj){
        $empresa = new Empresa();
        return $empresa->where('cnpj', '=', $cnpj)->get();
    }
}