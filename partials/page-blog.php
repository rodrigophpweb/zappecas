<section class="blogContent gridMargin">
    <h2>Nosso Blog</h2>
    <div class="posts">
        <?php
            if ($posts = get_posts(['post_type' => 'post', 'posts_per_page' => 10])) {
                array_map(function($post) {
                    setup_postdata($post);
                    display_post_blog($post);
                }, $posts);
                wp_reset_postdata();
            } else {
                echo '<h1>Não existem Posts Cadastrados</h1>';
            }
        ?>
    </div>
</section>