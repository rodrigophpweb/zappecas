<section class="companyPrinciples gridMargin scale-up-section" itemscope itemtype="https://schema.org/Organization">
    <h2><?=esc_html(get_field('titlePrinciples'))?></h2>
    <span class="subtitle"><?=esc_html(get_field('subTitlePrinciples'))?></span>
    <p><?=get_field('contentPrinciples')?></p>

    <div class="MissionVisionValues">        
        <?php if( have_rows('mvv') ): ?>
            <?php 
            $mvvIndex = 0;
            while( have_rows('mvv') ): the_row(); 
                $cssClass = get_sub_field('classCSS');
                $image = get_sub_field('imageMvv');
                $titleContent = get_sub_field('titleContent');
                $contentMVV = get_sub_field('contentMVV');
                $svg_file = get_sub_field('iconMVV'); // Substitua 'svg_field' pelo nome do campo no ACF
                
                // Define o tipo de schema baseado no título
                $schemaProp = '';
                $titleLower = strtolower($titleContent);
                if (strpos($titleLower, 'miss') !== false) {
                    $schemaProp = 'mission';
                } elseif (strpos($titleLower, 'vis') !== false) {
                    $schemaProp = 'vision';
                } elseif (strpos($titleLower, 'valor') !== false) {
                    $schemaProp = 'values';
                }
                $mvvIndex++;
            ?>
            <article class="<?=esc_html($cssClass)?>" <?=$schemaProp ? 'itemprop="'.esc_attr($schemaProp).'"' : ''?>>                                   
                    <?=($svg_file && pathinfo($svg_file['url'], PATHINFO_EXTENSION) === 'svg' && $svg_content = file_get_contents($svg_file['url'])) ? $svg_content : '<!-- Erro ao carregar o SVG -->'?>
                <div class="contentInternal">
                    <h3><?=esc_html($titleContent)?></h3> 
                    <p><?=esc_html($contentMVV)?></p>
                </div>
            </article>
            <?php endwhile; ?>
        <?php endif;?>
    </div>
</section>