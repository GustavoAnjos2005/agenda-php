<?php
// Exemplo de geração de hash para senha usando sha256
$senha = "123456";
var_dump($senha);
echo "<br>";

// Gera o hash da senha
$senhaCripo = hash('sha256', $senha);
var_dump($senhaCripo); 
?>
