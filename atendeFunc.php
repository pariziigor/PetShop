<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/atendefunc.css">
    <title>Atendimento por Funcionário</title>
</head>
<body>
    <div class="topnav">
        <a class="active" href="index.php">Cadastro</a>
        <a href="listarInfo.php">Listar Info</a>
        <a href="atendeFunc.php">Atende Func</a>
        <a href="animalTel.php">Atende por Tel</a>
        <a href="animalRaca.php">Animais pela Raça</a>
    </div>

<?php 
        if(isset($_POST["idFunc"]) and !empty($_POST["idFunc"])) {
            $idFunc = $_POST["idFunc"];

            require_once(__DIR__."/model/Animal.php");

            $listaAnimais = Animal::listarPorFuncionario($idFunc);

            if(count($listaAnimais) > 0) {
                echo "<h3>Animais cuidados pelo funcionário selecionado:</h3>";
                echo "<table border='1'>";
                echo "<thead>";
                echo "<tr>";
                echo "<th>ID</th>";
                echo "<th>Nome</th>";
                echo "<th>Raça</th>";
                echo "<th>Telefone do dono</th>";
                echo "</tr>";
                echo "</thead>";
                echo "<tbody>";

                foreach($listaAnimais as $animal) {
                    echo "<tr>";
                    echo "<td>" . $animal["id"] . "</td>";
                    echo "<td>" . $animal["nome"] . "</td>";
                    echo "<td>" . $animal["raca"] . "</td>";
                    echo "<td>" . $animal["telDono"] . "</td>";
                    echo "</tr>";
                }

                echo "</tbody>";
                echo "</table>";
            } else {
                echo "<p>Nenhum animal foi encontrado para o funcionário selecionado.</p>";
            }
        }
    ?>

    <h2>Listagem de animais por funcionário</h2>

    <form method="POST">
        <p>Selecione o funcionário:</p>
        <select name="idFunc" required>
            <option value="">Selecione um funcionário</option>
             <?php 
                require_once(__DIR__."/model/Funcionario.php");

                $listaFuncionarios = Funcionario::listar();

                foreach($listaFuncionarios as $funcionario) {
                    echo "<option value='" . $funcionario["id"] . "'>" . $funcionario["nome"] . " (" . $funcionario["login"] . ")" . "</option>";
                }
            ?>
        </select>
        <br><br>
        <button>Buscar</button>
    </form>
</body>
</html>