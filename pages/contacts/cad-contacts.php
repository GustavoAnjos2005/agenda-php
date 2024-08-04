<header>
    <h3><i class="bi bi-person-square"></i> Cadastro de Contato</h3>
</header>
<div >
    <form class="needs-validation" action="index.php?menuop=insert-contact" method="post" novalidate>
        <div class="mb-3">
            <label class="form-label" for="nomeContato">Nome</label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                <input class="form-control" type="text" name="nomeContato" required>
                <div class="valid-tooltip">
                    Está correto.
                </div>
                <div class="invalid-tooltip">
                    Campo obrigatório de no máximo 255 caracteres
                </div>
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label" for="emailContato">E-Mail</label>
            <div class="input-group">
                <span class="input-group-text">@</span>
                <input class="form-control" type="email" name="emailContato" required>
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label" for="telefoneContato">Telefone</label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-telephone-fill"></i></span>
                <input class="form-control" type="text" name="telefoneContato" required>
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label" for="enderecoContato">Endereço</label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-mailbox2"></i></span>
                <input class="form-control" type="text" name="enderecoContato" required>
            </div>
        </div>
        <div class="mb-3 col-3">
            <label class="form-label" for="sexoContato">Sexo</label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-gender-ambiguous"></i></span>
                <select class="form-select" name="sexoContato" id="sexoContato" required>
                    <option selected value="">Selecione o sexo</option>
                    <option value="M">Masculino</option>
                    <option value="F">Feminino</option>
                </select>
            </div>
        </div>
        <div class="mb-3 col-3">
            <label class="form-label" for="dataNascimentoContato">Data de Nascimento</label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-calendar"></i></span>
                <input class="form-control" type="date" name="dataNascimentoContato" required>
            </div>
        </div>
        <div class="mb-3">
            <input class="btn btn-primary" type="submit" value="Adicionar" name="btnAdd">
        </div>
    </form>
</div>