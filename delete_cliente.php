<?php
    if(isset($_POST['confirmar'])) {

        include("conec.php");
        $id = intval($_GET['id']);
        $sql_code = "DELETE FROM pessoas WHERE id = '$id' ";
        $sql_query = $mysqli->query($sql_code) or die($mysqli->error);
    
        if($sql_query) { 
            echo "<h1>Deletado com sucesso</h1>";
            header("Refresh: 2; url=clientes.php");
            die();
        }
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD_deletar</title>
    <!-- Link do Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <!-- Cabeçalho -->
    <header>
        <h1> Deletar Cliente </h1>
    </header>

    <!-- Menu de links Lateral -->
    <div class="sidebar">
        <h4>Menu</h4>
        <ul class="nav flex-column">
            <li class="nav-item">
               <a class="nav-link" href="clientes.php"> Deletar </a>
            </li>
        </ul>
    </div>

    <!-- Conteudo -->
    <div class="content">
        <h1>Tem certeza que deseja DELETAR o cliente?</h1>

        <form action="" method="POST">
            <a href="clientes.php" class="btn btn-secondary"> Não </a>
            <button name="confirmar" value="1" type="submit" class="btn btn-danger"> Sim </button>  
        </form>
    </div>

    <!-- Rodapé -->
    <footer>
        <p>&copy; 2024 - CRUD PHP</p>
    </footer>

    <!-- Link do Bootstrap JS e Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
