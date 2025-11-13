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

    public function inserirLinha()
    {
        try {
            $this->conexao = new Conexao();
            $query = "INSERT INTO linha (nome_linha) VALUES (:nome_linha)";
            $stmt = $this->conexao->prepare($query);
            $stmt->bindParam(':nome_linha', $dados['nome_linha']);
            return $stmt->execute();
        } catch (Exception $e) {
            throw new Exception("Erro ao inserir linha: " . $e->getMessage());
        }
    }
}