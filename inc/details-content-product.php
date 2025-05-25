<?php
/*
    * Função para retornar detalhes do conteúdo de um produto
    * @param int $post_id ID do post
    * @return array Detalhes do conteúdo
*/

function zappecas_get_detalhes_do_conteudo($post_id = null) {
    if (!$post_id) {
        $post_id = get_the_ID();
    }

    $content = get_post_field('post_content', $post_id);

    if (empty($content)) {
        return [
            'descricao' => 'Conteúdo vazio',
            'aplicacao' => 'Conteúdo vazio'
        ];
    }

    $dom = new DOMDocument();
    libxml_use_internal_errors(true);
    $dom->loadHTML('<?xml encoding="UTF-8">' . $content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
    libxml_clear_errors();

    $lis = $dom->getElementsByTagName('li');

    $descricao = '';
    $aplicacao = '';

    foreach ($lis as $li) {
        $strong = $li->getElementsByTagName('strong')->item(0);

        if ($strong) {
            $label = trim($strong->textContent);
            $li->removeChild($strong); // remove <strong> do conteúdo
            $liText = trim($li->textContent);

            if (stripos($label, 'Descrição') !== false) {
                $descricao = ltrim($liText, ': ');
            }

            if (stripos($label, 'Aplicação') !== false) {
                $innerUl = $li->getElementsByTagName('ul')->item(0);
                if ($innerUl) {
                    $models = [];
                    foreach ($innerUl->getElementsByTagName('li') as $modelLi) {
                        $models[] = trim($modelLi->textContent);
                    }
                    $aplicacao = implode(', ', $models);
                } else {
                    $aplicacao = ltrim($liText, ': ');
                }
            }
        }
    }

    return [
        'descricao' => $descricao ?: 'Não encontrada',
        'aplicacao' => $aplicacao ?: 'Não encontrada'
    ];
}

add_action('rest_api_init', function () {
register_rest_route('custom/v1', '/produtos', [
    'methods' => 'GET',
    'callback' => 'get_filtered_products',
    'permission_callback' => '__return_true',
]);
});