<?php
include("../../db/conect.php");
$idContato = $_GET["idContato"];
$flagFavoritoContato = $_GET["flagFavoritoContato"];

$sql = "UPDATE dbcontatos SET flagFavoritoContato = {$flagFavoritoContato} WHERE idContato = {$idContato}";

mysqli_query($conect,$sql);