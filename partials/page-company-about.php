<section class="companyAboutPage gridMargin">
    <div class="line">
        <h2><?=esc_html(get_field('titleCompany'))?></h2>
        <span class="subtitle"><?=esc_html(get_field('subTitleCompany'))?></span>
    </div>

    <article>
        <?=get_field('contentCompany')?>
    </article>
</section>