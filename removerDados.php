<?php

require_once "configs/utils.php";
require_once "model/Animal.php";
require_once "model/Funcionario.php";
require_once "model/Atende.php";

try{
    if (isMetodo("GET")) {
        if (parametrosValidos($_GET, ["deletarFuncionario"])) {
            $id = $_GET["deletarFuncionario"];
            if (Funcionario::existeId($id)) {
                $resultado = Funcionario::deletar($id);
                if ($resultado) {
                    echo "<p>Funcionário deletado com sucesso!</p>";
                } else {
                    echo "<p>Deu ruim!</p>";
                }
            } else {
                echo "<p>Esse funcionário não existe!</p>";
                die;
                }
            }
        }
    }catch(PDOException $e){
    if ($e->errorInfo[0] == 1451) {
        echo "<script>alert('O animal está cadastrado em um atendimento.')</script>";
    }else{
        echo "<script>alert('Erro ao deletar o animal')</script>". $e->getMessage();;
    }
}

if (isMetodo("GET")) {
    if (parametrosValidos($_GET, ["deletarAnimal"])) {
        $id = $_GET["deletarAnimal"];
        if (Animal::existeId($id)) {
            $resultado = Animal::deletar($id);
            if ($resultado) {
                echo "<p>Animal deletado com sucesso!</p>";
            } else {
                echo "<p>Deu ruim!</p>";
            }
        } else {
            echo "<p>Esse animal não existe!</p>";
            die;
        }
    }
}

if (isMetodo("GET")) {
    if (parametrosValidos($_GET, ["deletarAtende"])) {
        $id = $_GET["deletarAtende"];
        if (Atende::existeId($id)) {
            $resultado = Atende::deletar($id);
            if ($resultado) {
                echo "<p>Atendimento deletado com sucesso!</p>";
            } else {
                echo "<p>Deu ruim!</p>";
            }
        } else {
            echo "<p>Esse atendimento não existe!</p>";
            die;
        }
    }
}

?>