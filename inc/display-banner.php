<?php

/*
 * Função display_banner
 * Esta função exibe um banner em um formato específico.
 * Ela recebe um objeto de banner e um índice como parâmetros.
 * O banner é exibido dentro de uma tag <figure> com um atributo data-index.
 * A imagem do banner é obtida através da função get_the_post_thumbnail_url(),
 * e o título do banner é obtido através da função get_the_title().
 *
 * @param object $banner O objeto do banner a ser exibido.
 * @param int $index O índice do banner, usado para o atributo data-index.
 */

function display_banner($banner, $index) {
    $thumbnail_url = get_the_post_thumbnail_url($banner->ID, 'full');
    $title = get_the_title($banner);
?>
    <figure data-index="<?= esc_attr($index) ?>">
        <img width="1920" src="<?= esc_url($thumbnail_url) ?>" alt="<?= esc_attr($title) ?>" loading="lazy">
    </figure>
<?php
}