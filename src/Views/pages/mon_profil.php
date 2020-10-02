<?php
require_once VIEWS_DIR . 'partials' . DIRECTORY_SEPARATOR . '_header_pages.php';
?>

<main>
    <h1 class="text-center">Mon profil</h1>
</main>


<?php
$isPseudoInvalid = false === empty($errors['pseudo']);
$isAvatarInvalid = false === empty($errors['avatar']);

$isGetMethod = true;
if (isset($errors)) {
    $isGetMethod = is_null($errors);
}

$isPseudoValid = !$isGetMethod && !$isPseudoInvalid;
$isAvatarValid = !$isGetMethod && !$isAvatarInvalid;

if (!isset($pseudo)) $pseudo = '';
if (!isset($avatar)) $avatar = '';

?>

<section>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <form method="post" action="">
                    <!--<div class="form-group">
                        <label for="pseudo">Pseudo</label>
                        <input type="text" class="form-control<?= $isPseudoInvalid ? ' is-invalid' : ($isPseudoValid ? ' is-valid' : '') ?>" name="pseudo" id="pseudo" aria-describedby="pseudoHelp" value="<?= $pseudo ?>">
                        <?php if($isPseudoInvalid): ?>
                            <?= "<small id=\"pseudoHelp\" class=\"form-text invalid-feedback\">" . $errors['pseudo'] . "</small>" ?>
                        <?php endif; ?>
                    </div>-->
                    <!--<div class="form-group">
                        <label for="avatar">Avatar</label>
                        <input type="file" class="form-control<?= $isAvatarInvalid ? ' is-invalid' : ($isAvatarValid ? ' is-valid' : '') ?>" name="title" id="title" aria-describedby="avatarHelp" value="<?= $avatar ?>">
                        <?php if($isAvatarInvalid): ?>
                            <?= "<small id=\"avatarHelp\" class=\"form-text invalid-feedback\">" . $errors['avatar'] . "</small>" ?>
                        <?php endif; ?>
                    </div>-->
                    <!--<button type="submit" class="btn btn-primary">Submit</button>-->
                </form>
            </div>
        </div>
    </div>
</section>

<?php
require_once VIEWS_DIR . 'partials' . DIRECTORY_SEPARATOR . '_footer_pages.php';