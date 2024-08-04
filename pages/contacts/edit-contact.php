<?php
$idContato = $_GET["idContato"];

$sql = "SELECT * FROM dbcontatos WHERE idContato= {$idContato}";
$rs = mysqli_query($conect, $sql) or die("Erro ao recuperar os dados do registro. " . mysqli_error($conect));
$dados = mysqli_fetch_assoc($rs);
?>

<header>
    <h3>Editar Contato</h3>
</header>

<div class="row">
    <div class="col-6">
        <form action="index.php?menuop=path-contact" method="post">
            <div class="mb-3">
                <label class="form-label" for="idContato">ID</label>
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="bi bi-key-fill"></i>
                    </span>
                    <input class="form-control" type="text" name="idContato" value="<?= $dados["idContato"] ?>"
                        readonly>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label" for="nomeContato">Nome</label>
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="bi bi-person-fill"></i>
                    </span>
                    <input class="form-control" type="text" name="nomeContato" value="<?= $dados["nomeContato"] ?>">
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label" for="emailContato">E-Mail</label>
                <div class="input-group">
                    <span class="input-group-text">@</span>
                    <input class="form-control" type="email" name="emailContato" value="<?= $dados["emailContato"] ?>">
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label" for="telefoneContato">Telefone</label>
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="bi bi-telephone-fill"></i>
                    </span>
                    <input class="form-control" type="text" name="telefoneContato"
                        value="<?= $dados["telefoneContato"] ?>">
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label" for="enderecoContato">Endereço</label>
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="bi bi-mailbox2"></i>
                    </span>
                    <input class="form-control" type="text" name="enderecoContato"
                        value="<?= $dados["enderecoContato"] ?>">
                </div>
            </div>
            <div class="mb-3 col-3">
                <label class="form-label" for="sexoContato">Sexo</label>
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="bi bi-gender-ambiguous"></i>
                    </span>
                    <select class="form-select" name="sexoContato" id="sexoContato">
                        <option <?php echo ($dados['sexoContato'] == '') ? 'selected' : '' ?> value="">Selecione o gênero
                            do Contato
                        </option>
                        <option <?php echo ($dados['sexoContato'] == 'M') ? 'selected' : 'M' ?> value="M">Masculino
                        </option>
                        <option <?php echo ($dados['sexoContato'] == 'F') ? 'selected' : 'F' ?> value="F">Feminino
                        </option>
                        <option <?php echo ($dados['sexoContato'] == 'O') ? 'selected' : 'O' ?> value="O">Outros</option>
                    </select>
                </div>
            </div>
            <div class="mb-3 col-3">
                <label class="form-label" for="dataNascimentoContato">Data de Nascimento</label>
                <input class="form-control" type="date" name="dataNascimentoContato"
                    value="<?= $dados["dataNascimentoContato"] ?>">
            </div>
            <div class="mb-3">
                <input class="btn btn-warning" type="submit" value="Atualizar" name="btnPath">
            </div>
        </form>
    </div>
    <div class="col-6">
        <?php
        if ($dados["nomeFotoContato"] == "" || !file_exists('./pages/contacts/photos-contacts/' . $dados["nomeFotoContato"])) {
            $nomeFoto = "SemFoto.jpg";
        } else {
            $nomeFoto = $dados["nomeFotoContato"];
        }
        ?>
        <div class="mb-3">
            <img id="foto-contato" class="img-fluid img-thumbnail" width="200"
                src="./pages/contacts/photos-contacts/<?= $nomeFoto ?>" alt="Foto do Contato">
        </div>

        <div class="mb-3">
            <button class="btn btn-info" id="btn-editar-foto">
                <i class="bi bi-camera-fill"></i> Editar Foto
            </button>
        </div>
        <div id="editar-foto">
            <form id="form-upload-foto" class="mb-3" action="" method="post" enctype="multipart/form-data">
                <input type="hidden" name="idContato" value="<?= $idContato ?>">
                <label class="form-label" for="arquivo">Selecione um arquivo de imagem</label>
                <div class="input-group">
                    <input class="form-control" type="file" name="arquivo" id="arquivo">
                    <input id="btn-enviar-foto" class="btn btn-secondary" type="submit" value="Enviar">
                </div>
            </form>
            <div id="mensagem" class="mb-3 alert alert-success">

            </div>
            <div id="preloader" class="progress">
                <div id="barra" class="progress-bar bg-danger" role="progressbar" style="width: 0%" aria-valuenow="0"
                    aria-valuemin="0" aria-valuemax="100">0%</div>
            </div>
        </div>
    </div>
</div>