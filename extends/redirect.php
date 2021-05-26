<?php

require_once("../../config/config.php");

function redireccionar($pagina){
  header('location: ' . RUTA_URL . $pagina );
}

function Err($codigo){

  if($codigo == 500){
    redireccionar("error/500.php");
  }elseif ($codigo  == 404) {
    redireccionar("error/404.php");
  }elseif ($codigo  == 403) {
    redireccionar("error/403.php");
  }elseif ($codigo  == 300) {
    redireccionar("error/300.php");
  }else{
    redireccionar("error/500.php");
  }


}




?>
