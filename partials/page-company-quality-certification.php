<section class="companyQualityCertification gridMargin">
    <h2><?=esc_html( get_field('tituloQualityCertification') )?></h2>
    <span class="subtitle">Focada na satisfação de seus clientes</span>
    <?=get_field('QualityCertification');?>
    <?php 
        $link = get_field('buttonQualityCertification');
        if( $link ): 
            $link_url = $link['url'];
            $link_title = $link['title'];
            $link_target = $link['target'] ? $link['target'] : '_self';
            ?>
            <a class="button" href="<?=esc_url($link_url)?>" target="<?=esc_attr( $link_target )?>" title="<?=esc_html( $link_title)?>"><?=esc_html( $link_title)?></a>
        <?php endif; ?>
</section>