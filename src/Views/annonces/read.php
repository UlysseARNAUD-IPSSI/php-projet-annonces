<?php
require_once VIEWS_DIR . 'partials' . DIRECTORY_SEPARATOR . '_header_pages.php';
?>

<main>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="text-center"><?= $annonce->title ?></h1>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <p><b>Description :</b> <?= $annonce->description ?></p>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <p>Créateur : <?= $annonce->user_id ?></p>
            </div>
        </div>
    </div>
</main>
<?php
require_once VIEWS_DIR . 'partials' . DIRECTORY_SEPARATOR . '_footer_pages.php';