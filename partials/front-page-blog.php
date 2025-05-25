<section class="frontPageBlog" itemscope itemtype="https://schema.org/Blog">
    <h2 itemprop="headline">Posts da Semana</h2>
    <span class="subtitle" itemprop="description">Informações e dicas relevantes sobre o mercado automotivo.</span>
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
    <a href="<?=site_url()?>/blog" title="Veja todos os Posts" itemprop="url" class="allPosts">Veja todos os Posts</a>
</section>
