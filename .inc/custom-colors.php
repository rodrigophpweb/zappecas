<?php
    /*
        * Função para filtrar os representantes por estado
        * @param array $args Argumentos da consulta
        * @param WP_REST_Request $request Requisição REST
        * @return array Argumentos filtrados
    */
    function dynamic_colors_css() {
        $primary_color = get_field('primary', 'option'); // Usa o ACF para obter a cor primaria
        $secondary_color = get_field('secondary', 'option'); // Usa o ACF para obter a cor secundaria
        $light_color = get_field('light', 'option'); // Usa o ACF para obter a cor secundaria
        $dark_color = get_field('dark', 'option'); // Usa o ACF para obter a cor secundaria
        $text_color = get_field('textColor', 'option'); // Usa o ACF para obter a cor secundaria

        if ($primary_color && $secondary_color) {
            echo "<style>
                :root {
                    --primary: $primary_color;
                    --secondary: $secondary_color;
                    --light: $light_color;
                    --dark: $dark_color;
                    --text-color: $text_color;

                }
            </style>";
        }
    }
    add_action('wp_head', 'dynamic_colors_css');