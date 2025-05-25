<?php

/**
 * Função para retornar representantes com base no estado
 *
 * @param WP_REST_Request $data Dados da requisição
 * @return array Lista de representantes
 */

function get_representantes($data) {
    // Recebendo o estado enviado
    $state = $data['state'];
    
    // Ajuste do meta_query para usar LIKE se for necessário corresponder parcialmente
    $args = array(
        'post_type' => 'representante',
        'meta_query' => array(
            array(
                'key' => 'stateRepresentant', // A chave do campo ACF que armazena o estado
                'value' => $state,
                'compare' => 'LIKE'  // Usando LIKE para buscar parcialmente
            )
        )
    );
    
    // Realizando a consulta no banco
    $representantes = new WP_Query($args);
    
    // Preparando o array de resultados
    $result = array();
    
    // Verificando se há resultados e os adicionando ao array
    if($representantes->have_posts()) {
        while ($representantes->have_posts()) {
            $representantes->the_post();
            $result[] = array(
                'title' => get_the_title(), // Título da postagem
                'acf' => array(
                    'nameRepresentant' => get_field('nameRepresentant'), // Campo ACF
                    'contactRepresentant' => get_field('contactRepresentant'), // Campo ACF
                    'mailRepresentant' => get_field('mailRepresentant'), // Campo ACF
                ),
            );
        }
    }
    
    // Retornando os resultados
    return $result;
}

add_action('rest_api_init', function () {
    register_rest_route('wp/v2', '/representante', array(
        'methods' => 'GET',
        'callback' => 'get_representantes',
    ));
});