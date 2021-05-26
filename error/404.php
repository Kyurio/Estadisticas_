<?php

//header
require_once("../inc/header.php");
?>

  <div class="container">
    <section class="section is-medium">
      <div class="container">
        <div class="columns is-vcentered">
          <div class="column has-text-centered">
            <h1 class="title">404 Page Not Found</h1>
            <p class="subtitle">Ha ocurrido un error inesperado. Comuníquese con el propietario del sitio, o no.</p>
            <a class="button is-danger" href="<?php  echo RUTA_URL ?>">Volver</a>
          </div>
          <div class="column has-text-centered">
            <img src="<?php echo RUTA_URL ?>/assets/img/404.svg"/>
          </div>
        </div>
      </div>
    </section>
  </div>

<?php
require_once("../inc/footer.php");

?>
