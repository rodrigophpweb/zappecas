<section class="companyAboutPage gridMargin fade-in-section">
    <div class="line">
        <h2><?=esc_html(get_field('titleCompany'))?></h2>
        <span class="subtitle"><?=esc_html(get_field('subTitleCompany'))?></span>
    </div>

    <article>
        <div class="contentCols">
            <?=get_the_content()?>
        </div>
    </article>
</section>