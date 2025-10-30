<?php
class Linha {

    public $id;
    public $nome_linha;
    public $id_usuario;
    public $conexao;


    public function __construct($id = null, $nome_linha = null, $id_usuario = null) {
        $this->id = $id;
        $this->nome_linha = $nome_linha;
        $this->id_usuario = $id_usuario;
    }

    public function select(){
        $this->conexao = new Conexao();
        $consulta = $this->conexao->prepare("SELECT id_linha, nome_linha, id_usuario FROM linha");   
        $consulta->execute();    
        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }
}