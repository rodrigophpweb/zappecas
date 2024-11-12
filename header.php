<!DOCTYPE html>
<html <?php language_attributes();?>>
<head>
    <meta charset="<?php bloginfo('charset');?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php bloginfo('title');?></title>
    <?php wp_head();?>
</head>
<body <?php body_class()?>>
<header class="gridMargin">
    <nav>
        <figure>
            <a href="<?php site_url()?>/home" title="Logotipo Zap Peças Automotivas">
                <img src="<?=get_template_directory_uri()?>/assets/images/logotipo-zap-pecas.svg" alt="Logotipo Zap Peças Automotivas">
            </a>
        </figure>
        <span class="mnumobile">☰</span>
        <?php
            // Exibe o menu com a tag <menu> em vez de <ul>
            wp_nav_menu( array(
                'theme_location' => 'main_menu',
                'container'      => false, // Remove a div de container padrão
                'items_wrap'     => '<menu>%3$s</menu>', // Personaliza a marcação do menu
            ) );
        ?>

    </nav>
</header>