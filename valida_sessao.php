<?php
session_start();
include "./db/conect.php"; // Certifique-se de incluir a conexão ao banco de dados

if (isset($_SESSION['loginUser']) && isset($_SESSION['senhaUser'])) {
    $loginUser = $_SESSION['loginUser'];
    $senhaUser = $_SESSION['senhaUser'];
    $nomeUser = $_SESSION['nomeUser'];

    $sql = "SELECT * FROM dbusuarios WHERE loginUser = '{$loginUser}' AND senhaUser = '{$senhaUser}'";
    $rs = mysqli_query($conect, $sql);
    $dados = mysqli_fetch_assoc($rs);
    $linhas = mysqli_num_rows($rs);

    if ($linhas == 0) { // Confere se a consulta retornou algum registro
        session_unset();
        session_destroy();
        header("location: login.php");
        exit;
    }
} else {
    header("location: login.php");
    exit;
}
?>
