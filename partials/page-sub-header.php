<section class="subHeaderPages gridMargin">
    <?php
        function get_contextual_title() {
            $conditions = [
                'Produtos (%s)' => function () {
                    return is_tax('linha') ? get_queried_object()->name : false;
                },
                'Produto' => fn() => is_singular('produto'),
                'Produtos' => fn() => is_post_type_archive('produto'),
                'Blog' => fn() => is_single() && get_post_type() === 'post',
                '%s' => function () {
                    return is_category() ? single_cat_title('', false) : false;
                },
                get_the_title() => fn() => is_page() || is_singular(),
            ];

            foreach ($conditions as $format => $condition) {
                $result = $condition();
                if ($result !== false) {
                    return sprintf($format, $result);
                }
            }

            return get_the_title(); // fallback
        }
    ?>

    <h1 itemprop="name"><?= esc_html(get_contextual_title()); ?></h1>
    <?php custom_breadcrumb(); ?>
</section>
