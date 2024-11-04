<?php
function limpar_texto($str) {
    return preg_replace("/[^0-9]/", "", $str);
}

if (count($_POST) > 0) {
    include('conec.php'); // Certifique-se de que o nome do arquivo está correto
    global $mysqli; // Garantir que a variável mysqli esteja acessível
    $erro = false; 
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $nascimento = $_POST['nascimento']; // Este valor será no formato YYYY-MM-DD
    $telefone = $_POST['telefone'];

    if (empty($nome)) {
        $erro = "Preencha o nome completo.";
    }
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erro = "Preencha um email válido.";
    }
    if (empty($nascimento)) {
        $erro = "Preencha a data de nascimento.";
    }
    if (!empty($telefone)) {
        $telefone = limpar_texto($telefone);
        if (strlen($telefone) != 11) {
            $erro = "O telefone deve ser preenchido no padrão (19)12345-6789.";
        }
    }

    if($erro) {
        echo "<p><b> $erro </b></p>";
    } else {
        $sql_code = " INSERT INTO pessoas (nome, email, telefone, nascimento, data)
        VALUES('$nome', '$email', '$telefone', '$nascimento', NOW())";
    
        if ($mysqli->query($sql_code) === TRUE) {
            // Redireciona para a lista de pessoas cadastradas
            header("Location: clientes.php");
            exit(); // Certifique-se de usar exit após o redirecionamento
        } else {
            echo '<div class="alert alert-danger">Erro ao cadastrar: ' . $mysqli->error . '</div>';
        }
    }
    
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD com Layout Fixo</title>
    <!-- Link do Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <!-- Cabeçalho -->
    <header>
        <h1>Cadastrar</h1>
    </header>

    <!-- Menu de links Lateral -->
    <div class="sidebar">
        <h4>Menu</h4>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="#">Cadastrar</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="clientes.php">Listar</a>
            </li>
        </ul>
    </div>

    <!-- Conteúdo -->
    <div class="content">
        <!-- Formulário de Cadastro -->
        <form action="" method="post">
            <div class="mb-3">
                <label for="nome" class="form-label">Nome</label>
                <input value="<?php if(isset($_POST['nome'])) echo $_POST['nome'];?>" type="text" name="nome" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">E-mail</label>
                <input value="<?php if(isset($_POST['email'])) echo $_POST['email'];?>" type="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="nascimento" class="form-label">Nascimento</label>
                <input value="<?php if(isset($_POST['nascimento'])) echo $_POST['nascimento'];?>" type="date" name="nascimento" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="telefone" class="form-label">Telefone</label>
                <input value="<?php if(isset($_POST['telefone'])) echo $_POST['telefone'];?>" type="tel" name="telefone" class="form-control" placeholder="1998888-8888" required>
            </div>
            <button type="submit" class="btn btn-primary">Enviar</button>
        </form>

    </div>

    <!-- Rodapé -->
    <footer>
        <p>&copy; 2024 - CRUD PHP</p>
    </footer>

    <!-- Link do Bootstrap JS e Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

    <!-- Script para esconder a mensagem de sucesso após 3 segundos -->
    <script>
        setTimeout(function() {
            var successMessage = document.getElementById('success-message');
            if (successMessage) {
                successMessage.style.display = 'none';
            }
        }, 3000); // Oculta a mensagem após 3 segundos
    </script>
</body>
</html>
