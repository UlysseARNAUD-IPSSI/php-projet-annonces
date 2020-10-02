
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

<script src="<?= parseURL('resources/js/sidebar/sidebar-toggler.js') ?>" type="application/javascript"></script>
<script src="<?= parseURL('resources/js/sidebar/get-sidebar-pseudo.js') ?>" type="application/javascript"></script>
<script src="<?= parseURL('resources/js/sidebar/add-pseudo-in-sidebar.js') ?>" type="application/javascript"></script>
<script src="<?= parseURL('resources/js/sidebar/load-sidebar-pseudo.js') ?>" type="application/javascript"></script>
<script src="<?= parseURL('resources/js/sidebar/return-if-has-not-pseudo-holder.js') ?>" type="application/javascript"></script>
<script src="<?= parseURL('resources/js/sidebar/sidebar-has-pseudo-holder.js') ?>" type="application/javascript"></script>

<script src="<?= parseURL('resources/js/blog/get-grid.js') ?>"></script>
<script src="<?= parseURL('resources/js/blog/page-has-blog-section.js') ?>"></script>
<script src="<?= parseURL('resources/js/blog/return-if-has-not-blog-section.js') ?>"></script>
<script src="<?= parseURL('resources/js/blog/load-posts.js') ?>"></script>
<script src="<?= parseURL('resources/js/blog/load-posts-authors.js') ?>"></script>
<script src="<?= parseURL('resources/js/blog/load-categories.js') ?>"></script>
<script src="<?= parseURL('resources/js/blog/add-create-post.js') ?>"></script>
<script src="<?= parseURL('resources/js/blog/add-post.js') ?>"></script>
<script src="<?= parseURL('resources/js/blog/add-post-author.js') ?>"></script>
<script src="<?= parseURL('resources/js/blog/add-categories.js') ?>"></script>
<script src="<?= parseURL('resources/js/blog/add-all-category.js') ?>"></script>
<!--<script src="<?= parseURL('resources/js/blog/lazy-loading.js') ?>"></script>-->

<script src="<?= parseURL('resources/js/posts/load-post.js') ?>"></script>
<script src="<?= parseURL('resources/js/posts/load-post-image.js') ?>"></script>

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