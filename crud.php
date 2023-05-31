<?php
include("conecta.php");
$nick = $_POST["Nick"];
$senha = $_POST["senha"];
$confirmarSenha = $_POST["Confirmar Senha"];
$nome = $_POST["Nome"];
$telefone = $_POST["telefone"];
$email = $_POST["E-mail"];

if(isset($_POST["inserir"]))
{
    if($senha == $confirmarSenha)
    {
        // Senhas coincidem, você pode prosseguir com o cadastro
        $comando = $pdo->prepare("INSERT INTO cadastro (nick, senha, nome, telefone, email) VALUES (?, ?, ?, ?, ?)");
        $resultado = $comando->execute([$nick, $senha, $nome, $telefone, $email]);
        
        if($resultado)
        {
            // Cadastro realizado com sucesso
            echo "Cadastro realizado com sucesso!";
        }
        else
        {
            // Erro ao cadastrar
            echo "Erro ao cadastrar.";
        }
    }
    else
    {
        // Senhas não coincidem
        echo "As senhas não coincidem.";
    }
}
?>