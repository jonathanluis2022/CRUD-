
<?php
    if(isset($_POST['confirmar'])) {

        include("conec.php");
        $id = intval($_GET['id']);
        $sql_code = "DELETE FROM pessoas WHERE id = '$id' ";
        $sql_query = $mysqli->query($sql_code) or die($mysqli->error);
    
        if($sql_query) { ?>
            <h1>deletado com sucesso </h1>
            <p><a href="clientes.php">voltar </a></p>

        <?php
        die();

        }
    }
?>


<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>DELETE</title>
    </head>

    <body>
        <h1>Tem certeza que pode DELETAR o  cliente ? </h1>

        <form action="" method="POST">
            <a href="clientes.php"> Não </a>
            <button name="confirmar" value="1" type="submit"> Sim </button>  
        </form>
    </body>
</html>