<header>
    <h3>Excluir Evento</h3>
</header>

<?php
if (isset($_GET["idEvento"])) {
    $idEvento = intval($_GET["idEvento"]);
    $sql = "DELETE FROM dbeventos WHERE idEvento = ?";
    $stmt = $conect->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("i", $idEvento);
        if ($stmt->execute()) {
            echo '<div class="alert alert-success" role="alert">
                <h4 class="alert-heading">Excluir Evento</h4>
                <p>Evento excluído com sucesso!</p>
                <hr>
                <p class="mb-0">
                    <a href="?menuop=events">Voltar para a lista de eventos.</a>
                </p>
            </div>';
        } else {
            echo '<div class="alert alert-danger" role="alert">
                <h4 class="alert-heading">Erro</h4>
                <p>O evento não pode ser excluído.</p>
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
    die("ID do evento não fornecido.");
}
?>
