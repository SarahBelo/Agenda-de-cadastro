<?php

class UsuarioModel{
    public $db = null;
    public $id = 0;
    public $nome = null;
    public $dataNasc = null;
    public $email = null;
    public $telefone = 0;
    public $senha = null;
    public function __construct($conexaoBanco)
    {
        $this->db = $conexaoBanco;
    }
public function lerTodos() {
        $retorno = ['status' => 0, 'dados' => null];
        try{
            $query = $this->db->query('SELECT * FROM usuarios');
            $dados = $query->fetchALL();
            $retorno['status'] = 1;
            $retorno['dados'] = $dados;
    }
    catch (PDOException $ex) {
        echo 'Erro ao listar todos os usuarios' .$ex->getMessage();
    }
    return $retorno;
    }

    public function editarUsuarios(){
        $retorno = ['status' => 0, 'dados' => null];
        try{
            $stmt = $this->db->prepare('
            UPDATE usuarios 
            SET nome_completo = :nome, data_nasc = :dataNasc, email = :email, telefone = :telefone 
            WHERE id = :id;
            ');
            $stmt->bindValue(':nome', $this->nome);
            $stmt->bindValue(':dataNasc', $this->dataNasc);
            $stmt->bindValue(':email', $this->email);
            $stmt->bindValue(':telefone', $this->telefone);
            $stmt->bindValue(':id', $this->id);
            $stmt->execute();
            $retorno['status'] = 1;

        } catch (PDOException $ex) {
            echo ' Erro ao Atualizar Usuario: ' .$ex->getMessage();
        }
        return $retorno;
        }

        public function deletarUsuarios()
    {
        $retorno = ['status' => 0, 'dados' => null];
        try {
            $stmt = $this->db->prepare('
            DELETE FROM administrador WHERE id_usuario = :id;
            DELETE FROM usuarios WHERE id = :id;
            ');

            $stmt->bindValue(':id', $this->id);
            $stmt->execute();

            $dados = $stmt->fetch();

            $retorno['status'] = 1;
            $retorno['dados'] = $dados;
            
        } catch (PDOException $ex) {
            echo 'Erro ao deletar o usuário: ' . $ex->getMessage();
        }
        return $retorno;
    }


        public function listarPeloId()
    {
        $retorno = ['status' => 0, 'dados' => null];
        try {
            $stmt = $this->db->prepare('SELECT * FROM usuarios WHERE id = :id;');

            $stmt->bindValue(':id', $this->id);
            $stmt->execute();
            $dados = $stmt->fetchAll();
            $retorno['status'] = 1;
            $retorno['dados'] = $dados;

        } catch (PDOException $ex) {
            echo 'Erro ao buscar os dados deste usuário: ' . $ex->getMessage();
        }
        return $retorno;
    }
}

    
