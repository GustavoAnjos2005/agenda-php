<?php
if (isset($_GET["idEvento"])) {
    $idEvento = intval($_GET["idEvento"]);

    $sql = "SELECT * FROM dbeventos WHERE idEvento = ?";
    $stmt = $conect->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("i", $idEvento);
        $stmt->execute();
        $result = $stmt->get_result();
        $dados = $result->fetch_assoc();
        $stmt->close();
    } else {
        die("Erro na preparação da consulta: " . $conect->error);
    }
} else {
    die("ID do evento não fornecido.");
}
?>
<header>
    <h3><i class="bi bi-calendar-check"></i> Editar Evento</h3>
</header>
<div>
    <form class="needs-validation" action="index.php?menuop=path-events" method="post" novalidate>
        <div class="mb-3 col-3">
            <label for="idEvento" class="form-label">ID</label>
            <input class="form-control" type="text" name="idEvento" id="idEvento" value="<?= htmlspecialchars($dados["idEvento"]) ?>" readonly>
        </div>
        <div class="mb-3">
            <label for="tituloEvento" class="form-label">Título</label>
            <input class="form-control" type="text" name="tituloEvento" id="tituloEvento" value="<?= htmlspecialchars($dados["tituloEvento"]) ?>" required>
        </div>
        <div class="mb-3">
            <label for="descricaoEvento" class="form-label">Descrição</label>
            <textarea name="descricaoEvento" id="descricaoEvento" cols="30" rows="5" class="form-control" required><?= htmlspecialchars($dados["descricaoEvento"]) ?></textarea>
        </div>
        <div class="row">
            <div class="mb-3 col-3">
                <label class="form-label" for="dataInicioEvento">Data de Início</label>
                <input class="form-control" type="date" name="dataInicioEvento" id="dataInicioEvento" value="<?= htmlspecialchars($dados["dataInicioEvento"]) ?>" required>
            </div>
            <div class="mb-3 col-3">
                <label class="form-label" for="horaInicioEvento">Hora de Início</label>
                <input class="form-control" type="time" name="horaInicioEvento" id="horaInicioEvento" value="<?= htmlspecialchars($dados["horaInicioEvento"]) ?>" required>
            </div>
        </div>
        <div class="row">
            <div class="mb-3 col-3">
                <label class="form-label" for="dataFimEvento">Data de Fim</label>
                <input class="form-control" type="date" name="dataFimEvento" id="dataFimEvento" value="<?= htmlspecialchars($dados["dataFimEvento"]) ?>">
            </div>
            <div class="mb-3 col-3">
                <label class="form-label" for="horaFimEvento">Hora de Fim</label>
                <input class="form-control" type="time" name="horaFimEvento" id="horaFimEvento" value="<?= htmlspecialchars($dados["horaFimEvento"]) ?>">
            </div>
        </div>
        <div class="mb-3">
            <input class="btn btn-warning" type="submit" value="Atualizar" name="btnPath">
        </div>
    </form>
</div>
