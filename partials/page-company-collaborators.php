<section class="companyCollaborators gridMargin" itemscope itemtype="https://schema.org/Organization">
    <meta itemprop="name" content="ZAP Peças">
    
    <h2 itemprop="knowsAbout"><?=esc_html(get_field('titleCollaborators'))?></h2>
    <span class="subtitle" itemprop="slogan"><?=esc_html(get_field('subtitleCollaborators'))?></span>
    
    <div itemprop="employee" itemscope itemtype="https://schema.org/EmployeeRole">
        <meta itemprop="roleName" content="Equipe de Colaboradores">
        
        <div itemprop="description">
            <?=get_field('contentCollaborators')?>
        </div>
        
        <meta itemprop="benefits" content="Treinamentos sistemáticos">
        <meta itemprop="benefits" content="Capacitação contínua">
        <meta itemprop="benefits" content="Desenvolvimento profissional">
        <meta itemprop="benefits" content="Qualificação técnica">
    </div>
    
    <div itemprop="employee" itemscope itemtype="https://schema.org/Person">
        <meta itemprop="jobTitle" content="Profissionais altamente capacitados">
        <meta itemprop="memberOf" content="ZAP Peças">
    </div>
</section>