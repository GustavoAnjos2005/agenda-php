<?php
$idTarefa = $_POST["idTarefa"];
$tituloTarefa = $_POST["tituloTarefa"];
$descricaoTarefa = $_POST["descricaoTarefa"];
$dataConclusaoTarefa = $_POST["dataConclusaoTarefa"];
$horaConclusaoTarefa = $_POST["horaConclusaoTarefa"];
$dataLembreteTarefa = $_POST["dataLembreteTarefa"];
$horaLembreteTarefa = $_POST["horaLembreteTarefa"];
$recorrenciaTarefa = $_POST["recorrenciaTarefa"];

$sql = "UPDATE dbtarefas 
        SET tituloTarefa = '{$tituloTarefa}', 
            descricaoTarefa = '{$descricaoTarefa}', 
            dataConclusaoTarefa = '{$dataConclusaoTarefa}', 
            horaConclusaoTarefa = '{$horaConclusaoTarefa}', 
            dataLembreteTarefa = '{$dataLembreteTarefa}', 
            horaLembreteTarefa = '{$horaLembreteTarefa}', 
            recorrenciaTarefa = '{$recorrenciaTarefa}' 
        WHERE idTarefa = '{$idTarefa}'";

$rs = mysqli_query($conect, $sql) or die("Erro ao atualizar a tarefa" . mysqli_error($conect));

if ($rs) {
    ?>
    <div class="alert alert-success" role="alert">
        <h4 class="alert-heading">Editar Tarefa</h4>
        <p>Tarefa editada com sucesso!</p>
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
        <p>A tarefa não pode ser editada.</p>
        <hr>
        <p class="mb-0">
            <a href="?menuop=tasks">Voltar para a lista de tarefas.</a>
        </p>
    </div>
    <?php
}
?>
