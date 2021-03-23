<!--Interface HTMl-->
<h1>Oliveira Trade</h1>
<h3>Entre com sua conta</h3>
<form method='post'>
    <label>Email</label>
    <p><input type='text' name='email'></p>
    <label>Senha</label>
    <p><input type='password' name='senha'></p>
    <p><input type='submit' value='Entrar' name='entrar'></p>
</form>
<a href="sign_up.php">Ainda não tem conta?</a>

<?php
include_once 'usuario.php'; //Inclui o código do objeto "usuario"

/*A lista com todos os usuários registrados na plataforma é salva em um vetor
(de objetos Usuario) chamado "listaUsuarios" dentro da sessão.
O login do usuário é salvo na sessão pela variável usuarioLogado ($_SESSION["usuarioLogado"])*/
session_start();

//Verfica se a lista de usuários já foi criada
if (!isset($_SESSION["listaUsuarios"])) {
    $listaUsuarios = array();
    $_SESSION["listaUsuarios"] = $listaUsuarios; //Cria a lista
}

//Verifica se um usuário já está logado
if (isset($_SESSION["usuarioLogado"])) {
    echo "<p>Bem vindo à Oliveira Trade, " . $_SESSION["usuarioLogado"] ."!</p>";
    echo "<a href='sair.php'>Sair</a>"; //Botão para a página de logout
}

//Verifica se o formulário (de login) foi preenchido
if (isset($_POST['email']) && isset($_POST['senha']) && !empty($_POST['email'])) {
    login($_POST['email'], $_POST['senha']); //Pega o email e a senha (por POST) e tenta fazer login
}


//A função login recebe o email e a senha e os busca na lista de usuários
function login($email, $senha)
{
    $encontrado = false; //Usado para verificar se o usuário foi encontrado ao final da pesquisa.      

    for ($cont = 0; $cont < count($_SESSION["listaUsuarios"]); $cont++) {  //cont é o contador
        //Procura um usuário com o email igual ao digitado
        if ($_SESSION["listaUsuarios"][$cont]->email == $email) {
            //Se o email for encontrado, verifica se a senha digitada está correta
            if ($senha == $_SESSION["listaUsuarios"][$cont]->senha) {
                //Se a senha estiver correta, completa o login. A variável usuarioLogado salva o nome do usuário
                $_SESSION["usuarioLogado"] = $_SESSION["listaUsuarios"][$cont]->nome;
                header("Refresh:0"); //Recarrega a página (com o usuário logado)
                $encontrado = true;
                break; //Termina a pesquisa
            }
            else {
                //Se a senha estiver incorreta, envia uma mensagem de erro
                echo "<p>Senha incorreta!</p>";
            }
        }
    }

    //Caso nenhum usuário com esse email seja encontrado
    if ($encontrado == false) echo "<p>Usuário não encontrado</p>";
}
?>