<!--Interface HTMl-->
<h1>Oliveira Trade</h1>
<h3>Crie sua conta</h3>
<form method='post'>
    <label>Email</label>
    <p><input type='text' name='email'></p>
    <label>Nome</label>
    <p><input type='text' name='nome'>
    <p>
        <label>CPF</label>
    <p><input type='text' name='cpf'></p>
    <label>Senha</label>
    <p><input type='password' name='senha'></p>
    <p><input type='submit' value='Criar conta'></p>
</form>

<?php
include_once 'usuario.php'; //Inclui o código do objeto "usuario"
session_start(); //Inicia a sessão

//Verifica se a lista de usuários já foi criada
if (!isset($_SESSION["listaUsuarios"])) {
    $listaUsuarios = array();
    $_SESSION["listaUsuarios"] = $listaUsuarios; //Cria a lista
}

//Verifica se cada campo formulário foi enviado
if (isset($_POST['email']) && isset($_POST['nome']) && isset($_POST['cpf']) && isset($_POST['senha'])) {
    //Verifica se nenhum campo está vazio
    if (!empty($_POST['email']) && !empty($_POST['nome']) && !empty($_POST['cpf']) && !empty($_POST['senha'])) {

        //Verifica se o usuário já está cadastrado
        if (usuarioCadastrado($_POST['email'], $_POST['cpf'])) {
            echo "Email ou CPF já cadastrados!";
        }
        //Se o usuário não é cadastrado
        else {
            cadastrar($_POST['email'], $_POST['nome'], $_POST['cpf'], $_POST['senha']); //Cadastra o usuário
        }
    }
    //Em caso de campos vazios
    else {
        echo "Por favor, preencha todos os campos";
    }
}

//Cria e salva uma nova conta de usuário
function cadastrar($email, $nome, $cpf, $senha)
{
    $novoUsuario = new Usuario($email, $nome, $cpf, $senha); //Cria a conta (objeto usuario)
    array_push($_SESSION["listaUsuarios"], $novoUsuario); //Registra a conta no array listaUsuarios (salvo na sessão)
    echo "Cadastro concluído com sucesso!";
    echo "<p><a href=sign_in.php>Fazer login</a></p>";
}

//Verifica se o usuário já se cadastrou com o email ou CPF informado
function usuarioCadastrado($email, $cpf)
{
    for ($cont = 0; $cont < count($_SESSION["listaUsuarios"]); $cont++) {  //cont é o contador
        //Procura um usuário com o email ou CPF igual ao digitado no formulári
        if ($_SESSION["listaUsuarios"][$cont]->email == $email || $_SESSION["listaUsuarios"][$cont]->cpf == $cpf) {
            return true;
        }
    }
}
?>