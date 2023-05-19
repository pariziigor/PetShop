<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/index.css">
    <title>Cadastro</title>
</head>
<body>
    <?php
    
    require_once "configs/utils.php";
    require_once "model/Animal.php";
    require_once "model/Funcionario.php";

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
    ?>

    <div class="topnav">
        <a class="active" href="index.php">Cadastro</a>
        <a href="listarInfo.php">Listar Info</a>
        <a href="editarFuncionario.php">Editar Funcionário</a>
        <a href="editarAnimal.php">Editar Animal</a>
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
</body>
</html>