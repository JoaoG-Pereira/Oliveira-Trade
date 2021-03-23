<?php
//Esse código é usado apenas para o logout
session_start(); //Inicia a sessão

//Verifica se um usuário está logado
if (isset($_SESSION["usuarioLogado"])) {
    unset($_SESSION["usuarioLogado"]); //Faz Logout - esvazia a variável que salva o nome do usuário
}

header("Location: sign_in.php"); //Envia o usuário para a página de Login
?>