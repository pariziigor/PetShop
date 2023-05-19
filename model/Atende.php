<?php

require_once __DIR__ . "/../configs/BancoDados.php";

class Atende
{
    public static function cadastrar($idFuncionario, $idAnimal, $data)
    {
        try {
            $conexao = Conexao::getConexao();
            $stmt = $conexao->prepare(
                "INSERT INTO atende(idFuncionario, idAnimal, data) VALUES (?,?,?)"
            );
            $stmt->execute([$idFuncionario, $idAnimal, $data]);

            if ($stmt->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        }   catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }
    }

    public static function listar()
    {
        try {
            $conexao = Conexao::getConexao();
            $stmt = $conexao->prepare(
                "SELECT * FROM atende ORDER BY id"
            );
            $stmt->execute();

            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }
    }

    public static function listarPorFunci($idFuncionario)
    {
        try {
            $conexao = Conexao::getConexao();
            $stmt = $conexao->prepare(
                "SELECT * FROM atende WHERE idFuncionario = ?"
            );
            $stmt->execute($idFuncionario);

            return $stmt->fetchAll();
        }   catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }
    }

    public static function deletar($idAtende)
    {
        try {
            $conexao = Conexao::getConexao();
            $stmt = $conexao->prepare(
                "DELETE FROM atende WHERE id = ?"
            );
            $stmt->execute([$idAtende]);

            if ($stmt->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        }   catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }
    }

    public static function existeID($id)
    {
        try {
            $conexao = Conexao::getConexao();
            $stmt = $conexao->prepare(
                "SELECT COUNT(*) FROM atende WHERE id = ?"
            );
            $stmt->execute([$id]);

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

    public static function existeAtende($idFuncionario, $idAnimal)
    {
        try {
            $conexao = Conexao::getConexao();
            $stmt = $conexao->prepare(
                "SELECT COUNT(*) FROM atende WHERE idFuncionario = ? AND idAnimal = ?"
            );
            $stmt->execute([$idFuncionario, $idAnimal]);

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
}
?>