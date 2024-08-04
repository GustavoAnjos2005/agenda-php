$(document).ready(function(){
    // Atualiza flag Favorito
    $('.flagFavoritoContato').click(function(){
        var $this = $(this);
        var idContato = $this.prop("id");
        var titulo = $this.prop("title");

        if(titulo === "Favorito"){
            $this.html('<i class="bi bi-star"></i>').prop("title","Não Favorito");
            $.getJSON('./pages/contacts/pathFavoritoContato.php', { idContato: idContato, flagFavoritoContato: 0 });
        }else{
            $this.html('<i class="bi bi-star-fill"></i>').prop("title","Favorito");
            $.getJSON('./pages/contacts/pathFavoritoContato.php', { idContato: idContato, flagFavoritoContato: 1 });
        }
    });
});
