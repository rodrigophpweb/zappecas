<?php
/* Custom Breadcrumb */
function custom_breadcrumb() {
    if (!is_home()) {
        echo '<nav aria-label="breadcrumb" class="breadcrumb">';
        echo '<ul itemscope itemtype="https://schema.org/BreadcrumbList">';
        $position = 1;

        // Home
        echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
        echo '<a href="' . home_url() . '" itemprop="item">';
        echo '<span itemprop="name">Home</span></a>';
        echo '<meta itemprop="position" content="' . $position++ . '" />';
        echo '</li>';

        // Taxonomia 'linha'
        if (is_tax('linha')) {
            echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
            echo '<a href="' . home_url('/produtos') . '" itemprop="item">';
            echo '<span itemprop="name">Produtos</span></a>';
            echo '<meta itemprop="position" content="' . $position++ . '" />';
            echo '</li>';

            $term = get_queried_object();
            echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
            echo '<span itemprop="name">' . esc_html($term->name) . '</span>';
            echo '<meta itemprop="position" content="' . $position++ . '" />';
            echo '</li>';
        }

        // Página única de produto (CPT)
        elseif (is_singular('produto')) {
            echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
            echo '<a href="' . home_url('/produtos') . '" itemprop="item">';
            echo '<span itemprop="name">Produtos</span></a>';
            echo '<meta itemprop="position" content="' . $position++ . '" />';
            echo '</li>';

            // Termo da taxonomia 'linha' (opcional)
            $terms = get_the_terms(get_the_ID(), 'linha');
            if ($terms && !is_wp_error($terms)) {
                $term = array_shift($terms);
                echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
                echo '<a href="' . get_term_link($term) . '" itemprop="item">';
                echo '<span itemprop="name">' . esc_html($term->name) . '</span></a>';
                echo '<meta itemprop="position" content="' . $position++ . '" />';
                echo '</li>';
            }

            echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
            echo '<span itemprop="name">' . get_the_title() . '</span>';
            echo '<meta itemprop="position" content="' . $position++ . '" />';
            echo '</li>';
        }

        // Posts do blog (tipo 'post')
        elseif (is_single() && get_post_type() === 'post') {
            $category = get_the_category();
            if ($category) {
                echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
                echo '<a href="' . get_category_link($category[0]->term_id) . '" itemprop="item">';
                echo '<span itemprop="name">' . $category[0]->name . '</span></a>';
                echo '<meta itemprop="position" content="' . $position++ . '" />';
                echo '</li>';
            }

            echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
            echo '<span itemprop="name">' . get_the_title() . '</span>';
            echo '<meta itemprop="position" content="' . $position++ . '" />';
            echo '</li>';
        }

        // Página de categoria do blog
        elseif (is_category()) {
            $category = get_queried_object();
            echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
            echo '<span itemprop="name">' . esc_html($category->name) . '</span>';
            echo '<meta itemprop="position" content="' . $position++ . '" />';
            echo '</li>';
        }

        // Páginas estáticas (pages)
        elseif (is_page()) {
            global $post;
            if ($post->post_parent) {
                $ancestors = get_post_ancestors($post->ID);
                foreach (array_reverse($ancestors) as $ancestor) {
                    echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
                    echo '<a href="' . get_permalink($ancestor) . '" itemprop="item">';
                    echo '<span itemprop="name">' . get_the_title($ancestor) . '</span></a>';
                    echo '<meta itemprop="position" content="' . $position++ . '" />';
                    echo '</li>';
                }
            }
            echo '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
            echo '<span itemprop="name">' . get_the_title() . '</span>';
            echo '<meta itemprop="position" content="' . $position++ . '" />';
            echo '</li>';
        }

        echo '</ul>';
        echo '</nav>';
    }
}
