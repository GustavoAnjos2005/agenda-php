<header>
    <h3>Excluir Contato</h3>
</header>

<?php
if (isset($_GET["idContato"])) {
    $idContato = intval($_GET["idContato"]);
    $sql = "DELETE FROM dbcontatos WHERE idContato = ?";
    $stmt = $conect->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("i", $idContato);
        if ($stmt->execute()) {
            echo '<div class="alert alert-success" role="alert">
                <h4 class="alert-heading">Excluir Contato</h4>
                <p>Contato excluído com sucesso!</p>
                <hr>
                <p class="mb-0">
                    <a href="?menuop=contacts">Voltar para a lista de Contatos.</a>
                </p>
            </div>';
        } else {
            echo '<div class="alert alert-danger" role="alert">
                <h4 class="alert-heading">Erro</h4>
                <p>O contato não pode ser excluído.</p>
                <hr>
                <p class="mb-0">
                    <a href="?menuop=contacts">Voltar para a lista de contatos.</a>
                </p>
            </div>';
        }
        $stmt->close();
    } else {
        die("Erro na preparação da consulta: " . $conect->error);
    }
} else {
    die("ID do Contato não fornecido.");
}
?>
