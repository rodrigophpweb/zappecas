// Component Banner
document.addEventListener("DOMContentLoaded", function() {
    document.querySelector('.mnumobile').addEventListener('click', function() {
        const menu = document.querySelector('menu');
        menu.classList.toggle('open');
    });

    if (document.body.classList.contains('home')) {

        const images = document.querySelectorAll(".hero .images figure");
        const prevButton = document.querySelector(".hero .prev");
        const nextButton = document.querySelector(".hero .next");
        const bullets = document.querySelectorAll(".hero .bullets li");
        let currentIndex = 0;

        // Função para atualizar o slider
        function updateSlider() {
            images.forEach((image, index) => {
                image.style.display = index === currentIndex ? "block" : "none";
                image.style.opacity = index === currentIndex ? "1" : "0"; // Opacidade para transição suave
            });

            bullets.forEach((bullet, index) => {
                bullet.classList.toggle("active", index === currentIndex);
            });
        }

        // Lógica para o botão "next"
        nextButton.addEventListener("click", (e) => {
            e.preventDefault();
            e.stopPropagation();
            currentIndex = (currentIndex + 1) % images.length;
            updateSlider();
        });

        // Lógica para o botão "prev"
        prevButton.addEventListener("click", (e) => {
            e.preventDefault();
            e.stopPropagation();
            currentIndex = (currentIndex - 1 + images.length) % images.length;
            updateSlider();
        });

        // Lógica para os bullets
        bullets.forEach((bullet, index) => {
            bullet.addEventListener("click", (e) => {
                e.preventDefault();
                e.stopPropagation();
                currentIndex = index;
                updateSlider();
            });
        });

        updateSlider();

        const sectionPost = document.querySelector('.frontPageBlog');

        const observer = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
            const articles = document.querySelectorAll('.posts article');
            articles.forEach((article, index) => {
                article.style.animation = `slideIn 0.5s forwards ${index * 0.1}s`; // Define o atraso para cada artigo
            });
            observer.disconnect();
            }
        });
        }, {
        threshold: 0.5
        });
        
        observer.observe(sectionPost);
    }

    const section = document.querySelector('.frontPageCatalogProducts, .pageCatalogProducts');

    if (section) {
        const figure = section.querySelector('.figure-animate');
        const article = section.querySelector('.article-animate');

        const options = {
            root: null,
            rootMargin: '0px',
            threshold: 0.1
        };

        const callback = (entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    figure.classList.add('show');
                    article.classList.add('show');
                    observer.unobserve(entry.target);
                }
            });
        };

        const observer = new IntersectionObserver(callback, options);
        observer.observe(section);
    }

    //   Carousel página de produtos
    const carousel = document.querySelector(".carouselNextProducts");
    if (carousel) {
    const track = carousel.querySelector(".carouselContent");
    const items = carousel.querySelectorAll(".carouselItem");
    const prevButton = carousel.querySelector(".btnPrevious");
    const nextButton = carousel.querySelector(".btnNext");
    const bulletsContainer = carousel.querySelector(".carouselNavigation .bullets");

    let currentPage = 0;
    let itemsPerPage = getItemsPerPage();

    function getItemsPerPage() {
        const width = window.innerWidth;
        if (width <= 768) return 1;
        if (width <= 1024) return 2;
        return 3;
    }

    function updateCarousel() {
        const itemWidth = items[0].offsetWidth + 32; // largura + gap
        const offset = itemWidth * itemsPerPage * currentPage;
        track.style.transform = `translateX(-${offset}px)`;
        updateBullets();
    }

    function createBullets() {
        const pages = Math.ceil(items.length / itemsPerPage);
        bulletsContainer.innerHTML = "";
        for (let i = 0; i < pages; i++) {
        const bullet = document.createElement("li");
        if (i === 0) bullet.classList.add("active");
        bullet.addEventListener("click", () => {
            currentPage = i;
            updateCarousel();
        });
        bulletsContainer.appendChild(bullet);
        }
    }

    function updateBullets() {
        bulletsContainer.querySelectorAll("li").forEach((bullet, index) => {
        bullet.classList.toggle("active", index === currentPage);
        });
    }

    prevButton.addEventListener("click", () => {
        currentPage = Math.max(currentPage - 1, 0);
        updateCarousel();
    });

    nextButton.addEventListener("click", () => {
        const totalPages = Math.ceil(items.length / itemsPerPage);
        currentPage = Math.min(currentPage + 1, totalPages - 1);
        updateCarousel();
    });

    window.addEventListener("resize", () => {
        itemsPerPage = getItemsPerPage();
        currentPage = 0;
        createBullets();
        updateCarousel();
    });

    // Inicializar
    createBullets();
    updateCarousel();
    }

    if (window.location.pathname.match(/\/produtos\/?$/)) {
    const figures = document.querySelectorAll('.productDetail');
    const links = document.querySelectorAll('.productList a');

    function showProductById(id) {
        // Mostrar/ocultar produtos
        figures.forEach(fig => {
        fig.style.display = (fig.id === id) ? 'flex' : 'none';
        });

        // Ativar o link correto
        links.forEach(link => {
        link.classList.toggle('active', link.getAttribute('href') === `#${id}`);
        });
    }

    // Inicializar com Bieleta ativada
    showProductById('Bieleta');

    // Listener nos cliques
    links.forEach(link => {
        link.addEventListener('click', function (e) {
        e.preventDefault();
        const targetId = this.getAttribute('href').substring(1);
        showProductById(targetId);
        });
    });

        //   Carousel página de produtos
        const carousel = document.querySelector(".carouselNextProducts");
        if (carousel) {
        const track = carousel.querySelector(".carouselContent");
        const items = carousel.querySelectorAll(".carouselItem");
        const prevButton = carousel.querySelector(".btnPrevious");
        const nextButton = carousel.querySelector(".btnNext");
        const bulletsContainer = carousel.querySelector(".carouselNavigation .bullets");

        let currentPage = 0;
        let itemsPerPage = getItemsPerPage();

        function getItemsPerPage() {
            const width = window.innerWidth;
            if (width <= 768) return 1;
            if (width <= 1024) return 2;
            return 3;
        }

        function updateCarousel() {
            const itemWidth = items[0].offsetWidth + 32; // largura + gap
            const offset = itemWidth * itemsPerPage * currentPage;
            track.style.transform = `translateX(-${offset}px)`;
            updateBullets();
        }

        function createBullets() {
            const pages = Math.ceil(items.length / itemsPerPage);
            bulletsContainer.innerHTML = "";
            for (let i = 0; i < pages; i++) {
            const bullet = document.createElement("li");
            if (i === 0) bullet.classList.add("active");
            bullet.addEventListener("click", () => {
                currentPage = i;
                updateCarousel();
            });
            bulletsContainer.appendChild(bullet);
            }
        }

        function updateBullets() {
            bulletsContainer.querySelectorAll("li").forEach((bullet, index) => {
            bullet.classList.toggle("active", index === currentPage);
            });
        }

        prevButton.addEventListener("click", () => {
            currentPage = Math.max(currentPage - 1, 0);
            updateCarousel();
        });

        nextButton.addEventListener("click", () => {
            const totalPages = Math.ceil(items.length / itemsPerPage);
            currentPage = Math.min(currentPage + 1, totalPages - 1);
            updateCarousel();
        });

        window.addEventListener("resize", () => {
            itemsPerPage = getItemsPerPage();
            currentPage = 0;
            createBullets();
            updateCarousel();
        });

        // Inicializar
        createBullets();
        updateCarousel();
        }
    }

    if (window.location.pathname.match(/\/catalogo\/?$/)) {
        const linha       = document.getElementById('filter-linha');
        const fabricante  = document.getElementById('filter-fabricante');
        const codigo      = document.getElementById('search-codigo');
        const produtos    = document.querySelector('#listProducts');
        const pagination  = document.querySelector('#pagination');

        const fetchProdutos = (paged = 1) => {
            const formData = new FormData();
            formData.append('action', 'filtrar_catalogo');
            formData.append('nonce', custom_script_vars.nonce);
            formData.append('linha', linha.value);
            formData.append('fabricante', fabricante.value);
            formData.append('codigo', codigo.value);
            formData.append('paged', paged);

            fetch(custom_script_vars.ajax_url, {
                method: 'POST',
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    produtos.innerHTML = data.data.html;
                    pagination.innerHTML = data.data.pagination;

                    // Reaplica os eventos de clique aos links do paginador
                    document.querySelectorAll('#pagination a.page-numbers').forEach(link => {
                        link.addEventListener('click', function (e) {
                            e.preventDefault();
                            const paged = new URL(this.href).searchParams.get('paged') || 1;
                            fetchProdutos(paged);
                        });
                    });
                }
            });
        };

        // Eventos para filtros
        [linha, fabricante, codigo].forEach(el => {
            el.addEventListener('change', () => fetchProdutos(1));
            if (el.tagName === 'INPUT') {
                el.addEventListener('keyup', () => fetchProdutos(1));
            }
        });
    }

    if (window.location.pathname.endsWith('representantes/') || window.location.pathname.endsWith('representantes')) {

        function exibirRepresentantes(data) {
            const listRepresentants = document.getElementById('listRepresentants');
            listRepresentants.innerHTML = '';
        
            if (data.length > 0) {
                data.forEach(representant => {
                    const titleLi = document.createElement('li');
                    titleLi.innerHTML = `<span class="titleRepresentantName">${representant.title}</span>`;
                    
                    const nameLi = document.createElement('li');
                    nameLi.innerHTML = `<strong>Nome do Representante: </strong>${representant.acf.nameRepresentant}`;
                    
                    const contactLi = document.createElement('li');
                    contactLi.innerHTML = `<strong>Contato do Representante: </strong>${representant.acf.contactRepresentant}`;
                    
                    const emailLi = document.createElement('li');
                    emailLi.innerHTML = `<strong>E-mail do Representante: </strong>${representant.acf.mailRepresentant}`;

                    const separatorHr = document.createElement('li');
                    separatorHr.innerHTML = `<span class="separatorHr"></span>`;
        
                    listRepresentants.appendChild(titleLi);
                    listRepresentants.appendChild(nameLi);
                    listRepresentants.appendChild(contactLi);
                    listRepresentants.appendChild(emailLi);
                    listRepresentants.appendChild(separatorHr);
                });
        
                const phraseRepresentant = document.querySelector('#phraseRepresentant');
                phraseRepresentant.style.display = 'none';
        
                const titleRepresentant = document.querySelector('.titleRepresentant');
                titleRepresentant.style.display = "block";
        
            } else {
                listRepresentants.innerHTML = '<p>Nenhum representante encontrado para este estado.</p>';
            }
        }

        // Função para buscar representantes com base no estado
        function buscarRepresentantes(stateId) {
            fetch(`/wp-json/wp/v2/representante?state=${stateId}`)
                .then(response => response.json())
                .then(data => {
                    console.log('Representantes encontrados:', data);
                    exibirRepresentantes(data); // Chama a função para exibir os representantes
                })
                .catch(error => console.error('Erro ao buscar representantes:', error));
        }

        // Clique nos estados (SVG)
        document.querySelectorAll('.state').forEach(state => {
            state.addEventListener('click', function() {
                const stateId = this.id;
                console.log('Estado clicado:', stateId);
                buscarRepresentantes(stateId); // Chama a função de busca
            });
        });

        // Mudança no select
        const stateSelect = document.getElementById('stateSelect');
        stateSelect.addEventListener('change', function() {
            const stateId = this.value;
            console.log('Estado selecionado:', stateId);
            buscarRepresentantes(stateId); // Chama a função de busca
        });
    }

    if (window.location.pathname.endsWith('a-empresa/') || window.location.pathname.endsWith('a-empresa')) {
        const fadeSection = document.querySelector('.fade-in-section');

        if (fadeSection) {
            const observer = new IntersectionObserver(entries => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        fadeSection.classList.add('fade-in');
                        observer.unobserve(fadeSection); // Para de observar após ativar
                    }
                });
            });
            observer.observe(fadeSection);
        }

        const scaleSection = document.querySelector('.scale-up-section');
        if (scaleSection) {
            const mvv = new IntersectionObserver(entries => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        scaleSection.classList.add('scale-in');
                        mvv.unobserve(scaleSection); // Para de observar após ativar
                    }
                });
            });
            mvv.observe(scaleSection);
        }

        function animateCountUp(element, targetValue, duration) {
            let startValue = 0;
            let increment = targetValue / (duration / 50);
            let currentValue = startValue;
            let interval = setInterval(function () {
                currentValue += increment;
                if (currentValue >= targetValue) {
                    currentValue = targetValue;
                    clearInterval(interval);
                }
                element.innerText = Math.floor(currentValue);
            }, 50);
        }

        function checkVisibility() {
            const section = document.querySelector('.companyYourNumbers');
            const numbers = document.querySelectorAll('.companyYourNumbers .count');

            if (section) {
                const yourNumbers = new IntersectionObserver((entries, yourNumbers) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            numbers.forEach((number, index) => {
                                const targetValue = parseInt(number.getAttribute('data-target'), 10);
                                if (!isNaN(targetValue)) {
                                    animateCountUp(number, targetValue, 2000);
                                }
                            });
                            yourNumbers.disconnect();
                        }
                    });
                }, { threshold: 0.5 });
                yourNumbers.observe(section);
            }
        }
        checkVisibility();
    }

    // Condições para Taxonomias
    if (window.location.pathname.match(/\/produtos\/(linha|fabricante)(\/.*)?$/)) {

        const lineSelect = document.getElementById("filter-line");
        const fabricanteSelect = document.getElementById("filter-fabricante");
        const searchInput = document.getElementById("search-term");
        const productGrid = document.getElementById("product-grid");
        const pagination = document.getElementById("pagination");

        let currentPage = 1;

        function fetchProducts() {
        const line = lineSelect?.value || '';
        const fabricante = fabricanteSelect?.value || '';
        const search = searchInput?.value || '';

        const params = new URLSearchParams({
            line,
            fabricante,
            search,
            page: currentPage
        });

        fetch(`/wp-json/custom/v1/produtos?${params.toString()}`)
            .then((res) => res.json())
            .then((data) => {
            renderProducts(data.products);
            renderPagination(data.total_pages);
            })
            .catch((err) => {
            console.error("Erro ao buscar produtos:", err);
            });
        }

        function renderProducts(products) {
        productGrid.innerHTML = products.map((prod) => `
            <article class="product-card" itemscope itemtype="https://schema.org/Product">
            <h3 itemprop="name">${prod.title}</h3>
            <p itemprop="description">${prod.excerpt}</p>
            </article>
        `).join('');
        }

        function renderPagination(totalPages) {
        pagination.innerHTML = '';
        for (let i = 1; i <= totalPages; i++) {
            const button = document.createElement("button");
            button.textContent = i;
            button.className = "page-btn";
            button.dataset.page = i;
            if (i === currentPage) {
            button.classList.add("active");
            }
            button.addEventListener("click", () => {
            currentPage = parseInt(button.dataset.page);
            fetchProducts();
            });
            pagination.appendChild(button);
        }
        }

        // Eventos
        lineSelect?.addEventListener("change", () => { currentPage = 1; fetchProducts(); });
        fabricanteSelect?.addEventListener("change", () => { currentPage = 1; fetchProducts(); });
        searchInput?.addEventListener("input", () => {
        currentPage = 1;
        // Delay no search (opcional)
        clearTimeout(searchInput._timeout);
        searchInput._timeout = setTimeout(fetchProducts, 400);
        });

        // Carrega produtos inicialmente
        fetchProducts();
    }

    if (window.location.pathname.includes('/linha/')) {
        const filtro = document.getElementById('filtroFabricante');
        const totalInfo = document.getElementById('totalProdutosLinha');
        const resultado = document.getElementById('resultadoProdutos');
        const paginador = document.getElementById('pagination');
        const linhaSlug = window.location.pathname.split('/').filter(Boolean).pop();

        function carregarProdutos(fabricante = '', page = 1) {
            const url = `${custom_script_vars.ajax_url}?action=filtrar_produtos&fabricante=${fabricante}&linha=${linhaSlug}&page=${page}`;

            resultado.innerHTML = '<p>Carregando...</p>';

            fetch(url)
                .then(res => res.json())
                .then(data => {
                    resultado.innerHTML = data.html;
                    paginador.innerHTML = data.pagination;

                    if (totalInfo) {
                        totalInfo.innerHTML = `O total de "${filtro.options[filtro.selectedIndex].text}" é: ${data.total}`;
                    }

                    // Reaplica o evento aos novos botões da paginação
                    paginador.querySelectorAll('a').forEach(link => {
                        link.addEventListener('click', e => {
                            e.preventDefault();
                            const url = new URL(link.href);
                            const page = url.searchParams.get('paged') || 1;
                            carregarProdutos(filtro.value, page);
                        });
                    });
                });
        }

        if (filtro && resultado && paginador) {
            filtro.addEventListener('change', () => carregarProdutos(filtro.value));
        }
    }

    if (window.location.pathname.endsWith('solicitar-catalogo-impresso/') || window.location.pathname.endsWith('solicitar-catalogo-impresso')) {
        function onCepChange(e) {
            const cep = e.target.value.replace(/\D/g, '');
            if (cep.length === 8) {
                fetch(`https://viacep.com.br/ws/${cep}/json/`)
                .then(res => res.json())
                .then(data => {
                    if (!data.erro) {
                    document.getElementById('endereco').value = data.logradouro;
                    document.getElementById('bairro').value = data.bairro;
                    document.getElementById('cidade').value = data.localidade;
                    document.getElementById('estado').value = data.uf;
                    } else {
                    limpaCampos();
                    alert('CEP não encontrado.');
                    }
                })
                .catch(() => {
                    limpaCampos();
                    alert('Erro ao consultar o CEP.');
                });
            }
        }

        function limpaCampos() {
            document.getElementById('endereco').value = '';
            document.getElementById('bairro').value = '';
            document.getElementById('cidade').value = '';
            document.getElementById('estado').value = '';
        }

        const cepInput = document.getElementById("cep");
        const telefoneInput = document.querySelector('input[name="telefone"]');

        if (cepInput) {
            cepInput.addEventListener("keyup", onCepChange);

            // Máscara para CEP: 00000-000
            cepInput.addEventListener("input", function () {
            let valor = this.value.replace(/\D/g, '');
            if (valor.length > 8) valor = valor.slice(0, 8);
            this.value = valor.replace(/(\d{5})(\d{0,3})/, '$1-$2');
            });
        }

        if (telefoneInput) {
            telefoneInput.addEventListener("input", function () {
                let valor = this.value.replace(/\D/g, '');
                if (valor.length > 11) valor = valor.slice(0, 11);
                if (valor.length <= 10) {
                    this.value = valor.replace(/(\d{2})(\d{4})(\d{0,4})/, '($1) $2-$3');
                } else {
                    this.value = valor.replace(/(\d{2})(\d{5})(\d{0,4})/, '($1) $2-$3');
                }
            });
        }
    }

    // Tab Panel
    document.querySelectorAll('[role="tab"]').forEach(tab => {
        tab.addEventListener('click', () => {
            document.querySelectorAll('[role="tab"]').forEach(t => {
                t.setAttribute('aria-selected', 'false');
                document.getElementById(t.getAttribute('aria-controls')).setAttribute('aria-hidden', 'true');
            });

            tab.setAttribute('aria-selected', 'true');
            document.getElementById(tab.getAttribute('aria-controls')).setAttribute('aria-hidden', 'false');
        });
    });

    const cookieBox = document.getElementById("cookie-consent");
    const acceptBtn = document.getElementById("accept-cookies");

    if (!localStorage.getItem("cookieAccepted")) {
        cookieBox.classList.add("show");
    }

    acceptBtn.addEventListener("click", function () {
        localStorage.setItem("cookieAccepted", "true");
        cookieBox.classList.remove("show");
        setTimeout(() => {
        cookieBox.style.display = 'none';
        }, 300); // para aguardar a transição
    });
});
