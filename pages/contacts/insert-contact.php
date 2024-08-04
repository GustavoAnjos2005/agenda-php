<?php
if (isset($_POST["btnAdd"])) {
    $nomeContato = trim($_POST["nomeContato"]);
    $emailContato = trim($_POST["emailContato"]);
    $telefoneContato = $_POST["telefoneContato"];
    $enderecoContato = $_POST["enderecoContato"];
    $sexoContato = $_POST["sexoContato"];
    $dataNascimentoContato = $_POST["dataNascimentoContato"];

    // Verificar se os campos obrigatórios estão preenchidos
    if (empty($nomeContato) || empty($emailContato) || empty($telefoneContato) || empty($enderecoContato)) {
        die("Por favor, preencha todos os campos obrigatórios.");
    }

    $sql = "INSERT INTO dbcontatos (nomeContato, emailContato, telefoneContato, enderecoContato, sexoContato, dataNascimentoContato) 
            VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conect->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("ssssss", $nomeContato, $emailContato, $telefoneContato, $enderecoContato, $sexoContato, $dataNascimentoContato);
        if ($stmt->execute()) {
            echo '<div class="alert alert-success" role="alert">
                <h4 class="alert-heading">Novo Contato</h4>
                <p>Contato adicionado com sucesso!</p>
                <hr>
                <p class="mb-0">
                    <a href="?menuop=contacts">Voltar para a lista de contatos.</a>
                </p>
            </div>';
        } else {
            echo '<div class="alert alert-danger" role="alert">
                <h4 class="alert-heading">Erro</h4>
                <p>O contato não pode ser adicionado.</p>
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
    die("Dados do formulário não enviados.");
}
?>
