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
    $link = get_field('link_para_o_banner', $banner->ID);
    
    // Primeira imagem: sem lazy load + alta prioridade (LCP - Largest Contentful Paint)
    // Outras imagens: com lazy load
    $is_first = ($index === 0);
    $loading_attr = $is_first ? '' : 'loading="lazy"';
    $fetchpriority_attr = $is_first ? 'fetchpriority="high"' : '';
?>
    <figure data-index="<?= esc_attr($index) ?>">
        <?php if ($link && !empty($link['url'])): ?>
            <a href="<?= esc_url($link['url']) ?>" 
               title="<?= esc_attr($link['title'] ?: $title) ?>"
               <?= $link['target'] ? 'target="' . esc_attr($link['target']) . '"' : '' ?>>
                <img width="1920" 
                     src="<?= esc_url($thumbnail_url) ?>" 
                     alt="<?= esc_attr($title) ?>" 
                     <?= $loading_attr ?>
                     <?= $fetchpriority_attr ?>>
            </a>
        <?php else: ?>
            <img width="1920" 
                 src="<?= esc_url($thumbnail_url) ?>" 
                 alt="<?= esc_attr($title) ?>" 
                 <?= $loading_attr ?>
                 <?= $fetchpriority_attr ?>>
        <?php endif; ?>
    </figure>
<?php
}