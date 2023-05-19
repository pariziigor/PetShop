<?php

require_once __DIR__ . "/../configs/BancoDados.php";

class Animal
{
    public static function cadastrar($nome, $raca, $telDono)
    {
        try {
            $conexao = Conexao::getConexao();
            $stmt = $conexao->prepare(
                "INSERT INTO animais(nome, raca, telDono) VALUES (?,?,?)"
            );
            $stmt->execute([$nome, $raca, $telDono]);
            
            if ($stmt->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        }   catch (Exception $e){
            echo $e->getMessage();
            exit;
        }
    }

    public static function listar()
    {
        try {
            $conexao = Conexao::getConexao();
            $stmt = $conexao->prepare(
                "SELECT * FROM animais ORDER BY id"
            );
            $stmt->execute();

            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }
    }

    public static function existeId($id)
    {
        try {
            $conexao = Conexao::getConexao();
            $stmt = $conexao->prepare(
                "SELECT COUNT(*) FROM animais WHERE id = ?"
            );
            $stmt->execute([$id]);

            $quantidade = $stmt->fetchColumn();
            if ($quantidade > 0) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }
    }

    public static function editar($id, $nome, $raca, $telDono)
    {
        try {
            $conexao = Conexao::getConexao();
            $stmt = $conexao->prepare(
                "UPDATE animais SET nome = ?, raca = ?, telDono = ? WHERE id = ?"
            );
            $stmt->execute([$id, $nome, $raca, $telDono]);

            if ($stmt->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            return false;
        }
    }

    public static function deletar($id)
    {
        try {
            $conexao = Conexao::getConexao();
            $stmt = $conexao->prepare(
                "DELETE FROM animais WHERE id = ?"
            );
            $stmt->execute([$id]);

            if ($stmt->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {

            echo $e->getMessage();
            exit;
            // return false;
        }
    }

    public static function getAnimalById($id)
    {
        try {
            $conexao = Conexao::getConexao();
            $stmt = $conexao->prepare(
                "SELECT * FROM animais WHERE id = ?"
            );
            $stmt->execute([$id]);

            return $stmt->fetchAll()[0];
        } catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }
    }

    public static function existeNome($nome)
    {
        try {
            $conexao = Conexao::getConexao();
            $stmt = $conexao->prepare(
                "SELECT COUNT(*) FROM animais WHERE nome = ?"
            );
            $stmt->execute([$nome]);

            $quantidade = $stmt->fetchColumn();
            if ($quantidade > 0) {
                return true;
            } else {
                return false;
            }
        }   catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }
    }

    public static function existeTel($telDono)
    {
        try {
            $conexao = Conexao::getConexao();
            $stmt = $conexao->prepare(
                "SELECT COUNT(*) FROM animais WHERE telDono = ?"
            );
            $stmt->execute([$telDono]);

            $quantidade = $stmt->fetchColumn();
            if ($quantidade > 0) {
                return true;
            } else {
                return false;
            }
        }   catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }
    }

    public static function listarPorRaca($raca)
    {
        try {
            $conexao = Conexao::getConexao();
            $stmt = $conexao->prepare(
                "SELECT * FROM animais WHERE raca = ? ORDER BY nome"
            );
            $stmt->execute([$raca]);

            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }
    }

    public static function listarPorTelefone($telDono)
    {
        try {
            $conexao = Conexao::getConexao();
            $stmt = $conexao->prepare(
                "SELECT * FROM animais WHERE telDono = ? ODER BY nome"
            );
            $stmt->execute([$telDono]);

            return $stmt->fetchAll();
        }   catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }
    }

    public static function listarPorFuncionario($idFuncionario) {
        try {
            $conexao = Conexao::getConexao();
            $stmt = $conexao->prepare(
                "SELECT a.* FROM animais a INNER JOIN atende at ON at.idAnimal = a.id WHERE at.idFuncionario = ?"
            );
            $stmt->execute([$idFuncionario]);

            return $stmt->fetchAll();
        }   catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }
    }
}

?>