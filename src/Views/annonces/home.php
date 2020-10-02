<?php
require_once VIEWS_DIR . 'partials' . DIRECTORY_SEPARATOR . '_header_pages.php';
?>

<main>
    <h1 class="text-center">Annonces</h1>
</main>

    <section class="mt-5">
        <div class="container">
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
                        <?php if (0 === count(getAnnonces())): ?>
                        <tr>
                            <td colspan="4">Pas d'annonce disponible</td>
                        </tr>
                        <?php endif; ?>
                        <?php foreach (getAnnonces() as $annonce): ?>
                            <tr>
                                <th scope="row"><?= $annonce->id ?></th>
                                <td><?= $annonce->title ?></td>
                                <td><?= $annonce->price ?> €</td>
                                <td>
                                    <a href="/annonces/<?= $annonce->id ?>" class="btn btn-primary">Voir plus</a>
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
require_once VIEWS_DIR . 'partials' . DIRECTORY_SEPARATOR . '_footer_pages.php';