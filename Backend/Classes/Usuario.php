<?php
use Classes\Conexao;
class Usuario
{
    public $id;
    public $nome;
    public $email;
    public $nome_usuario;
    public $senha;
    public $tipo_acesso;
    public $status_acesso;
    public $id_linha;
    public $conexao;

    public function __construct($nome = null, $email = null, $nome_usuario = null, $tipo_acesso = null, $status_acesso = null)
    {
        $this->nome = $nome;
        $this->email = $email;
        $this->nome_usuario = $nome_usuario;
        $this->tipo_acesso = $tipo_acesso;
        $this->status_acesso = $status_acesso;

    }

    public function buscarUsuarios()
    {
        $this->conexao = new Conexao();
        $consulta = $this->conexao->prepare("SELECT id_usuario, nome, nome_usuario, email, tipo_acesso, status_acesso FROM usuario");
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }
    public function atualizarUsuarios($id, $nome, $nome_usuario, $email, $tipo_acesso)
    {
        try {

            $this->conexao = new Conexao();
            // usar placeholder ':' para prevenir ameaça ao SQL 
            $query = "UPDATE usuario 
                  SET nome = :nome, 
                      nome_usuario = :nome_usuario, 
                      email = :email, 
                      tipo_acesso = :tipo_acesso 
                  WHERE id_usuario = :id";

            $consulta = $this->conexao->prepare($query);
            // vincula os placeholders nas variáveis
            $consulta->bindParam(':id', $id, PDO::PARAM_INT);
            $consulta->bindParam(':nome', $nome);
            $consulta->bindParam(':nome_usuario', $nome_usuario);
            $consulta->bindParam(':email', $email);
            $consulta->bindParam(':tipo_acesso', $tipo_acesso);

            $executou = $consulta->execute();

            if ($executou) {
                return true;
            } else {
                // retorna infomações do erro
                $errorInfo = $consulta->errorInfo();
                return ['errorInfo' => $errorInfo];
            }
        } catch (PDOException $e) {
            // pegam o erro e transformam em mensagem 
            throw new Exception("PDOException: " . $e->getMessage());
        } catch (Exception $e) {
            throw new Exception("Erro ao atualizar usuário: " . $e->getMessage());
        }
    }

    public function alterarStatus($id, $novo_status)
    {
        try {
            $this->conexao = new Conexao();
            $query = "UPDATE usuario SET status_acesso = :status WHERE id_usuario = :id";
            $stmt = $this->conexao->prepare($query);
            $stmt->bindParam(':status', $novo_status);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $ok = $stmt->execute();
            return $ok;
        } catch (Exception $e) {
            throw new Exception("Erro ao alterar status: " . $e->getMessage());
        }
    }

    public function inserirUsuario($dados)
    {
        try {
            $this->conexao = new Conexao();
            $query = "INSERT INTO usuario (nome, nome_usuario, email, tipo_acesso, status_acesso)
                  VALUES (:nome, :nome_usuario, :email, :tipo_acesso, :status_acesso)";
            $stmt = $this->conexao->prepare($query);
            $stmt->bindParam(':nome', $dados['nome']);
            $stmt->bindParam(':nome_usuario', $dados['nome_usuario']);
            $stmt->bindParam(':email', $dados['email']);
            $stmt->bindParam(':tipo_acesso', $dados['tipo_acesso']);
            $stmt->bindParam(':status_acesso', $dados['status_acesso']);
            return $stmt->execute();
        } catch (Exception $e) {
            throw new Exception("Erro ao inserir usuário: " . $e->getMessage());
        }
    }
}