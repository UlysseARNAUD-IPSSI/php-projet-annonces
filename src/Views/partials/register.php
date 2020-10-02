
<?php
$isPseudoInvalid = false === empty($errors['pseudo']);
$isEmailInvalid = false === empty($errors['email']);
$isPasswordInvalid = false === empty($errors['password']);
$isPhoneInvalid = false === empty($errors['phone']);
$arePasswordNotSame = false === empty($errors['confirmation_password']);

$isGetMethod = true;
if (isset($errors)) {
    $isGetMethod = is_null($errors);
}

$isPseudoValid = !$isGetMethod && !$isPseudoInvalid;
$isEmailValid = !$isGetMethod && !$isEmailInvalid;
$isPasswordValid = !$isGetMethod && !$isPasswordInvalid;
$isPhoneValid = !$isGetMethod && !$isPhoneInvalid;

if (!isset($pseudo)) $pseudo = '';
if (!isset($email)) $email = '';
if (!isset($password)) $password = '';
if (!isset($phone)) $phone = '';

?>

<section class="mt-5">
    <div class="container">
        <div class="row">
            <div class="col">
                <h1>S'inscrire</h1>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <form method="post" action="">
                    <div class="form-group">
                        <label for="pseudo">Pseudo</label>
                        <input type="text" class="form-control<?= $isPseudoInvalid ? ' is-invalid' : ($isPseudoValid ? ' is-valid' : '') ?>" name="pseudo" id="pseudo" aria-describedby="pseudoHelp" value="<?= $pseudo ?>">
                        <?php if($isPseudoInvalid): ?>
                            <?= "<small id=\"pseudoHelp\" class=\"form-text invalid-feedback\">" . $errors['pseudo'] . "</small>" ?>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label for="email">Adresse mail</label>
                        <input type="email" class="form-control<?= $isEmailInvalid ? ' is-invalid' : ($isPseudoValid ? ' is-valid' : '') ?>" name="email" id="email" aria-describedby="emailHelp" value="<?= $email ?>">
                        <?php if($isEmailInvalid): ?>
                            <?= "<small id=\"emailHelp\" class=\"form-text invalid-feedback\">" . $errors['email'] . "</small>" ?>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label for="phone">Téléphone</label>
                        <input type="text" class="form-control<?= $isPhoneInvalid ? ' is-invalid' : ($isPhoneValid ? ' is-valid' : '') ?>" name="phone" id="phone" aria-describedby="phoneHelp" value="<?= $phone ?>">
                        <?php if($isPhoneInvalid): ?>
                            <?= "<small id=\"phoneHelp\" class=\"form-text invalid-feedback\">" . $errors['phone'] . "</small>" ?>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label for="password">Mot de passe</label>
                        <input type="password" class="form-control<?= $isPasswordInvalid ? ' is-invalid' : ($isPasswordValid ? ' is-valid' : '') ?>" name="password" id="password" aria-describedby="passwordHelp">
                        <?php if($isPasswordInvalid): ?>
                            <?= "<small id=\"passwordHelp\" class=\"form-text invalid-feedback\">" . $errors['password'] . "</small>" ?>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label for="confirmation_password">Confirmation mot de passe</label>
                        <input type="password" class="form-control<?= $arePasswordNotSame ? ' is-invalid' : '' ?>" name="confirmation_password" id="confirmation_password" aria-labelledby="confirmationPasswordHelp">
                        <?php if($arePasswordNotSame): ?>
                            <?= "<small id=\"confirmationPasswordHelp\" class=\"form-text invalid-feedback\">" . $errors['confirmation_password'] . "</small>" ?>
                        <?php endif; ?>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</section>

<!--<main>

    <form method="post" action="">

        <div class="input-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email"
                   value="john.doe@example.com" placeholder="jean.dupont@exemple.fr ...">
        </div>

        <div class="input-group">
            <label for="pseudo">Pseudo</label>
            <input type="text" name="pseudo" id="pseudo"
                   value="John DOE" placeholder="Jean DUPONT ...">
        </div>
        <div class="input-group">
            <label for="password">Mot de passe</label>
            <input type="password" name="password" id="password"
                   value="password" placeholder="Mot de passe">
        </div>
        <button type="submit">Valider</button>

    </form>

    <?php
    if (isset($_POST['error'])):
    ?>
    <aside style="position: absolute;transform: translateY(8rem);">
        <p>Il semblerait qu'une erreur soit survenue lors de l'inscription.</p>
    </aside>
    <?php
    endif;
    ?>
</main>-->