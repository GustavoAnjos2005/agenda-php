<?php
// Conexão com o banco de dados
include "./db/conect.php";

// Inicializa a variável de mensagem de erro
$msg_error = "";

// Verifica se os campos de login e senha foram enviados via POST
if (isset($_POST["loginUser"]) && isset($_POST["senhaUser"])) {
    // Sanitiza as entradas do usuário
    $loginUser = mysqli_real_escape_string($conect, $_POST["loginUser"]);
    $senhaUser = mysqli_real_escape_string($conect, $_POST["senhaUser"]);

    // Cria o hash da senha
    $senhaUserHash = hash('sha256', $senhaUser);

    // Consulta ao banco de dados para verificar o usuário e a senha
    $sql = "SELECT * FROM dbusuarios WHERE loginUser = '{$loginUser}' AND senhaUser = '{$senhaUserHash}'";
    $rs = mysqli_query($conect, $sql);

    // Verifica se a consulta encontrou algum resultado
    if (!$rs) {
        // Se a consulta falhar, exibe o erro
        $msg_error = "<div class='alert alert-danger mt-3'>
                        <p>Erro na consulta ao banco de dados: " . mysqli_error($conect) . "</p>
                      </div>";
    } elseif (mysqli_num_rows($rs) == 1) {
        $dados = mysqli_fetch_assoc($rs);

        // Inicia a sessão e define as variáveis de sessão
        session_start();
        $_SESSION["loginUser"] = $loginUser;
        $_SESSION["senhaUser"] = $senhaUserHash;
        $_SESSION["nomeUser"] = $dados["nomeUser"];

        // Redireciona para a página principal
        header('Location: index.php');
        exit();
    } else {
        // Define a mensagem de erro se o usuário ou senha estiverem incorretos
        $msg_error = "<div class='alert alert-danger mt-3'>
                        <p>Usuário não encontrado ou a senha não confere.</p>
                      </div>";
    }
} else {
    // Exibe uma mensagem de debug se os campos não forem enviados
    $msg_error = "<div class='alert alert-danger mt-3'>
                    <p>Campos de login ou senha não enviados.</p>
                  </div>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <title>Login - Agendador</title>
</head>
<body class="bg-secondary">
    <div class="container">
        <div class="row vh-100 align-items-center justify-content-center">
            <div class="col-10 col-sm-8 col-md-6 col-lg-4 p-4 bg-white shadow rounded">
                <div class="row justify-content-center mb-4">
                    <img src="./img/logo_agendador.png" alt="Agendador">
                </div>
                <form class="needs-validation" action="login.php" method="post" novalidate>
                    <div class="form-group mb-4">
                        <label class="form-label" for="loginUser">Login</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bi bi-person-fill"></i>
                            </span>
                            <input class="form-control" type="text" name="loginUser" id="loginUser" required>
                            <div class="invalid-feedback">
                                Informe o username.
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-4">
                        <label class="form-label" for="senhaUser">Senha</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bi bi-key-fill"></i>
                            </span>
                            <input class="form-control" type="password" name="senhaUser" id="senhaUser" required>
                            <div class="invalid-feedback">
                                Informe a senha.
                            </div>
                        </div>
                        <?php
                            echo $msg_error;
                        ?>
                    </div>
                    <button class="btn btn-success w-100"><i class="bi bi-box-arrow-in-right"></i> Entrar</button>
                </form>
            </div>
        </div>
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
<script src="./js/validation.js"></script>
</body>
</html>
