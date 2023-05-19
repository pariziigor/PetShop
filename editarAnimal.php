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
    require_once "model/Atende.php";

    $animal = null;

    if (isMetodo("POST")) {
        if (parametrosValidos($_POST, ["id", "nome", "raca", "telDono"])) {
            $resultado = Animal::editar($_POST["id"], $_POST["nome"], $_POST["raca"], $_POST["telDono"]);
            if ($resultado) {
                echo "<h1>Animal editado com sucesso!</h1>";
                echo "<a href='index.php'>Voltar ao index</a>";
                die;
            } else {
                echo "<h1>Erro ao editar o animal!</h1>";
                echo "<a href='index.php'>Voltar ao index</a>";
                die;
            }
        } else {
            echo "<h1>Problemas na requisição de editar</h1>";
            echo "<a href='index.php'>Voltar ao index</a>";
            die;
        }
    }

    if (isMetodo("GET")) {
        if (parametrosValidos($_GET, ["id"])) {
            $id = $_GET["id"];
            if (Animal::existeId($id)) {
                $animal = Animal::getAnimalById($id);
            } else {
                echo "<h1>Este animal não existe</h1>";
                echo "<a href='index.php'>Voltar ao index</a>";
                die;
            }
        } else {
            echo "<h1>Você deve dizer qual é o animal a ser editado</h1>";
            echo "<a href='index.php'>Voltar ao index</a>";
            die;
        }
    }
    ?>

    <h1>Editando as informações de <?= $animal["nome"] ?></h1>

    <form method="POST">
        <p>Digite o nome</p>
        <input type="text" name="nome" value="<?= $animal["nome"] ?>" required>
        <p>Digite a raça</p>
        <input type="text" name="raca" value="<?= $animal["raca"] ?>" required>
        <p>Digite o telefone do dono</p>
        <input type="tel" name="telDono" value="<?= $animal["telDono"] ?>" required>
        <input type="hidden" name="id" value="<?= $animal["id"] ?>">
        <br>
        <button>Editar</button>
    </form>
</body>
</html>