<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/atendefunc.css">
    <title>Cadastro</title>
</head>
<body>
    <?php
    
    require_once "configs/utils.php";
    require_once "model/Animal.php";
    require_once "model/Funcionario.php";
    require_once "model/Atende.php";

    if (isMetodo("POST")) {
        // Cadastro de Funcionário
        if (parametrosValidos($_POST, ["nome", "login"])) {
            // Fazer checagem avançadas...
            $nome = $_POST["nome"];
            $login = $_POST["login"];

            if (!Funcionario::existeLogin($login)) {
                if (Funcionario::cadastrar($nome, $login)) {
                    echo "<p>O funcionário <b>$nome</b> foi cadastrada com sucesso!</p>";
                } else {
                    echo "<p>Erro ao cadastrar o funcionário <b>$nome</b></p>";
                }
             } else {
                echo "<p>Já existe um funcionário com o login $login</p>";
            }
        }
    }
    
    if (isMetodo("POST")) {
        // Cadastro de Animais
        if (parametrosValidos($_POST, ["nome", "raca", "telDono"])) {
            // Fazer checagem avançadas...
            $nome = $_POST["nome"];
            $raca = $_POST["raca"];
            $telDono = $_POST["telDono"];

            if (Animal::cadastrar($nome, $raca, $telDono)) {
                echo "<p>O Animal <b>$nome</b> foi cadastrado com sucesso!</p>";
            } else {
                echo "<p>Erro ao cadastrar o Animal <b>$nome</b></p>";
            }
        }
    }

    if (parametrosValidos($_POST, ["idFuncionario", "idAnimal"])) {
        // Fazer checagens avançadas...
        $idFuncionario = $_POST["idFuncionario"];
        $idAnimal = $_POST["idAnimal"];
        $data = date('Y-m-d H:i:s');

        
        if (!Atende::existeAtende($idFuncionario, $idAnimal) && Funcionario::existeId($idFuncionario) && Animal::existeId($idAnimal)) {
            if (Atende::cadastrar($idFuncionario, $idAnimal, $data)) {
                echo "<p>O atendimento foi cadastrado com sucesso!</p>";
            } else {
                echo "<p>Erro ao cadastrar o atendimento</p>";
            }
        } else {
            echo "<p>Já existe esse id no sistema!</p>";
        }
    }
    ?>

    <div class="topnav">
        <a class="active" href="index.php">Cadastro</a>
        <a href="listarInfo.php">Listar Info</a>
        <a href="atendeFunc.php">Atende Func</a>
        <a href="animalTel.php">Atende por Tel</a>
        <a href="animalRaca.php">Animais pela Raça</a>
    </div>

    <h1>Cadastro de Funcionário</h1>
    <form method="POST">
        <p>Digite o nome</p>
        <input type="text" name="nome" required>
        <p>Digite o login</p>
        <input type="email" name="login" required>
        <br><br>
        <button>Cadastrar</button>
    </form>

    <h1>Cadastro de Animal</h1>
    <form method="POST">
        <p>Digite o nome do animal</p>
        <input type="text" name="nome" required>
        <p>Digite a raça do animal</p>
        <input type="text" name="raca" required>
        <p>Digite o telefone do dono</p>
        <input type="tel" name="telDono" placeholder="(xx)xxxx-xxxx">
        <br><br>
        <button>Cadastrar</button>
    </form>

    <h1>Cadastro de Atendimento</h1>
    <form method="POST">
    <p>Digite o ID do funcionário</p>
        <input type="number" name="idFuncionario" required>
        <p>Digite o ID do animal</p>
        <input type="number" name="idAnimal" required>
        <br><br>
        <button>Cadastrar</button>
    </form>
</body>
</html>