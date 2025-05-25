<?php
    function get_filtered_products($request) {
        $paged = $request->get_param('page') ?: 1;
        $search = sanitize_text_field($request->get_param('search'));
        $line = sanitize_text_field($request->get_param('line'));
        $fabricante = sanitize_text_field($request->get_param('fabricante'));

        $args = [
            'post_type' => 'product',
            'posts_per_page' => 9,
            'paged' => $paged,
            's' => $search,
            'tax_query' => [],
        ];

        if ($line) {
            $args['tax_query'][] = [
                'taxonomy' => 'line',
                'field'    => 'slug',
                'terms'    => $line,
            ];
        }

        if ($fabricante) {
        $args['tax_query'][] = [
            'taxonomy' => 'fabricante',
            'field'    => 'slug',
            'terms'    => $fabricante,
        ];
        }

        $query = new WP_Query($args);

        $products = [];
        foreach ($query->posts as $post) {
        $products[] = [
            'id' => $post->ID,
            'title' => get_the_title($post),
            'excerpt' => get_the_excerpt($post),
        ];
        }

        return [
        'products' => $products,
        'total_pages' => $query->max_num_pages,
        ];
    }