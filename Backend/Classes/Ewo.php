<?php
class Ewo {

    public $id;
    public $numero_ewo;
    public $link_documento;
    public $quadro_status;
    public $id_maquina;
    public $conexao;


    public function __construct($id = null, $numero_ewo = null) {
        $this->id = $id;
        $this->numero_ewo = $numero_ewo;
    }

    public function selecione(){
        $this->conexao = new Conexao();
        $consulta = $this->conexao->prepare("SELECT id_ewo, numero_ewo FROM ewo");   
        $consulta->execute();    
        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }
}