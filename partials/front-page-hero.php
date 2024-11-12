<div class="hero">
    <div class="images">
        <?php
            $args = [
                'post_type' => 'banner',
            ];
            $the_query = new WP_Query( $args ); 
            if ( $the_query->have_posts() ) : 
                $count = 0; // Contador para os bullets
                while ( $the_query->have_posts() ) :
                $the_query->the_post();
        ?>
                <figure>
                    <img width="1920" src="<?php the_post_thumbnail_url('full')?>" alt="<?php the_title()?>" loading="lazy">
                </figure>
        <?php $count++; endwhile; wp_reset_postdata();?>
        <?php else : ?>
            <h1>Não existe banners cadastrados</h1>
        <?php endif; ?>
    </div>

    <div class="buttons">
        <button class="prev">&#10094;</button>
        <button class="next">&#10095;</button>
    </div>

    <ul class="bullets">
        <?php for ($i = 0; $i < $count; $i++): ?>
            <li></li>
        <?php endfor; ?>
    </ul>
</div>
