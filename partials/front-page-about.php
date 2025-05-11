<section class="frontPageAbout gridMargin" itemscope itemtype="https://schema.org/Organization">
    <article itemprop="description">
        <span class="subtitle">Somos a maior por que fazemos o melhor</span>
        <?=get_the_content()?>
    </article>

    <figure>
        <?php
            $photoDirector = get_field('photoDirector');                    
            if( !empty( $photoDirector ) ): 
        ?>
            <img width="509" height="500" src="<?=esc_url($photoDirector['url'])?>" alt="<?=esc_attr($photoDirector['alt'])?>" loading="lazy" itemprop="image">
        <?php endif; ?>
    </figure>
</section>
