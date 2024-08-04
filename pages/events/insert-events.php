<?php
if (isset($_POST["btnAdd"])) {
    $tituloEvento = trim($_POST["tituloEvento"]);
    $descricaoEvento = trim($_POST["descricaoEvento"]);
    $dataInicioEvento = $_POST["dataInicioEvento"];
    $horaInicioEvento = $_POST["horaInicioEvento"];
    $dataFimEvento = $_POST["dataFimEvento"];
    $horaFimEvento = $_POST["horaFimEvento"];

    // Verificar se os campos obrigatórios estão preenchidos
    if (empty($tituloEvento) || empty($descricaoEvento) || empty($dataInicioEvento) || empty($horaInicioEvento)) {
        die("Por favor, preencha todos os campos obrigatórios.");
    }

    $sql = "INSERT INTO dbeventos (tituloEvento, descricaoEvento, dataInicioEvento, horaInicioEvento, dataFimEvento, horaFimEvento, statusEvento) 
            VALUES (?, ?, ?, ?, ?, ?, 0)";
    $stmt = $conect->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("ssssss", $tituloEvento, $descricaoEvento, $dataInicioEvento, $horaInicioEvento, $dataFimEvento, $horaFimEvento);
        if ($stmt->execute()) {
            echo '<div class="alert alert-success" role="alert">
                <h4 class="alert-heading">Novo Evento</h4>
                <p>Evento adicionado com sucesso!</p>
                <hr>
                <p class="mb-0">
                    <a href="?menuop=events">Voltar para a lista de eventos.</a>
                </p>
            </div>';
        } else {
            echo '<div class="alert alert-danger" role="alert">
                <h4 class="alert-heading">Erro</h4>
                <p>O evento não pôde ser adicionado.</p>
                <hr>
                <p class="mb-0">
                    <a href="?menuop=events">Voltar para a lista de eventos.</a>
                </p>
            </div>';
        }
        $stmt->close();
    } else {
        die("Erro na preparação da consulta: " . $conect->error);
    }
} else {
    die("Dados do formulário não enviados.");
}
?>
