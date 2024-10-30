<section class="companyQualityCertification gridMargin">
    <h2><?=esc_html( get_field('tituloQualityCertification') )?></h2>
    <?=get_field('QualityCertification');?>
    <?php 
        $link = get_field('buttonQualityCertification');
        if( $link ): 
            $link_url = $link['url'];
            $link_title = $link['title'];
            $link_target = $link['target'] ? $link['target'] : '_self';
            ?>
            <a class="button" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
        <?php endif; ?>
</section>