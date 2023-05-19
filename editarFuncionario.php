<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/editarfuncionario.css">
    <title>Editar Funcionário</title>
</head>
<body>
    <?php
    
    require_once "configs/utils.php";
    require_once "model/Animal.php";
    require_once "model/Funcionario.php";
    require_once "model/Atende.php";
    
    $funcionario = null;

    if (isMetodo("POST")) {
        if (parametrosValidos($_POST, ["id", "nome", "login"])) {
            $resultado = Funcionario::editar($_POST["id"], $_POST["nome"], $_POST["login"]);
            if ($resultado) {
                echo "<h1>Funcionário editado com sucesso!</h1>";
                echo "<a href='index.php'>Voltar ao index</a>";
                die;
            } else {
                echo "<h1>Erro ao editar o funcionário</h1>";
                echo "<a href='index.php'>Voltar ao index</a>";
                die;
            }
        }   else {
            echo "<h1>Problema na requisição de editar</h1>";
            echo "<a href='index.php'>Voltar ao index</a>";
            die;
        }
    }

    if (isMetodo("GET")) {
        if (parametrosValidos($_GET, ["id"])) {
            $id = $_GET["id"];
            if (Funcionario::existeId($id)) {
                $funcionario = Funcionario::getFuncionarioById($id);
            } else {
                echo "<h1>Este funcionário não existe mais!</h1>";
                echo "<a href='index.php'>Voltar ao index</a>";
                die;
            }
        } else {
            echo "<h1>Você deve dizer qual funcionário será editado!</h1>";
            echo "<a href='index.php'>Voltar ao index</a>";
            die;
        }
    }
    ?>

    <div class="topnav">
        <a class="active" href="index.php">Cadastro</a>
        <a href="listarInfo.php">Listar Info</a>
    </div>

    <h1>Editando as informações de <?= $funcionario["nome"]?></h1>

    <form method="POST">
        <p>Digite o nome: </p>
        <input type="text" name="nome" value="<?= $funcionario["nome"] ?>"required>
        <p>Digite o login: </p>
        <input type="email" name="login" value="<?= $funcionario["email"] ?>"required>
        <input type="hidden" name="id" value="<?= $funcionario["id"] ?>"required>
        <br>
        <button>Editar</button>
    </form>
</body>