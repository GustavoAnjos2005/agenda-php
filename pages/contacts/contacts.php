<?php
// Variavel da pesquisa
$txt_pesquisa = (isset($_POST['txt_pesquisa'])) ? $_POST['txt_pesquisa'] : "";
?>
<header>
    <h3><i class="bi bi-person-square"></i> Contatos</h3>
</header>
<div>
    <a class="btn btn-outline-secondary mb-2" href="?menuop=cad-contacts"><i class="bi bi-person-plus-fill"></i> Novo
        Contato</a>
</div>
<div>
    <form action="index.php?menuop=contacts" method="post">
        <div class="input-group">
            <input class="form-control" type="text" name="txt_pesquisa" value="<?= $txt_pesquisa ?>">
            <button class="btn btn-outline-success btn-sm" type="submit"><i class="bi bi-search"></i> Pesquisar</button>
        </div>
    </form>
</div>
<div class="tabela">
    <table class="table table-dark table-striped table-bordered table-sm">
        <thead>
            <tr>
                <th>
                    <i class="bi bi-star-fill"></i>
                </th>
                <th>ID</th>
                <th>Nome</th>
                <th>E-Mail</th>
                <th>Telefone</th>
                <th>Endereço</th>
                <th>Sexo</th>
                <th>Data de Nascimento</th>
                <th>Editar</th>
                <th>Excluir</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $quantify = 10;

            $page = (isset($_GET['page'])) ? (int) $_GET['page'] : 1;

            $start = ($quantify * $page) - $quantify;

            $sql = "SELECT
    idContato,
    upper(nomeContato) AS nomeContato,
    lower(emailContato) AS emailContato,
    telefoneContato,
    upper(enderecoContato) AS enderecoContato,
    CASE
	WHEN sexoContato='F' THEN 'FEMININO'
    WHEN sexoContato='M' THEN 'MASCULINO'
    ELSE
    'NÃO ESPECIFICADO'
    END AS sexoContato,
    DATE_FORMAT(dataNascimentoContato,'%d/%m/%Y') AS dataNascimentoContato,
    flagFavoritoContato
    FROM dbcontatos 
    WHERE idContato='{$txt_pesquisa}' or
    nomeContato LIKE '%{$txt_pesquisa}%'
    ORDER BY flagFavoritoContato DESC, nomeContato ASC
    LIMIT $start, $quantify
    ";
            $rs = mysqli_query($conect, $sql) or die("Erro ao executar a consulta!" . mysqli_error($conect));
            while ($dados = mysqli_fetch_assoc($rs)) {

                ?>
                <tr>
                    <td>
                        <?php
                        if ($dados["flagFavoritoContato"] == 1) {
                            echo "<a href=\"#\" class=\"flagFavoritoContato link-warning\" title=\"Favorito\" id=\"{$dados["idContato"]}\">
                                <i class=\"bi bi-star-fill\"></i>
                                </a>";
                        } else {
                            echo "<a href=\"#\" class=\"flagFavoritoContato link-warning\" title=\"Não Favorito\" id=\"{$dados["idContato"]}\">
                                <i class=\"bi bi-star\"></i>
                                </a>";
                        }
                        ?>
                    </td>
                    <td><?= $dados["idContato"] ?></td>
                    <td><?= $dados["nomeContato"] ?></td>
                    <td><?= $dados["emailContato"] ?></td>
                    <td><?= $dados["telefoneContato"] ?></td>
                    <td><?= $dados["enderecoContato"] ?></td>
                    <td><?= $dados["sexoContato"] ?></td>
                    <td><?= $dados["dataNascimentoContato"] ?></td>
                    <td class="text-center"><a class="btn btn-outline-warning btn-sm"
                            href="index.php?menuop=edit-contact&idContato=<?= $dados["idContato"] ?>"><i
                                class="bi bi-pencil-square"></i></a></td>
                    <td class="text-center"><a class="btn btn-outline-danger btn-sm"
                            href="index.php?menuop=delete-contact&idContato=<?= $dados["idContato"] ?>"><i
                                class="bi bi-trash-fill"></i></a></td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
</div>

<ul class="pagination justify-content-center">
    <?php

    $sqlTotal = "SELECT idContato FROM dbcontatos";
    $qrTotal = mysqli_query($conect, $sqlTotal) or die(mysqli_error($conect));
    $numTotal = mysqli_num_rows($qrTotal);
    $totalPage = ceil($numTotal / $quantify);
    echo "<li class='page-item'><span class='page-link'>Total de registros: " . $numTotal . " </span></li> ";
    echo '<li class="page-item"><a class="page-link" href="?menuop=contacts&pagea=1">Primeira Pagina</a></li>';

    if ($page > 6) {
        ?>
        <li class="page-item"><a class="page-link" href="?menuop=contacts&page=<?php echo $page - 1 ?>">
                <<< /a>
        </li>
        <?php
    }

    for ($i = 1; $i <= $totalPage; $i++) {
        if ($i >= ($page - 5) && $i <= ($page + 5)) {
            if ($i == $page) {
                echo "<li class='page-item active'><span class='page-link'>$i</span></li>";
                ;
            } else {
                echo "<li class='page-item'><a class='page-link' href=\"?menuop=contacts&page={$i}\"> {$i} </a></li>";
            }
        }
    }

    if ($page < $totalPage - 5) {
        ?>
        <li class="page-item"><a class="page-link" href="?menuop=contacts&page=<?php echo $page + 1 ?>">>></a></li>
        <?php
    }
    echo "<li class='page-item'> <a class='page-link' href=\"?menuop=contacts&page=$totalPage\">Ultima Pagina</a></li>";


    ?>
</ul>