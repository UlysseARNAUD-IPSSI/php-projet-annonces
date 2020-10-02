<?php
require_once VIEWS_DIR . 'partials/_header_pages.php';
?>

    <main>
        <h1 class="text-center">Blog</h1>
    </main>

    <section id="blog">

        <aside class="blog--categories"></aside>
        <aside class="blog--grid"></aside>

    </section>


    <script src="/_vieux/resourcessources/js/blog/page-has-blog-section.js"></script>
    <script src="/_vieux/resourcessources/js/blog/return-if-has-not-blog-section.js"></script>
    <script src="/_vieux/resourcessources/js/blog/load-posts.js"></script>
    <script src="/_vieux/resourcessources/js/blog/load-categories.js"></script>
    <script src="/_vieux/resourcessources/js/blog/add-create-post.js"></script>
    <script src="/_vieux/resourcessources/js/blog/add-post.js"></script>
    <script src="/_vieux/resourcessources/js/blog/add-categories.js"></script>
    <script src="/_vieux/resourcessources/js/blog/add-all-category.js"></script>
    <script src="/_vieux/resourcessources/js/blog/lazy-loading.js"></script>

<?php
require_once VIEWS_DIR . 'partials/_footer_pages.php';