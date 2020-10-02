<?php
require_once VIEWS_DIR . 'partials' . DIRECTORY_SEPARATOR . '_header_admin.php';
?>

    <main>
        <h1 class="text-center">Créer une annonce</h1>
    </main>

<?php
$isTitleInvalid = false === empty($errors['title']);
$isDescriptionInvalid = false === empty($errors['description']);
$isPriceInvalid = false === empty($errors['price']);
$isEndsAtInvalid = false === empty($errors['ends_at']);

$isGetMethod = true;
if (isset($errors)) {
    $isGetMethod = is_null($errors);
}

$isTitleValid = !$isGetMethod && !$isTitleInvalid;
$isDescriptionValid = !$isGetMethod && !$isDescriptionInvalid;
$isPriceValid = !$isGetMethod && !$isPriceInvalid;
$isEndsAtValid = !$isGetMethod && !$isEndsAtInvalid;

if (!isset($title)) $title = '';
if (!isset($description)) $description = '';
if (!isset($price)) $price = '';
if (!isset($ends_at)) $ends_at = '';

?>

    <section class="mt-5">
        <div class="container">
            <div class="row">
                <div class="col">
                    <form method="post" action="/admin/annonces/create">
                        <div class="form-group">
                            <label for="title">Titre de l'annonce</label>
                            <input type="text" class="form-control<?= $isTitleInvalid ? ' is-invalid' : ($isTitleValid ? ' is-valid' : '') ?>" name="title" id="title" aria-describedby="titleHelp" value="<?= $title ?>">
                            <?php if($isTitleInvalid): ?>
                            <?= "<small id=\"titleHelp\" class=\"form-text invalid-feedback\">" . $errors['title'] . "</small>" ?>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label for="description">Description de l'annonce</label>
                            <textarea class="form-control<?= $isDescriptionInvalid ? ' is-invalid' : ($isDescriptionValid ? ' is-valid' : '') ?>" name="description" id="description"
                                      aria-describedby="descriptionHelp"><?= $description ?></textarea>
                            <?php if($isDescriptionInvalid): ?>
                                <small id="descriptionHelp" class="form-text invalid-feedback"><?= $errors['description'] ?></small>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label for="price">Prix</label>
                            <input type="text" class="form-control<?= $isPriceInvalid ? ' is-invalid' : ($isPriceValid ? ' is-valid' : '') ?>" name="price" id="price" aria-describedby="priceHelp" value="<?= $price ?>">
                            <?php if($isPriceInvalid): ?>
                                <small id="priceHelp" class="form-text invalid-feedback"><?= $errors['price'] ?></small>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label for="price">Se termine le</label>
                            <input type="datetime-local" class="form-control<?= $isEndsAtInvalid ? ' is-invalid' : ($isEndsAtValid ? ' is-valid' : '') ?>" name="ends_at" id="endsAt"
                                   aria-describedby="endsAtHelp" value="<?= $ends_at ?>">
                            <?php if($isEndsAtInvalid): ?>
                                <small id="endsAtHelp" class="form-text invalid-feedback"><?= $errors['ends_at'] ?></small>
                            <?php endif; ?>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

<?php
require_once VIEWS_DIR . 'partials' . DIRECTORY_SEPARATOR . '_footer_admin.php';