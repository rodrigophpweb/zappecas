<section class="companyQualityCertification gridMargin">
    <header>
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
    </header>
    <figure class="qualityCertificationImage">
        <img src="<?=get_template_directory_uri()?>/assets/images/selo-sistema-de-gestao-da-qualidade-iqa-nbr-iso-9001.jpeg" alt="Selo Sistema de Gestão da Qualidade IQA NBR ISO 9001">
    </figure>
</section>