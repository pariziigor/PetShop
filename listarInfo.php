<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Info</title>
</head>
<body>
    <?php
    require_once "configs/utils.php";
    require_once "model/Animal.php";
    require_once "model/Funcionario.php";
    ?>

    <div class="topnav">
        <a class="active" href="index.php">Cadastro</a>
        <a href="listarInfo.php">Listar Info</a>
        <a href="editarFuncionario.php">Editar Funcionário</a>
    </div>

    <h2>Tabela de funcionários cadastrados</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Login</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $lista = Funcionario::listar();
            foreach ($lista as $funcionario) {
                echo "<tr>";
                echo "<td>" . $funcionario["id"] . "</td>";
                echo "<td>" . $funcionario["nome"] . "</td>";
                echo "<td>" . $funcionario["email"] . "</td>";
                echo "<td>" . $funcionario["datacadastro"] . "</td>";
                $id = $funcionario["id"];
                echo "<td>
                <a href='editarFuncionario.php?id=$id'>EDITAR</a>
            </td>";
            echo "</tr>";
            echo "</tr>";
            }
            ?>
            </tbody>
        </table>

    <h2>Tabela de animais cadastrados</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Raça</th>
                    <th>Telefone Dono</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $lista = Animal::listar();
            foreach ($lista as $animal) {
                echo "<tr>";
                echo "<td>" . $animal["id"] . "</td>";
                echo "<td>" . $animal["nome"] . "</td>";
                echo "<td>" . $animal["raca"] . "</td>";
                echo "<td>" . $animal["telDono"] . "</td>";
                echo "<td>" . $animal["datacadastro"] . "</td>";
                $id = $animal["id"];
                echo "<td>
                <a href='editarAnimal.php?id=$id'>EDITAR</a>
            </td>";
            echo "</tr>";
            echo "</tr>";
            }
            ?>
            </tbody>
        </table>
</body>
</html>