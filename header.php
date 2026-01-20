<!DOCTYPE html>
<html <?php language_attributes();?>>
<head>
    <meta charset="<?php bloginfo('charset');?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php bloginfo('title');?></title>
    
    <?php 
    // Preload da primeira imagem do banner (LCP - Largest Contentful Paint)
    // Melhora o Core Web Vitals e SEO
    if (is_front_page()) {
        $first_banner = new WP_Query([
            'post_type' => 'banner',
            'posts_per_page' => 1,
            'post_status' => 'publish',
            'order' => 'ASC',
        ]);
        
        if ($first_banner->have_posts()) {
            $first_banner->the_post();
            $first_banner_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
            if ($first_banner_url) {
                echo '<link rel="preload" as="image" href="' . esc_url($first_banner_url) . '" fetchpriority="high">';
            }
            wp_reset_postdata();
        }
    }
    ?>
    
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
            wp_nav_menu(
                [
                    'theme_location' => 'main_menu',
                    'container'      => false,
                    'items_wrap'     => '<menu>%3$s</menu>',
                ],
            );
        ?>
    </nav>
</header>
