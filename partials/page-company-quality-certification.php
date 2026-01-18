<section class="companyQualityCertification gridMargin" itemscope itemtype="https://schema.org/Organization">
    <meta itemprop="name" content="ZAP Peças">
    
    <header>
        <h2 itemprop="award"><?=esc_html( get_field('tituloQualityCertification') )?></h2>
        <span class="subtitle" itemprop="slogan">Focada na satisfação de seus clientes</span>
        
        <div itemprop="description">
            <?=get_field('QualityCertification');?>
        </div>
        
        <?php 
            $link = get_field('buttonQualityCertification');
            if( $link ): 
                $link_url = $link['url'];
                $link_title = $link['title'];
                $link_target = $link['target'] ? $link['target'] : '_self';
                ?>
                <a class="button" 
                   href="<?=esc_url($link_url)?>" 
                   target="<?=esc_attr( $link_target )?>" 
                   title="<?=esc_html( $link_title)?>"
                   itemprop="certificationDocument"
                   itemscope 
                   itemtype="https://schema.org/DigitalDocument">
                    <span itemprop="name"><?=esc_html( $link_title)?></span>
                </a>
            <?php endif; ?>
    </header>
    
    <figure class="qualityCertificationImage" 
            itemprop="certifications" 
            itemscope 
            itemtype="https://schema.org/Certification">
        <meta itemprop="name" content="ISO 9001 - Sistema de Gestão da Qualidade">
        <meta itemprop="issuedBy" content="IQA - Instituto da Qualidade Automotiva">
        <meta itemprop="validFrom" content="2009">
        <img src="<?=get_template_directory_uri()?>/assets/images/selo-sistema-de-gestao-da-qualidade-iqa-nbr-iso-9001.jpeg" 
             alt="Selo Sistema de Gestão da Qualidade IQA NBR ISO 9001"
             itemprop="image">
    </figure>
</section>