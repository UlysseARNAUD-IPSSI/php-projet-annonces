<?php
require_once VIEWS_DIR . 'partials' . DIRECTORY_SEPARATOR . '_header_admin.php';
?>

<main>
    <h1 class="text-center">Liste des annonces</h1>
</main>

<section class="mt-5">
    <div class="container">
        <div class="row mb-4">
            <div class="col">
                <a href="/admin/annonces/create" class="btn btn-primary">Créer une annonce</a>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Titre</th>
                        <th scope="col">Prix</th>
                        <th scope="col">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach (getAnnonces() as $annonce): ?>
                    <tr>
                        <th scope="row"><?= $annonce->id ?></th>
                        <td><?= $annonce->title ?></td>
                        <td><?= $annonce->price ?> €</td>
                        <td>
                            <a href="/admin/annonces/<?= $annonce->id ?>/edit" class="btn btn-primary">Modifier</a>
                            <a href="/admin/annonces/<?= $annonce->id ?>/delete"  class="btn btn-danger">Supprimer</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<?php
require_once VIEWS_DIR . 'partials' . DIRECTORY_SEPARATOR . '_footer_admin.php';