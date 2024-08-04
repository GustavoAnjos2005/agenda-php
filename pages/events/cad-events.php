<header>
    <h3><i class="bi bi-calendar-check"></i> Cadastro de Eventos</h3>
</header>
<div>
    <form class="needs-validation" action="index.php?menuop=insert-events" method="post" novalidate>
        <div class="mb-3">
            <label for="tituloEvento" class="form-label">Título</label>
            <input class="form-control" type="text" name="tituloEvento" id="tituloEvento" required>
        </div>
        <div class="mb-3">
            <label for="descricaoEvento" class="form-label">Descrição</label>
            <textarea class="form-control" cols="30" rows="5" name="descricaoEvento" id="descricaoEvento" required></textarea>
        </div>
        <div class="row">
            <div class="mb-3 col-3">
                <label class="form-label" for="dataInicioEvento">Data de Início</label>
                <input class="form-control" type="date" name="dataInicioEvento" id="dataInicioEvento" required>
            </div>
            <div class="mb-3 col-3">
                <label class="form-label" for="horaInicioEvento">Hora de Início</label>
                <input class="form-control" type="time" name="horaInicioEvento" id="horaInicioEvento" required>
            </div>
        </div>
        <div class="row">
            <div class="mb-3 col-3">
                <label class="form-label" for="dataFimEvento">Data de Fim</label>
                <input class="form-control" type="date" name="dataFimEvento" id="dataFimEvento">
            </div>
            <div class="mb-3 col-3">
                <label class="form-label" for="horaFimEvento">Hora de Fim</label>
                <input class="form-control" type="time" name="horaFimEvento" id="horaFimEvento">
            </div>
        </div>
        <div class="mb-3">
            <input class="btn btn-primary" type="submit" value="Adicionar" name="btnAdd">
        </div>
    </form>
</div>
