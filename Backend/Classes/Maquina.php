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

    // public function selecionar(){
    //     $this->conexao = new Conexao();
    //     $consulta = $this->conexao->prepare("SELECT id_maquina, nome_maquina, id_linha FROM maquina");   
    //     $consulta->execute();    
    //     return $consulta->fetchAll(PDO::FETCH_ASSOC);
    // }
    public function inserirMaquina()
    {
        try {
            $this->conexao = new Conexao();
            $query = "INSERT INTO maquina (nome_maquina) VALUES (:nome_maquina)";
            $stmt = $this->conexao->prepare($query);
            $stmt->bindParam(':nome_maquina', $dados['nome_maquina']);
            return $stmt->execute();
        } catch (Exception $e) {
            throw new Exception("Erro ao inserir máquina: " . $e->getMessage());
        }
    }
}