<?php
namespace Classes;

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

public function selecionarOuInserir(Conexao $conexao): string
{
    //Tenta Selecionar a Linha pelo nome
    $query_select = "SELECT id_linha FROM linha WHERE nome_linha = :nome_linha";
    $stmt_select = $conexao->prepare($query_select);
    $stmt_select->bindParam(':nome_linha', $this->nome_linha);
    $stmt_select->execute();
    
    $resultado = $stmt_select->fetchColumn(); // Retorna o id_linha

    if ($resultado) {
        // Linha já existe, retorna o ID existente (Corrigindo o NULL em linha.nome_linha)
        return $resultado; 
    }

    //Se não existir, insere a linha
    try {
        $query_insert = "INSERT INTO linha (nome_linha) VALUES (:nome_linha)";
        $stmt_insert = $conexao->prepare($query_insert);
        $stmt_insert->bindParam(':nome_linha', $this->nome_linha);
        $stmt_insert->execute();

        return $conexao->lastInsertId();
    } catch (Exception $e) {
        throw new Exception(message: "Erro ao inserir linha: " . $e->getMessage());
    }
}
}