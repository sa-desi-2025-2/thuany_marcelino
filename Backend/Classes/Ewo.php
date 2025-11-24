<?php
class Ewo
{

    public $id;
    public $numero_ewo;
    public $link_documento;
    public $quadro_status;
    public $id_maquina;
    public $conexao;


    public function __construct($id = null, $numero_ewo = null)
    {
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
    public function buscarEwoMaquina(Conexao $conexao, $id_maquina)
    {
        $query = "SELECT numero_ewo, link_documento FROM ewo 
                WHERE id_maquina = :id_maquina 
                ORDER BY numero_ewo";
        $stmt = $conexao->prepare($query);
        $stmt->bindParam(':id_maquina', $id_maquina, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}