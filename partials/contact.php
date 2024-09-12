<section class="contactHeader" itemscope itemtype="http://schema.org/ContactPage">
    <h1 itemprop="name"><?php the_title()?></h1>
    <nav aria-label="breadcrumb">
        <ol>
            <li><a href="/" itemprop="breadcrumb">Home</a></li>
            <li><a href="/contato" itemprop="breadcrumb">Contato</a></li>
        </ol>
    </nav>
</section>

<section class="contactInfo" itemscope itemtype="http://schema.org/ContactPage">
    <div class="content">
        <h2 itemprop="headline">Fale Conosco</h2>
        <p itemprop="description">Prezamos pela comunicação eficaz e a capacidade de ouvir, por isso, disponibilizamos diferentes canais de contato. Dúvidas sobre algum produto da Mobensani? Solicitações ou sugestões? Fale conosco, estamos prontos para te atender.</p>
    </div>

    <article class="relationshipCenter" itemscope itemtype="http://schema.org/Organization">
        <h3 itemprop="department">Central de Relacionamento Zap Peças</h3>
        <ul>
            <li><strong>E-mail:</strong> <a href="mailto:comercial@zappecas.com.br" itemprop="email">comercial@zappecas.com.br</a></li>
            <li><strong>Fones:</strong> <a href="tel:+5511999999999" itemprop="telephone">+55 11 9999-9999</a> | <a href="tel:+5511999999999" itemprop="telephone">+55 11 99999-9999</a></li>
        </ul>
    </article>

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

    <address itemscope itemtype="http://schema.org/PostalAddress">
        <h3>Endereço</h3>
        <p itemprop="streetAddress">Bla bla</p>
    </address>
</section>


<section class="contactGoogleMaps">
    <iframe src="" frameborder="0"></iframe>
</section>

<section class="contactForm">
    <h2>Formulário de Contato</h2>
    <p>Se preferir, preencha os campos com os seu dados e nos envie sua mensagem por aqui, nossa equipe está pronta para te atender</p>

    <mark>Campos marcados com <span>*</span> são requeridos</mark>

    <form action="">
        <label for="name">Seu nome <span>*</span></label>
        <input name="name" type="text">

        <label for="email">E-mail <span>*</span></label>
        <input name="email" type="email">

        <label for="phone">Telefone</label>
        <input name="phone" type="text">

        <label for="message">Sua mensagem <span>*</span></label>
        <textarea name="message" id=""></textarea>

        <strong>Li e aceito <span>*</span></strong>

        <input type="checkbox" name="accpect" id="">
        <p>Estou de acordo em fornecer meus dados pessoais como: nome, e-mail, CPF, telefone e endereço para que a Mobensani entre em contato comigo por telefone ou e-mail. De acordo com a LGPD posso a qualquer tempo, solicitar o acesso aos meus dados pessoais, bem como a sua retificação, eliminação, limitação do seu tratamento e portabilidade dos meus dados. Se houver dúvidas posso contatar a Mobensani conforme Política de Privacidade.</p>
        <button>Enviar mensagem</button>
    </form>
</section>