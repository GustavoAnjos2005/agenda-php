<header>
    <h3>
        <i class="bi bi-list-task"></i> Cadastro de Tarefa
    </h3>
</header>
<div>
    <form class="needs-validation" action="index.php?menuop=insert-tasks" method="post" novalidate>
        <div class="mb-3">
            <label for="tituloTarefa" class="form-label">Título</label>
            <input class="form-control" type="text" name="tituloTarefa" id="tituloTarefa" required>
        </div>
        <div class="mb-3">
            <label for="descricaoTarefa" class="form-label">Descrição</label>
            <textarea class="form-control" cols="30" rows="5" name="descricaoTarefa" id="descricaoTarefa" required></textarea>
        </div>
        <div class="row">
            <div class="mb-3 col-3">
                <label class="form-label" for="dataConclusaoTarefa">Data de Conclusão</label>
                <input class="form-control" type="date" name="dataConclusaoTarefa" id="dataConclusaoTarefa" required>
            </div>
            <div class="mb-3 col-3">
                <label class="form-label" for="horaConclusaoTarefa">Hora de Conclusão</label>
                <input class="form-control" type="time" name="horaConclusaoTarefa" id="horaConclusaoTarefa" required>
            </div>
        </div>
        <div class="row">
            <div class="mb-3 col-3">
                <label class="form-label" for="dataLembreteTarefa">Data de Lembrete</label>
                <input class="form-control" type="date" name="dataLembreteTarefa" id="dataLembreteTarefa">
            </div>
            <div class="mb-3 col-3">
                <label class="form-label" for="horaLembreteTarefa">Hora de Lembrete</label>
                <input class="form-control" type="time" name="horaLembreteTarefa" id="horaLembreteTarefa">
            </div>
        </div>
        <div class="row">
            <div class="mb-3 col-3">
                <label for="recorrenciaTarefa" class="form-label">Recorrência</label>
                <select name="recorrenciaTarefa" id="recorrenciaTarefa" class="form-select">
                    <option value="0">Não Recorrente</option>
                    <option value="1">Diariamente</option>
                    <option value="2">Semanalmente</option>
                    <option value="3">Mensalmente</option>
                    <option value="4">Anualmente</option>
                </select>
            </div>
        </div>
        <div class="mb-3">
            <input class="btn btn-primary" type="submit" value="Adicionar" name="btnAdd">
        </div>
    </form>
</div>
