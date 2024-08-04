<?php
// Variável de pesquisa
$txt_pesquisa = isset($_POST['txt_pesquisa']) ? $_POST['txt_pesquisa'] : "";

// Alterar o status entre completo ou incompleto
$idTarefa = isset($_GET['idTarefa']) ? intval($_GET['idTarefa']) : null;
$statusTarefa = (isset($_GET['statusTarefa']) && $_GET['statusTarefa'] == '0') ? 1 : 0;

if ($idTarefa !== null) {
    $sql = "UPDATE dbtarefas SET statusTarefa = ? WHERE idTarefa = ?";
    $stmt = $conect->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("ii", $statusTarefa, $idTarefa);
        if (!$stmt->execute()) {
            die("Erro ao atualizar o status da tarefa: " . $stmt->error);
        }
        $stmt->close();
    } else {
        die("Erro na preparação da consulta: " . $conect->error);
    }
}

?>

<header>
    <h3><i class="bi bi-list-task"></i> Tarefas</h3>
</header>
<div>
    <a class="btn btn-outline-secondary mb-2" href="?menuop=cad-tasks"><i class="bi bi-list-task"></i> Nova Tarefa</a>
</div>
<div>
    <form action="index.php?menuop=tasks" method="post">
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
                <th>Data da Conclusão</th>
                <th>Hora da Conclusão</th>
                <th>Editar</th>
                <th>Excluir</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $quantify = 10;
            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
            $start = ($quantify * $page) - $quantify;

            $sql = "SELECT
                        idTarefa,
                        statusTarefa,
                        tituloTarefa,
                        descricaoTarefa,
                        DATE_FORMAT(dataConclusaoTarefa, '%d/%m/%Y') AS dataConclusaoTarefa,
                        horaConclusaoTarefa
                    FROM dbtarefas
                    WHERE tituloTarefa LIKE ? OR descricaoTarefa LIKE ? OR DATE_FORMAT(dataConclusaoTarefa, '%d/%m/%Y') LIKE ?
                    ORDER BY statusTarefa, dataConclusaoTarefa
                    LIMIT ?, ?";
            $stmt = $conect->prepare($sql);
            $search_param = '%' . $txt_pesquisa . '%';
            $stmt->bind_param("sssss", $search_param, $search_param, $search_param, $start, $quantify);
            $stmt->execute();
            $result = $stmt->get_result();

            while ($dados = $result->fetch_assoc()) {
            ?>
                <tr>
                    <td>
                        <a class="btn btn-secondary btn-sm" href="index.php?menuop=tasks&page=<?= $page ?>&idTarefa=<?= $dados['idTarefa'] ?>&statusTarefa=<?= $dados['statusTarefa'] ?>">
                            <?php
                            if ($dados['statusTarefa'] == 0) {
                                echo '<i class="bi bi-square"></i>';
                            } else {
                                echo '<i class="bi bi-check-square"></i>';
                            }
                            ?>
                        </a>
                    </td>
                    <td><?= htmlspecialchars($dados["tituloTarefa"]) ?></td>
                    <td><?= htmlspecialchars($dados["descricaoTarefa"]) ?></td>
                    <td><?= htmlspecialchars($dados["dataConclusaoTarefa"]) ?></td>
                    <td><?= htmlspecialchars($dados["horaConclusaoTarefa"]) ?></td>
                    <td class="text-center"><a class="btn btn-outline-warning btn-sm" href="index.php?menuop=edit-tasks&idTarefa=<?= $dados["idTarefa"] ?>"><i class="bi bi-pencil-square"></i></a></td>
                    <td class="text-center"><a class="btn btn-outline-danger btn-sm" href="index.php?menuop=delete-tasks&idTarefa=<?= $dados["idTarefa"] ?>"><i class="bi bi-trash-fill"></i></a></td>
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
    $sqlTotal = "SELECT COUNT(idTarefa) as total FROM dbtarefas";
    $resultTotal = $conect->query($sqlTotal);
    $rowTotal = $resultTotal->fetch_assoc();
    $numTotal = $rowTotal['total'];
    $totalPage = ceil($numTotal / $quantify);
    echo "<li class='page-item'><span class='page-link'>Total de registros: " . $numTotal . " </span></li> ";
    echo '<li class="page-item"><a class="page-link" href="?menuop=tasks&page=1">Primeira Página</a></li>';

    if ($page > 1) {
        echo '<li class="page-item"><a class="page-link" href="?menuop=tasks&page=' . ($page - 1) . '"><<</a></li>';
    }

    for ($i = 1; $i <= $totalPage; $i++) {
        if ($i >= ($page - 5) && $i <= ($page + 5)) {
            if ($i == $page) {
                echo "<li class='page-item active'><span class='page-link'>$i</span></li>";
            } else {
                echo "<li class='page-item'><a class='page-link' href=\"?menuop=tasks&page={$i}\">{$i}</a></li>";
            }
        }
    }

    if ($page < $totalPage) {
        echo '<li class="page-item"><a class="page-link" href="?menuop=tasks&page=' . ($page + 1) . '">>></a></li>';
    }
    echo "<li class='page-item'><a class='page-link' href=\"?menuop=tasks&page=$totalPage\">Última Página</a></li>";
    ?>
</ul>

<?php $conect->close(); ?>
