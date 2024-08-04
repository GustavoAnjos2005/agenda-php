<header>
    <h3><i class="bi bi-calendar-check"></i> Eventos</h3>
</header>

<?php
$txt_pesquisa = isset($_POST['txt_pesquisa']) ? $_POST['txt_pesquisa'] : "";

// Alterar o status entre completo ou incompleto
$idEvento = isset($_GET['idEvento']) ? intval($_GET['idEvento']) : null;
$statusEvento = (isset($_GET['statusEvento']) && $_GET['statusEvento'] == '0') ? 1 : 0;

if ($idEvento !== null) {
    $sql = "UPDATE dbeventos SET statusEvento = ? WHERE idEvento = ?";
    $stmt = $conect->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("ii", $statusEvento, $idEvento);
        if (!$stmt->execute()) {
            die("Erro ao atualizar o status do evento: " . $stmt->error);
        }
        $stmt->close();
    } else {
        die("Erro na preparação da consulta: " . $conect->error);
    }
}
?>

<div>
    <a class="btn btn-outline-secondary mb-2" href="?menuop=cad-events"><i class="bi bi-calendar-check"></i> Novo Evento</a>
</div>
<div>
    <form action="index.php?menuop=events" method="post">
        <div class="input-group">
            <input class="form-control" type="text" name="txt_pesquisa" value="<?= htmlspecialchars($txt_pesquisa) ?>">
            <button class="btn btn-outline-success btn-sm" type="submit"><i class="bi bi-search"></i> Pesquisar</button>
        </div>
    </form>
</div>
<div class="tabela">
    <table class="table table-dark table-striped table-bordered table-sm">
        <thead>
            <tr>
                <th>Status</th>
                <th>Título</th>
                <th>Descrição</th>
                <th>Data de Início</th>
                <th>Hora de Início</th>
                <th>Data de Fim</th>
                <th>Hora de Fim</th>
                <th>Editar</th>
                <th>Excluir</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $quantify = 10;
            $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
            $start = ($quantify * $page) - $quantify;

            $sql = "SELECT
                        idEvento,
                        statusEvento,
                        tituloEvento,
                        descricaoEvento,
                        DATE_FORMAT(dataInicioEvento, '%d/%m/%Y') AS dataInicioEvento,
                        horaInicioEvento,
                        DATE_FORMAT(dataFimEvento, '%d/%m/%Y') AS dataFimEvento,
                        horaFimEvento
                    FROM dbeventos
                    WHERE tituloEvento LIKE ? OR descricaoEvento LIKE ? OR DATE_FORMAT(dataInicioEvento, '%d/%m/%Y') LIKE ?
                    ORDER BY statusEvento, dataInicioEvento
                    LIMIT ?, ?";
            $stmt = $conect->prepare($sql);
            $search_param = '%' . $txt_pesquisa . '%';
            $stmt->bind_param("ssssi", $search_param, $search_param, $search_param, $start, $quantify);
            $stmt->execute();
            $result = $stmt->get_result();

            while ($dados = $result->fetch_assoc()) {
                ?>
                <tr>
                    <td>
                        <a class="btn btn-secondary btn-sm"
                            href="index.php?menuop=events&page=<?= $page ?>&idEvento=<?= $dados['idEvento'] ?>&statusEvento=<?= $dados['statusEvento'] ?>">
                            <?php
                            if ($dados['statusEvento'] == 0) {
                                echo '<i class="bi bi-square"></i>';
                            } else {
                                echo '<i class="bi bi-check-square"></i>';
                            }
                            ?>
                        </a>
                    </td>
                    <td><?= htmlspecialchars($dados["tituloEvento"]) ?></td>
                    <td><?= htmlspecialchars($dados["descricaoEvento"]) ?></td>
                    <td><?= htmlspecialchars($dados["dataInicioEvento"]) ?></td>
                    <td><?= htmlspecialchars($dados["horaInicioEvento"]) ?></td>
                    <td><?= htmlspecialchars($dados["dataFimEvento"]) ?></td>
                    <td><?= htmlspecialchars($dados["horaFimEvento"]) ?></td>
                    <td class="text-center"><a class="btn btn-outline-warning btn-sm"
                            href="index.php?menuop=edit-events&idEvento=<?= $dados["idEvento"] ?>"><i
                                class="bi bi-pencil-square"></i></a></td>
                    <td class="text-center"><a class="btn btn-outline-danger btn-sm"
                            href="index.php?menuop=delete-events&idEvento=<?= $dados["idEvento"] ?>"><i
                                class="bi bi-trash-fill"></i></a></td>
                </tr>
                <?php
            }
            $stmt->close();
            ?>
        </tbody>
    </table>
</div>

<ul class="pagination justify-content-center">
    <?php
    $sqlTotal = "SELECT COUNT(idEvento) as total FROM dbeventos";
    $resultTotal = $conect->query($sqlTotal);
    $rowTotal = $resultTotal->fetch_assoc();
    $numTotal = $rowTotal['total'];
    $totalPage = ceil($numTotal / $quantify);
    echo "<li class='page-item'><span class='page-link'>Total de registros: " . $numTotal . " </span></li> ";
    echo '<li class="page-item"><a class="page-link" href="?menuop=events&page=1">Primeira Página</a></li>';

    if ($page > 1) {
        echo '<li class="page-item"><a class="page-link" href="?menuop=events&page=' . ($page - 1) . '"><<</a></li>';
    }

    for ($i = 1; $i <= $totalPage; $i++) {
        if ($i >= ($page - 5) && $i <= ($page + 5)) {
            if ($i == $page) {
                echo "<li class='page-item active'><span class='page-link'>$i</span></li>";
            } else {
                echo "<li class='page-item'><a class='page-link' href=\"?menuop=events&page={$i}\">{$i}</a></li>";
            }
        }
    }

    if ($page < $totalPage) {
        echo '<li class="page-item"><a class="page-link" href="?menuop=events&page=' . ($page + 1) . '">>></a></li>';
    }
    echo "<li class='page-item'><a class='page-link' href=\"?menuop=events&page=$totalPage\">Última Página</a></li>";
    ?>
</ul>

<?php $conect->close(); ?>
