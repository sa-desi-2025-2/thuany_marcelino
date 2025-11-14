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

    public function inserirEwo(Conexao $conexao)
    {
        try {
            $query = "INSERT INTO ewo (numero_ewo, link_documento, id_maquina) VALUES (:numero_ewo, :link_documento, :id_maquina)";
            $stmt = $conexao->prepare($query);
            $params = [
                ':numero_ewo'    => $this->numero_ewo,
                ':link_documento' => $this->link_documento,
                ':id_maquina' => $this->id_maquina
            ];
            return $stmt->execute($params);
        } catch (Exception $e) {
            throw new Exception("Erro ao inserir Ewo: " . $e->getMessage());
        }
    }
}