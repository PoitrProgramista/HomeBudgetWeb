<?php
    if(!isset($_SESSION['portal'])) 
        die();

    if(!empty($_POST))
        $portal->submit();
?>

<div class="container-sm well col-md-6 col-md-offset-3">
    <div class="row">
        <div class="col-md-6 col-md-offset-3 text-center">
            <h1>Budżet Domowy</h1>
        </div>
    </div>
    <div class="middle-menu">
        <?php 
            $portal->getTitle();
            $portal->showForm();
        ?>
    </div>
</div>