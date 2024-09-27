<section class="contactInfo gridMargin" itemscope itemtype="http://schema.org/ContactPage">
    <div class="colLeft">
        <div class="content">
            <h2 itemprop="headline">Fale Conosco</h2>
            <p itemprop="description">Valorizamos a comunicação eficaz e a escuta atenta, por isso, oferecemos diversos canais de contato. Tem dúvidas sobre algum produto da Zap Peças? Solicitações ou sugestões? Fale conosco, estamos prontos para atendê-lo.</p>
        </div>

        <article class="relationshipCenter" itemscope itemtype="http://schema.org/Organization">
            <h3 itemprop="department">Central de Relacionamento Zap Peças</h3>
            <ul>
                <li><strong>E-mail:</strong> <a href="mailto:<?php the_field('contactMail')?>" itemprop="email"><?php the_field('contactMail')?></a></li>
                <!--<li><strong>E-mail:</strong> <a href="mailto:comercial@zappecas.com.br" itemprop="email">comercial@zappecas.com.br</a></li>-->
                <li><strong>Fones:</strong> <a href="tel:+5511999999999" itemprop="telephone">+<?php the_field('contactPhone')?></a></li>
                <!-- <li><strong>Fones:</strong> <a href="tel:+5511999999999" itemprop="telephone">+55 11 9999-9999</a> | <a href="tel:+5511999999999" itemprop="telephone">+55 11 99999-9999</a></li> -->
            </ul>
        </article>

        <div class="colRight">
            <div class="socialMedia" itemscope itemtype="http://schema.org/Organization">
                <h3 itemprop="name">Redes Sociais</h3>
                <ul>
                    <li>
                        <a href="https://instagram.com" target="_blank" itemprop="sameAs">Instagram</a>
                    </li>
                    <li>
                        <a href="https://facebook.com" target="_blank" itemprop="sameAs">Facebook</a>
                    </li>
                    <li>
                        <a href="https://youtube.com" target="_blank" itemprop="sameAs">YouTube</a>
                    </li>
                    <li>
                        <a href="https://linkedin.com" target="_blank" itemprop="sameAs">LinkedIn</a>
                    </li>
                </ul>
            </div>
        </div>

        <address itemscope itemtype="http://schema.org/PostalAddress">
            <h3>Endereço</h3>
            <p itemprop="streetAddress"><?php the_field('contactAddress')?></p>
        </address>
        </div>
</section>