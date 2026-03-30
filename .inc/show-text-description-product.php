<?php
function exibir_texto_por_linha_produto() {
    $linhas = get_the_terms(get_the_ID(), 'linha');

    if ($linhas && !is_wp_error($linhas)) {
        foreach ($linhas as $linha) {
            $nome_linha = strtolower($linha->name);
            $link_catalogo = site_url('/catalogo'); // ajuste se a URL for diferente

            switch ($nome_linha) {
                case 'bieleta':
                    echo '<meta name="description" content="Descubra por que a bieleta é essencial para a segurança e estabilidade da sua suspensão. Conheça a linha completa em nosso catálogo.">';
                    echo '<p>
                        Se você busca segurança e controle ao dirigir, a <strong>bieleta</strong> é uma peça-chave que não pode faltar no sistema de suspensão do seu veículo. Ela conecta a barra estabilizadora ao amortecedor ou bandeja, reduzindo o balanço lateral em curvas e manobras bruscas.
                    </p><p>
                        Muitos motoristas negligenciam essa peça até que problemas como ruídos ou instabilidade apareçam. O segredo é agir antes disso. Ao escolher uma bieleta de qualidade, você protege os componentes da suspensão, aumenta a durabilidade do sistema e garante conforto na direção.
                    </p><p>
                        Imagine fazer uma curva em alta velocidade e sentir seu carro firme, sem oscilações. Isso é o resultado de uma bieleta bem ajustada e em perfeito estado. Ela proporciona <strong>estabilidade, segurança e confiança</strong> a cada quilômetro rodado.
                    </p><p>
                        Em nosso <a href="' . esc_url($link_catalogo) . '">catálogo de peças</a>, você encontra bieletas testadas, certificadas e compatíveis com os principais modelos do mercado. Não deixe a segurança da sua família nas mãos da sorte — <strong>invista agora</strong> na peça certa.
                    </p></section>';
                    break;

                case 'bucha':
                    echo '<meta name="description" content="Bucha automotiva: absorva impactos, reduza ruídos e aumente a vida útil da suspensão. Confira o catálogo completo agora mesmo.">';
                    echo '<p>
                        As <strong>buchas automotivas</strong> são como escudos silenciosos dentro do seu carro. Elas absorvem impactos e vibrações entre peças metálicas, protegendo o sistema de suspensão e garantindo um rodar mais confortável e silencioso.
                    </p><p>
                        Se você já sentiu ruídos secos ou vibrações excessivas ao passar por buracos, é bem provável que suas buchas estejam desgastadas. E é aí que mora o perigo: buchas ruins comprometem o alinhamento, o conforto e até a segurança.
                    </p><p>
                        A boa notícia? Substituí-las é rápido e acessível. Melhor ainda quando você escolhe uma peça de qualidade, como as disponíveis no nosso <a href="' . esc_url($link_catalogo) . '">catálogo de produtos</a>. Cada bucha é pensada para oferecer <strong>máxima durabilidade e desempenho</strong>.
                    </p><p>
                        Escolha agora investir em silêncio, conforto e proteção. Não adie o cuidado que seu carro merece.
                    </p></section>';
                    break;

                case 'coxim':
                    echo '<meta name="description" content="Coxim automotivo de qualidade reduz ruídos e protege o motor e suspensão. Veja a linha completa no nosso catálogo.">';
                    echo '<p>
                        O <strong>coxim</strong> é aquele herói oculto que protege seu motor e sua suspensão contra os impactos do dia a dia. Ele atua como amortecedor entre o chassi e o motor (ou a suspensão), reduzindo ruídos, trepidações e até o desgaste precoce de outros componentes.
                    </p><p>
                        Se você está ouvindo barulhos metálicos ou sentindo o carro vibrar demais, pode ser sinal de que o coxim está comprometido. Trocar essa peça é uma decisão inteligente, que evita danos maiores e traz mais conforto ao volante.
                    </p><p>
                        Em nosso <a href="' . esc_url($link_catalogo) . '">catálogo de produtos</a>, você encontra coxins de alta performance, compatíveis com os principais modelos e marcas. Não vale a pena economizar em algo tão essencial.
                    </p><p>
                        Tenha mais tranquilidade, menos ruídos e um carro com mais vida útil. <strong>Escolha o coxim certo e sinta a diferença</strong> desde a primeira partida.
                    </p></section>';
                    break;

                case 'kit':
                    echo '<meta name="description" content="Kit de suspensão completo para mais economia, desempenho e segurança. Veja agora o que temos para seu carro.">';
                    echo '<p>
                        Um <strong>kit automotivo</strong> é a melhor escolha para quem quer economia e praticidade. Ao reunir várias peças essenciais em um só conjunto, ele garante compatibilidade, segurança e um excelente custo-benefício.
                    </p><p>
                        Se você está fazendo a manutenção da suspensão, direção ou motor, não corra o risco de usar peças incompatíveis. Com o kit certo, você tem a certeza de um ajuste perfeito e uma instalação mais rápida, sem retrabalho.
                    </p><p>
                        Oferecemos kits completos, com buchas, bieletas, coxins e muito mais, testados e aprovados para o mercado nacional. Explore agora nosso <a href="' . esc_url($link_catalogo) . '">catálogo de peças</a> e garanta um conjunto pronto para atender sua necessidade.
                    </p><p>
                        <strong>Compre certo, de uma só vez</strong>, e evite dores de cabeça. Seu carro agradece — e seu bolso também.
                    </p></section>';
                    break;

                default:
                    echo '<meta name="description" content="Explore os produtos da linha ' . esc_attr($linha->name) . ' e conheça soluções de alta qualidade no nosso catálogo.">';
                    echo '<section class="descricao-linha"><p>
                        Este produto pertence à linha <strong>' . esc_html($linha->name) . '</strong>. Para saber mais, acesse nosso <a href="' . esc_url($link_catalogo) . '">catálogo completo</a> e descubra todas as soluções que oferecemos.
                    </p></section>';
                    break;
            }

            break; // exibe apenas o primeiro termo encontrado
        }
    }
}
