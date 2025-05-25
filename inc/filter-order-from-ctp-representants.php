<?php
/*
 * Add a custom column to the "Representantes" post type in the admin area
 * and make it sortable by city.
 */


function add_city_column($columns) {
    $columns['city_representant'] = __('Cidade', 'text_domain');
    return $columns;
}
add_filter('manage_representante_posts_columns', 'add_city_column');

/*
 * Fill the custom column with the city value from the ACF field
 */
function fill_city_column($column, $post_id) {
    if ($column === 'city_representant') {
        $city = get_field('cityRepresentant', $post_id);
        echo esc_html($city);
    }
}
add_action('manage_representante_posts_custom_column', 'fill_city_column', 10, 2);

/*
 * Make the custom column sortable
 */

function sortable_city_column($columns) {
    $columns['city_representant'] = 'city_representant';
    return $columns;
}
add_filter('manage_edit-representante_sortable_columns', 'sortable_city_column');

/*
 * Modify the query to sort by the custom column
 */
function orderby_city_column($query) {
    if (!is_admin() || !$query->is_main_query()) {
        return;
    }

    if ($query->get('orderby') === 'city_representant') {
        $query->set('meta_key', 'cityRepresentant');
        $query->set('orderby', 'meta_value');
    }
}
add_action('pre_get_posts', 'orderby_city_column');