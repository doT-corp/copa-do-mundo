<?php
    include "../conecta_banco.php";
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $camisa = $_POST['camisa'];
    $posicao = $_POST['posicao'];
    $idpais = $_POST['idpais'];
    $situacao = $_POST['situacao'];
    $query = "UPDATE jogador SET nome = '$nome', camisa = '$camisa', posicao = '$posicao', pais_idpais = '$idpais', situacao = '$situacao' WHERE idjogador = '$id';";
    if(mysqli_query($conexao, $query))
        echo "Jogador alterado com sucesso!";
    else
        echo "Erro ao alterar jogador.";
    echo '<br><a href="../../index.html"><button>Voltar</button></a>'
?>