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

    public function inserirEwo()
    {
        try {
            $this->conexao = new Conexao();
            $query = "INSERT INTO ewo (numero_ewo, link_documento) VALUES (:numero_ewo, :link_documento)";
            $stmt = $this->conexao->prepare($query);
            $stmt->bindParam(':numero_ewo, :link_documento', $dados['numero_ewo, link_documento']);
            return $stmt->execute();
        } catch (Exception $e) {
            throw new Exception("Erro ao inserir Ewo: " . $e->getMessage());
        }
    }
}