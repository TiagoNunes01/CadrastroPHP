<?php
// Conecta ao banco de dados
$conexao = mysqli_connect('localhost', 'root', '', 'centro');

// Verifica se foi enviado um arquivo
if (isset($_FILES['foto'])) {
  // Recupera as informações do arquivo
  $foto = $_FILES['foto']['tmp_name'];
  $tipo = $_FILES['foto']['type'];

  // Verifica se o arquivo é uma imagem
  if (strpos($tipo, 'image/') === 0) {
    // Converte a imagem em um blob
    $conteudo = file_get_contents($foto);

    // Escapa o conteúdo para evitar SQL injection
    $conteudo = mysqli_real_escape_string($conexao, $conteudo);

    // Insere os dados no banco de dados
    $nome = mysqli_real_escape_string($conexao, $_POST['nome']);
    $email = mysqli_real_escape_string($conexao, $_POST['email']);
    $sql = "INSERT INTO tb_usuarios (nome, email, foto) VALUES ('$nome', '$email', '$conteudo')";
    mysqli_query($conexao, $sql);

    // Exibe uma mensagem de sucesso
    echo "Cadastro realizado com sucesso!";
  } else {
    // Exibe uma mensagem de erro
    echo "O arquivo enviado não é uma imagem válida.";
  }
}
?>
