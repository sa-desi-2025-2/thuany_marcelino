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

public function selecionarOuInserir(Conexao $conexao): string
{
    //Tenta Selecionar a Máquina pelo nome
    $query_select = "SELECT id_maquina FROM maquina WHERE nome_maquina = :nome_maquina";
    $stmt_select = $conexao->prepare($query_select);
    $stmt_select->bindParam(':nome_maquina', $this->nome_maquina);
    $stmt_select->execute();
    
    $resultado = $stmt_select->fetchColumn(); // Retorna o id_maquina

    if ($resultado) {
        // Máquina já existe, retorna o ID existente (Corrigindo o NULL em maquina.nome_maquina)
        return $resultado; 
    }

    // Se não existir, insere a máquina (Corrigindo o NULL em maquina.id_linha)
    try {
        // Agora inserimos também o id_linha
        $query_insert = "INSERT INTO maquina (nome_maquina, id_linha) VALUES (:nome_maquina, :id_linha)";
        $stmt_insert = $conexao->prepare($query_insert);
        $stmt_insert->bindParam(':nome_maquina', $this->nome_maquina);
        // O id_linha deve ser preenchido no main_planilha.php antes de chamar este método
        $stmt_insert->bindParam(':id_linha', $this->id_linha); 
        $stmt_insert->execute();

        return $conexao->lastInsertId();
    } catch (Exception $e) {
        throw new Exception(message: "Erro ao inserir máquina: " . $e->getMessage());
    }
}

}