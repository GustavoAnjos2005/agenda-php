<?php
// Constantes de configuração da conexão com o banco de dados
define("SERVIDOR", "localhost");  // Endereço do servidor do banco de dados
define("USUARIO", "root");  // Nome de usuário do banco de dados
define("SENHA", "");  // Senha do banco de dados (mantenha vazia se não houver senha)
define("BANCO", "dbagendasql");  // Nome do banco de dados

// Melhoria de segurança: Protege contra acesso direto ao arquivo config.php
if (basename(__FILE__) == basename($_SERVER['PHP_SELF'])) {
    die("Acesso Negado.");
}
?>
