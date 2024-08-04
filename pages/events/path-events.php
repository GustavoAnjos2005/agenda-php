<?php
if (isset($_POST["btnPath"])) {
    $idEvento = intval($_POST["idEvento"]);
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

    $sql = "UPDATE dbeventos 
            SET tituloEvento = ?, descricaoEvento = ?, dataInicioEvento = ?, horaInicioEvento = ?, dataFimEvento = ?, horaFimEvento = ? 
            WHERE idEvento = ?";
    $stmt = $conect->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("ssssssi", $tituloEvento, $descricaoEvento, $dataInicioEvento, $horaInicioEvento, $dataFimEvento, $horaFimEvento, $idEvento);
        if ($stmt->execute()) {
            echo '<div class="alert alert-success" role="alert">
                <h4 class="alert-heading">Editar Evento</h4>
                <p>Evento atualizado com sucesso!</p>
                <hr>
                <p class="mb-0">
                    <a href="?menuop=events">Voltar para a lista de eventos.</a>
                </p>
            </div>';
        } else {
            echo '<div class="alert alert-danger" role="alert">
                <h4 class="alert-heading">Erro</h4>
                <p>O evento não pôde ser atualizado.</p>
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
