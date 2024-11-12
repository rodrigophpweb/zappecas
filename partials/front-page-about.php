<section class="frontPageAbout gridMargin" itemscope itemtype="https://schema.org/Organization">
    <article itemprop="description">
        <span class="subtitle">Somos a maior por que fazemos o melhor</span>
        <h2>Nós somos <br><span itemprop="name">ZAP Peças</span></h2>
        <p>Impulsionamos o sucesso no mercado automotivo com soluções abrangentes e inovadoras, reconhecidas por nossa excelência, compromisso inabalável com o cliente e liderança no setor.</p>
        <a href="<?=site_url()?>/a-empresa/" itemprop="url">Saiba mais</a>
    </article>

    <figure>
        <?php
            $photoDirector = get_field('photoDirector');                    
            if( !empty( $photoDirector ) ): 
        ?>
            <img width="509" height="500" src="<?php echo esc_url($photoDirector['url']); ?>" alt="<?php echo esc_attr($photoDirector['alt']); ?>" loading="lazy" itemprop="image">
        <?php endif; ?>
    </figure>
</section>
