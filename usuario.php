<?php
/*A classe usuário é usada para salvar os dados dos usuário registrados
Cada conta criada será um objeto do tipo Usuário*/
class Usuario
{
    public $email;
    public $nome;
    public $cpf;
    public $senha;
    
    function __construct($email, $nome, $cpf, $senha)
    {
        $this->email = $email;
        $this->nome = $nome;
        $this->senha = $senha;
        $this->cpf = $cpf;
    }
}
