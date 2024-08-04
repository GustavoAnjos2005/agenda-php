<?php
if (isset($_POST["btnPath"])) {
    $idContato = intval($_POST["idContato"]);
    $emailContato = trim($_POST["emailContato"]);
    $telefoneContato = trim($_POST["telefoneContato"]);
    $enderecoContato = $_POST["enderecoContato"];
    $sexoContato = $_POST["sexoContato"];
    $dataNascimentoContato = $_POST["dataNascimentoContato"];

    // Verificar se os campos obrigatórios estão preenchidos
    if (empty($emailContato) || empty($telefoneContato) || empty($enderecoContato) || empty($sexoContato)) {
        die("Por favor, preencha todos os campos obrigatórios.");
    }

    $sql = "UPDATE dbcontatos 
            SET emailContato = ?, telefoneContato = ?, enderecoContato = ?, sexoContato = ?, dataNascimentoContato = ?
            WHERE idContato = ?";
    $stmt = $conect->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("ssssss", $emailContato, $telefoneContato, $enderecoContato, $sexoContato, $dataNascimentoContato, $idContato);
        if ($stmt->execute()) {
            echo '<div class="alert alert-success" role="alert">
                <h4 class="alert-heading">Editar Contato</h4>
                <p>Contato atualizado com sucesso!</p>
                <hr>
                <p class="mb-0">
                    <a href="?menuop=contacts">Voltar para a lista de Contatos.</a>
                </p>
            </div>';
        } else {
            echo '<div class="alert alert-danger" role="alert">
                <h4 class="alert-heading">Erro</h4>
                <p>O contato não pode ser atualizado.</p>
                <hr>
                <p class="mb-0">
                    <a href="?menuop=contacts">Voltar para a lista de Contatos.</a>
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
