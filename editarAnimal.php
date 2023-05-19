<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/editaranimal.css">
    <title>Editar Animal</title>
</head>
<body>
    <?php
    
    require_once "configs/utils.php";
    require_once "model/Animal.php";
    require_once "model/Funcionario.php";
    
    $animal = null;

    if (isMetodo("POST")) {
        if (parametrosValidos($_POST, ["id", "nome", "raca", "telDono"])) {
            $resultado = Animal::editar($_POST["id"], $_POST["nome"], $_POST["raca"], $_POST["telDono"]);
            if ($resultado) {
                echo "<h1>Animal editado com sucesso!</h1>";
                echo "<a href='index.php'>Voltar ao index</a>";
                die;
            } else {
                echo "<h1>Erro ao editar o animal</h1>";
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
            if (Animal::existeId($id)) {
                $funcionario = Animal::getAnimalById($id);
            } else {
                echo "<h1>Este animal não existe mais!</h1>";
                echo "<a href='index.php'>Voltar ao index</a>";
                die;
            }
        } else {
            echo "<h1>Você deve dizer qual animal será editado!</h1>";
            echo "<a href='index.php'>Voltar ao index</a>";
            die;
        }
    }
    ?>

    <div class="topnav">
        <a class="active" href="index.php">Cadastro</a>
        <a href="listarInfo.php">Listar Info</a>
        <a href="editarFuncionario.php">Editar Funcionário</a>
        <a href="editarAnimal.php">Editar Animal</a>
    </div>

    <h1>Editando as informações de <?= $Animal["nome"]?></h1>

    <form method="POST">
        <p>Digite o nome: </p>
        <input type="text" name="nome" value="<?= $Animal["nome"] ?>"required>
        <p>Digite o raca: </p>
        <input type="text" name="raca" value="<?= $Animal["raca"] ?>"required>
        <p>Digite o telefone: </p>
        <input type="tel" name="telDono" value="<?= $Animal["telDono"] ?>"required>
        <input type="hidden" name="id" value="<?= $Animal["id"] ?>"required>
        <br>
        <button>Editar</button>
    </form>
</body>