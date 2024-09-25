<?php

function limpar_texto($str) {//fnucao para limpar td o que nao for number !
    return preg_replace("/[^0-9]/","",$str);
}

if(count($_POST) > 0 ) { //indices do array, só vai postar si for maior que Zero!
    include('conec.php'); 
    $erro = false ; //por padrao ele é falso !
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $nascimento = $_POST['nascimento'];
    $telefone = $_POST['telefone'];

    if(empty($nome)) {
        $erro = "preencha o nome completo ";
    }
    if(empty($email) || !filter_var($email , FILTER_VALIDATE_EMAIL)) {
        $erro = "preencha um email valided";
    }
    if(!empty($nascimento)) { // si o nascimento nao for vazio , eu quero ele desta forma 
        $pedacos = explode('/' , $nascimento); 
        if(count($pedacos) == 3 ){
            $nascimento = implode ('-', array_reverse($pedacos));
        }else {
            $erro = "A data de nascimento deve seguir o padrao dia/mes/ano";
        }
    }
        if(!empty($telefone)) {
            $telefone = limpar_texto($telefone);
            if(strlen($telefone) != 11) { // o strlen é o tamanho do caracter 
                $erro = "o telefone deve ser preenchido no padrao (19)12345-6789 ";
            }
        }
 
    if($erro) {
        echo "<p><b> $erro </b></p>";
    }else {
        $sql_code = "INSERT INTO pessoas (nome, email, telefone, nascimento, data)
        VALUES('$nome', '$email', '$telefone', '$nascimento', NOW())";
         $deu_certo = $mysqli->query($sql_code) or die($mysqli->error);
         if($deu_certo) {
             echo 'Cliente Cadastrado com sucesso ';
             unset($_POST);//  aqui no final ele vai limpar todos os input 
         }else {

         }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crud</title>
</head>
<body>

    <h1>Cadastro Crud</h1>

    <a href="cliente.php"> Voltar para Inicial</a>

    <form action="" method="post">
        <p>
            <label for="" > Nome : </label>
            <input value= "<?php if(isset($_POST['nome'])) echo $_POST['nome'];?>" type="text" name="nome">
        </p>

        <p>
            <label for="" > Email : </label>
            <input value= "<?php if(isset($_POST['email'])) echo $_POST['email'];?>" type="text" name="email">
        </p>

        <p>
            <label for="" > Nascimento  : </label>
            <input value= "<?php if(isset($_POST['nascimento'])) echo $_POST['nascimento'];?>" type="text" name="nascimento">
        </p>

        <p>
            <label for="" > Telefone : </label>
            <input value= "<?php if(isset($_POST['telefone'])) echo $_POST['telefone'];?>" placeholder = "1998888-8888" type="text" name="telefone">
        </p>

        <button type="submit"> Enviar </button>
    </form>
        
</body>
</html>