<?php
class Maquina {

    public $id;
    public $nome_maquina;
    public $id_linha;
    public $conexao;


    public function __construct($id = null, $nome_maquina = null, $id_linha = null) {
        $this->id = $id;
        $this->nome_maquina = $nome_maquina;
        $this->id_linha = $id_linha;
    }

    public function selecionar(){
        $this->conexao = new Conexao();
        $consulta = $this->conexao->prepare("SELECT id_maquina, nome_maquina, id_linha FROM maquina");   
        $consulta->execute();    
        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }
}