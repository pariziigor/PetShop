<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Animal por raça</title>
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
    require_once "configs/utils.php";
    require_once "model/Animal.php";
    require_once "model/Funcionario.php";
    require_once "model/Atende.php";
?>

        <form method="GET">
            <h2>Buscar animais por raça</h2>
            <select name="raca">
                <option value="">Escolha a raça</option>
                <?php
                require_once(__DIR__."/model/Animal.php");
                $animais = Animal::listar();
                foreach($animais as $animal) {
                    echo "<option value='{$animal['raca']}'>{$animal['raca']}</option>";
                }
                ?>
            </select>
            <br> <br>
            <input type="submit" value="BUSCAR">
        </form>
            <?php
                if(isset($_GET['raca'])) {
                $racaAnimal = $_GET['raca'];
                $animais = Animal::listarPorRaca($racaAnimal);
                }
            ?>
        
            <h2>Animais da raça: </h2>
                <?php 
                    if(isset($animais) && count($animais) > 0) { 
                ?>
            <table>
                <thead>
                    <tr>
                        <table border='1'>
                        <th>Id</th>
                        <th>Nome</th>
                        <th>Raça</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($animais as $animal) { ?>
                        <tr>
                            <td><?php echo $animal['id']; ?></td>
                            <td><?php echo $animal['nome']; ?></td>
                            <td><?php echo $animal['raca']; ?></td>
                        </tr>
                    <?php } }?>
                </tbody>
            </table>
            <br>
</body>
</html>