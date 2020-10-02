
</div>

<script src="<?= parseURL('resources/js/jquery-3.3.1.min.js') ?>" type="application/javascript"></script>
<script src="<?= parseURL('resources/js/bootstrap.bundle.min.js') ?>" type="application/javascript"></script>
<script src="<?= parseURL('resources/js/_main.js') ?>" type="application/javascript"></script>

<script src="<?= parseURL('resources/js/shared/check-types.js') ?>" type="application/javascript"></script>
<script src="<?= parseURL('resources/js/shared/fetch-api.js') ?>" type="application/javascript"></script>
<script src="<?= parseURL('resources/js/shared/fetch-api-post.js') ?>" type="application/javascript"></script>
<script src="<?= parseURL('resources/js/shared/getters/username-by-id.js') ?>" type="application/javascript"></script>
<script src="<?= parseURL('resources/js/shared/getters/username-by-post-id.js') ?>" type="application/javascript"></script>
<script src="<?= parseURL('resources/js/shared/delay.js') ?>" type="application/javascript"></script>

<script src="<?= parseURL('resources/js/shared/user/callback-if-authentified.js') ?>" type="application/javascript"></script>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        try {
            loadSidebarPseudo();
        }
        catch (e) {}
    });

    document.addEventListener('DOMContentLoaded', () => {
        try {
            loadPosts();
            addCreatePost();
            lazyLoadingPostsBlog();
        }
        catch (e) {}
    });
</script>

<?php require_once VIEWS_DIR . 'partials/_scripts.php'; ?>

</body>
</html>