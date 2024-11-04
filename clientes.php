<?php
include('conec.php');
$sql_clientes = "SELECT * FROM pessoas ORDER BY id DESC"; // Alterado para ordem decrescente
$query_clientes = $mysqli->query($sql_clientes) or die($mysqli->error);
$num_clientes = $query_clientes->num_rows; 
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Pessoas</title>
    <!-- Link do Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <!-- Cabeçalho -->
    <header>
        <h1>Clientes cadastrados</h1>
    </header>

    <!-- Menu de links Lateral -->
    <div class="sidebar">
        <h4>Menu</h4>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="index.php">Cadastrar</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Listar</a>
            </li>
        </ul>
    </div>

    <!-- Conteúdo -->
    <div class="content">

        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Id</th>
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th>Nascimento</th>
                    <th>Telefone</th>
                    <th>Data / hora</th>
                    <th>Ações</th>
                </tr>
            </thead>

            <tbody>
            <?php if($num_clientes == 0){ ?>
                <tr>
                    <td colspan="7" class="text-center">Nenhum cliente foi cadastrado</td>
                </tr>
            <?php } else {
                while($cliente = $query_clientes->fetch_assoc()){

                    $telefone = 'Não informado';
                    if(!empty($cliente['telefone'])) {
                        $ddd = substr($cliente['telefone'], 0, 2);
                        $parte1 = substr($cliente['telefone'], 2, 5);
                        $parte2 = substr($cliente['telefone'], 7);
                        $telefone = "($ddd) $parte1-$parte2";
                    }

                    $nascimento = 'Não informado';
                    if(!empty($cliente['nascimento'])){
                        $nascimento = implode('/', array_reverse(explode('-', $cliente['nascimento']))); // Inverte formato da data
                    }

                    $data_cadastro = date("d/m/Y H:i", strtotime($cliente['data'])); 
                ?>
                <tr>
                    <td><?php echo $cliente['id']; ?></td>
                    <td><?php echo $cliente['nome']; ?></td>
                    <td><?php echo $cliente['email']; ?></td>
                    <td><?php echo $nascimento; ?></td>
                    <td><?php echo $telefone; ?></td>
                    <td><?php echo $data_cadastro; ?></td>
                    <td>
                        <a class="btn btn-warning btn-sm" href="edit_cliente.php?id=<?php echo $cliente['id']; ?>">Editar</a>
                        <a class="btn btn-danger btn-sm" href="delete_cliente.php?id=<?php echo $cliente['id']; ?>">Deletar</a>
                    </td>
                </tr>
            <?php }
            }
            ?>
            </tbody>
        </table>
    </div>

    <!-- Rodapé -->
    <footer>
        <p>&copy; 2024 - CRUD PHP</p>
    </footer>

    <!-- Link do Bootstrap JS  -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
