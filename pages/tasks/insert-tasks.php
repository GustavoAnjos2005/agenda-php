<?php
$tituloTarefa = $_POST["tituloTarefa"];
$descricaoTarefa = $_POST["descricaoTarefa"];
$dataConclusaoTarefa = $_POST["dataConclusaoTarefa"];
$horaConclusaoTarefa = $_POST["horaConclusaoTarefa"];
$dataLembreteTarefa = $_POST["dataLembreteTarefa"];
$horaLembreteTarefa = $_POST["horaLembreteTarefa"];
$recorrenciaTarefa = $_POST["recorrenciaTarefa"];

$sql = "INSERT INTO dbtarefas (tituloTarefa, descricaoTarefa, dataConclusaoTarefa, horaConclusaoTarefa, dataLembreteTarefa, horaLembreteTarefa, recorrenciaTarefa) 
        VALUES ('$tituloTarefa', '$descricaoTarefa', '$dataConclusaoTarefa', '$horaConclusaoTarefa', '$dataLembreteTarefa', '$horaLembreteTarefa', '$recorrenciaTarefa')";

$rs = mysqli_query($conect, $sql) or die("Erro ao adicionar a tarefa" . mysqli_error($conect));

if ($rs) {
    ?>
    <div class="alert alert-success" role="alert">
        <h4 class="alert-heading">Cadastro de Tarefa</h4>
        <p>Tarefa adicionada com sucesso!</p>
        <hr>
        <p class="mb-0">
            <a href="?menuop=tasks">Voltar para a lista de tarefas.</a>
        </p>
    </div>
    <?php
} else {
    ?>
    <div class="alert alert-danger" role="alert">
        <h4 class="alert-heading">Erro</h4>
        <p>A tarefa não pode ser adicionada.</p>
        <hr>
        <p class="mb-0">
            <a href="?menuop=tasks">Voltar para a lista de tarefas.</a>
        </p>
    </div>
    <?php
}
?>
