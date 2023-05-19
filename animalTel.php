<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Animais por Telefone</title>
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
            <h2>Buscar animais pelo telefone do dono</h2>
            <h3>Escolha o telefone: </h3>
            <select name="telDono" required>
                <option value="">Escolha um telefone</option>
                <?php
                require_once(__DIR__."/model/Animal.php");
                $telefones = Animal::listar();

                foreach($telefones as $telDono) {
                    echo "<option value='{$telDono['telDono']}'>{$telDono['telDono']}</option>";
                }
                ?>
            </select>
            <br> <br>
            <input type="submit" value="BUSCAR">
        </form>
            <?php
                require_once(__DIR__."/model/Animal.php");
                
                if (isset($_GET['telDono'])) {
                    $teldono = $_GET['telDono'];
                    $telefones = Animal::listarPorTelefone($telDono);
                } 
            ?>

            <h2>Animais e seus telefones: </h2>
                <table>
                    <thead>
                        <tr>
                            <table border='1'>
                            <th>Nome</th>
                            <th>Raça</th>
                            <th>Telefone Dono</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($telefones as $telDono) { ?>
                        <tr>
                            <td><?php echo $telDono['nome']; ?></td>
                            <td><?php echo $telDono['raca']; ?></td>
                            <td><?php echo $telDono['telDono']; ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <br>
        </body>
</body>
</html>