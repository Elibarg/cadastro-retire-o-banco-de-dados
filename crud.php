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

if(isset($_POST["excluir"]))
{
    $comando = $pdo->prepare("DELETE FROM cadastro WHERE nick = ?");
    $resultado = $comando->execute([$nick]);
    
    if($resultado)
    {
        // Registro excluído com sucesso
        echo "Registro excluído com sucesso!";
    }
    else
    {
        // Erro ao excluir o registro
        echo "Erro ao excluir o registro.";
    }
}

if(isset($_POST["alterar"]))
{
    $comando = $pdo->prepare("UPDATE cadastro SET nome = ?, telefone = ?, email = ? WHERE nick = ?");
    $resultado = $comando->execute([$nome, $telefone, $email, $nick]);
    
    if($resultado)
    {
        // Registro alterado com sucesso
        echo "Registro alterado com sucesso!";
    }
    else
    {
        // Erro ao alterar o registro
        echo "Erro ao alterar o registro.";
    }
}

if(isset($_POST["listar"]))
{
    $comando = $pdo->prepare("SELECT * FROM cadastro");
    $resultado = $comando->execute();

    while($linhas = $comando->fetch())
    {
        $n = $linhas["nick"];
        $s = $linhas["senha"];
        $no = $linhas["nome"];
        $t = $linhas["telefone"];
        $e = $linhas["email"];
        echo "Nick: $n Senha: $s Nome: $no Telefone: $t E-mail: $e <br>";
    }
}
?>