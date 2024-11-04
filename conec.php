<?php
    $host = "localhost";
    $db = "crud";
    $user = "root";
    $pass = "";
    
    $mysqli = new mysqli($host, $user, $pass, $db);
        
    if($mysqli->connect_errno) {
        die("Falha na conexão banco de dados ");
    }

    function formate_telefone($telefone) {
            $ddd = substr($telefone, 0, 2);
            $parte1 = substr($telefone, 2, 5);
            $parte2 = substr($telefone, 7);
            return "($ddd) $parte1-$parte2";
    }

    function formate_data($data) {
        return implode ('/', array_reverse(explode('-', $data)));
    }

