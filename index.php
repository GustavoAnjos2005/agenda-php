<?php
// Inclui a conexão com o banco de dados
include("./db/conect.php");
// Inicia a sessão
session_start();

// Verifica se as variáveis de sessão estão definidas
if (isset($_SESSION["loginUser"]) && isset($_SESSION["senhaUser"])) {
    $loginUser = $_SESSION["loginUser"];
    $senhaUser = $_SESSION["senhaUser"];
    $nomeUser = $_SESSION["nomeUser"];

    // Consulta ao banco de dados para verificar a sessão
    $sql = "SELECT * FROM dbusuarios WHERE loginUser = '{$loginUser}' AND senhaUser = '{$senhaUser}'";
    $rs = mysqli_query($conect, $sql);
    $dados = mysqli_fetch_assoc($rs);
    $linha = mysqli_num_rows($rs);

    // Se não encontrar o usuário, destrói a sessão e redireciona para a página de login
    if ($linha == 0) {
        session_unset();
        session_destroy();
        header('Location: login.php');
        exit();
    }
} else {
    // Redireciona para a página de login se não houver sessão
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema Agendamento 1.0</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/estilo-padrao.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
</head>
<body>
    <header class="bg-dark w-100">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark w-100">
            <a class="navbar-brand" href="#">
                <img src="img/logo_agendador.png" alt="Sis-Agendador" width="120">
            </a>

            <div class="collapse navbar-collapse" id="contentNavbarSupport">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item"><a href="index.php?menuop=home" class="nav-link active">Home</a></li>
                    <li class="nav-item"><a href="index.php?menuop=contacts" class="nav-link">Contato</a></li>
                    <li class="nav-item"><a href="index.php?menuop=tasks" class="nav-link">Tarefas</a></li>
                    <li class="nav-item"><a href="index.php?menuop=events" class="nav-link">Eventos</a></li>
                </ul>
                <div class="navbar-nav w-100 justify-content-end">
                    <a href="logout.php" class="nav-link">
                        <i class="bi bi-person"></i>
                        <?= htmlspecialchars($nomeUser, ENT_QUOTES, 'UTF-8') ?> Sair <i class="bi bi-box-arrow-right"></i>
                    </a>
                </div>
            </div>
        </nav>
    </header>
    <main>
        <div class="container">
            <?php
            $menuop = isset($_GET["menuop"]) ? $_GET["menuop"] : "home";
            switch ($menuop) {
                case 'home':
                    include("pages/home/home.php");
                    break;
                case 'contacts':
                    include("pages/contacts/contacts.php");
                    break;
                case 'cad-contacts':
                    include("pages/contacts/cad-contacts.php");
                    break;
                case 'insert-contact':
                    include("pages/contacts/insert-contact.php");
                    break;
                case 'edit-contact':
                    include("pages/contacts/edit-contact.php");
                    break;
                case 'delete-contact':
                    include("pages/contacts/delete-contact.php");
                    break;
                case 'path-contact':
                    include("pages/contacts/path-contact.php");
                    break;
                case 'tasks':
                    include("pages/tasks/tasks.php");
                    break;
                case 'cad-tasks':
                    include("pages/tasks/cad-tasks.php");
                    break;
                case 'insert-tasks':
                    include("pages/tasks/insert-tasks.php");
                    break;
                case 'edit-tasks':
                    include("pages/tasks/edit-tasks.php");
                    break;
                case 'path-tasks':
                    include("pages/tasks/path-tasks.php");
                    break;
                case 'delete-tasks':
                    include("pages/tasks/delete-tasks.php");
                    break;
                case 'events':
                    include("pages/events/events.php");
                    break;
                case 'cad-events':
                    include("pages/events/cad-events.php");
                    break;
                case 'insert-events':
                    include("pages/events/insert-events.php");
                    break;
                case 'path-events':
                    include("pages/events/path-events.php");
                    break;
                case 'edit-events':
                    include("pages/events/edit-events.php");
                    break;
                case 'delete-events':
                    include("pages/events/delete-events.php");
                    break;
                default:
                    include("pages/home/home.php");
                    break;
            }
            ?>
        </div>
    </main>
    <footer class="container-fluid bg-dark text-light">
        <div class="text-center">Sistema Agendador v 1.0</div>
    </footer>
    <script src="./js/jquery-3.7.1.min.js"></script>
    <script src="./js/jquery.form.js"></script>
    <script src="./js/upload.js"></script>
    <script src="./js/javascript-agendador.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
    <script src="./js/validation.js"></script>
</body>
</html>
