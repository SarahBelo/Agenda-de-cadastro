<?php

class ModelUsuario{
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
    public function logar(){
        $retorno = ['status' => 0, 'dados' => null];
        try {
            $stmt = $this->db->prepare('
            SELECT u.id, u.email, a.senha
            FROM usuarios AS u
            INNER JOIN administrador AS a ON u.id = a.id_usuario
            WHERE u.email = :email AND a.senha = :senha;
            ');
            $stmt->bindValue(':email', $this->email);
            $stmt->bindValue(':senha', $this->senha);
            $stmt->execute();
            $dado = $stmt->fetch();
            if ($dado && $dado['id'] && $dado['id'] > 0) {
                $retorno['status'] = 1;
                $retorno['dados'] = $dado;
            }
        } catch (PDOException $ex) {
            echo 'Erro ao logar: ' . $ex->getMessage();
        }
        return $retorno;
    }

    public function cadastro() {
        $retorno = ['status' => 0, 'dados' => null];
        try{
            $stmt = $this->db->prepare('
            INSERT INTO usuarios(nome_completo, data_nasc , email, telefone) VALUES (:nome, :dataNasc, :email, :telefone); 
            INSERT INTO administrador (id_usuario, senha) VALUES (int(LAST_INSERT_ID()), :senha);
            ');
            $stmt->bindValue(':nome', $this->nome);
            $stmt->bindValue(':dataNasc', $this->dataNasc);
            $stmt->bindValue(':email', $this->email);
            $stmt->bindValue(':telefone', $this->telefone);
            $stmt->bindValue(':senha', $this->senha);
            $stmt->execute();
            $retorno['status'] = 1;

        } catch (PDOException $e) {
            echo ' Erro ao Cadastrar: ' .$e->getMessage();
        }
        return $retorno;
    }
}