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


    public function __construct($nome, $email, $nome_usuario) {
        $this->nome = $nome;
        $this->email = $email;
        $this->nome_usuario = $nome_usuario;
    }

    public function inserir(){
        $this->conexao = new Conexao();
        $consulta = $this->conexao->prepare("INSERT INTO usuario (nome, email, nome_usuario) VALUES(?,?,?)");      
        $consulta->execute([$this->nome, $this->email, $this->nome_usuario]);
    }
}