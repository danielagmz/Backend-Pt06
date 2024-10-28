<?php require_once 'controllers/user_busquedas.php';?>
<input type="text" list="busquedas" value="<?= isset($_GET['filter']) ? $_GET['filter'] : '' ?>" name="busqueda__input" placeholder="Filtar por..." class="busqueda__input" autofocus>
<datalist id="busquedas">
   <?= crear_datalist_user()?>
</datalist>