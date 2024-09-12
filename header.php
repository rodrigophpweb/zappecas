<!DOCTYPE html>
<html <?php language_attributes();?>>
<head>
    <meta charset="<?php bloginfo('utf-8');?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php bloginfo('title');?></title>
    <?php wp_head();?>
</head>
<body>
<header>
    <nav>
        <figure>
            <?php the_custom_logo();?>
        </figure>

        <?php
            wp_nav_menu([

            ])
        ?>

        <menu>
            <li>
                <a href="">Home</a>
                <a href="">A Empresa</a>
                <a href="">Produtos</a>
                <a href="">Representantes</a>
                <a href="">Contato</a>
            </li>
        </menu>
    </nav>

    <div class="hero">
        <h1>Soluções Completas <span>A maior linha de Kits do Mercado</span></h1>
        <div class="buttons">
            <a href="">Saiba mais</a>
            <a href="">Consultar Catálogo</a>
        </div>
    </div>
</header>