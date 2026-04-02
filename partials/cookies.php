<div id="cookie-consent" class="cookie-box">
  <p>Usamos cookies para melhorar sua experiência em nosso site. Ao continuar navegando, você concorda com nossa <?php $privacy_page = get_page_by_path('politica-de-privacidade'); if ($privacy_page) { ?><a href="<?php echo esc_url(get_permalink($privacy_page->ID)); ?>" target="_blank" rel="noopener noreferrer">Política de Privacidade</a><?php } else { ?><a href="/politica-de-privacidade" target="_blank" rel="noopener noreferrer">Política de Privacidade</a><?php } ?>.</p>
  <button id="accept-cookies">Aceitar</button>
</div>
