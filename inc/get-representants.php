<?php

/**
 * Função para retornar representantes com base no estado
 *
 * @param WP_REST_Request $data Dados da requisição
 * @return array Lista de representantes
 */

function get_representantes($data) {
    $state = $data['state'];
    
    $args = array(
        'post_type' => 'representante',
        'meta_query' => array(
            array(
                'key' => 'stateRepresentant',
                'value' => $state,
                'compare' => 'LIKE'
            )
        )
    );
    
    $representantes = new WP_Query($args);
    
    $result = array();
    
    if($representantes->have_posts()) {
        while ($representantes->have_posts()) {
            $representantes->the_post();
            $result[] = array(
                'title' => get_the_title(),
                'acf' => array(
                    'nameRepresentant' => get_field('nameRepresentant'),
                    'contactRepresentant' => get_field('contactRepresentant'),
                    'mailRepresentant' => get_field('mailRepresentant'),
                ),
            );
        }
    }
    
    return $result;
}

add_action('rest_api_init', function () {
    register_rest_route('wp/v2', '/representante', array(
        'methods' => 'GET',
        'callback' => 'get_representantes',
    ));
});