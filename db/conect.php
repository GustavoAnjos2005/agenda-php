<?php
// Inclui o arquivo de configuração
include("config.php");

// Conecta ao banco de dados utilizando as constantes definidas em config.php
$conect = mysqli_connect(SERVIDOR, USUARIO, SENHA, BANCO);

// Verifica se a conexão foi bem-sucedida
if (!$conect) {
    // Termina a execução do script e exibe uma mensagem de erro se a conexão falhar
    die("Erro na conexão com o servidor: " . mysqli_connect_error());
}

// Configuração para o charset utf8mb4 para garantir a correta manipulação de caracteres especiais
mysqli_set_charset($conect, "utf8mb4");
?>
