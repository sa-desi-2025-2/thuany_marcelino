<?php
class Usuario {

    public $id;
    public $nome;
    public $email;
    public $nome_usuario;
    public $senha;
    public $tipo_acesso;
    public $status_acesso;
    public $id_linha;
    public $conexao;


    public function __construct($nome, $email, $nome_usuario, $tipo_acesso, $status_acesso) {
        $this->nome = $nome;
        $this->email = $email;
        $this->nome_usuario = $nome_usuario;
        $this->tipo_acesso = $tipo_acesso;
        $this->status_acesso = $status_acesso;
        
    }

    public function buscarUsuarios(){
        $this->conexao = new Conexao();
        $consulta = $this->conexao->prepare("SELECT id_usuario, nome, nome_usuario, email, tipo_acesso, status_acesso FROM usuario");      
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }
}