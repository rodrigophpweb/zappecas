// Component Banner
document.addEventListener("DOMContentLoaded", function() {
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
        nextButton.addEventListener("click", () => {
            currentIndex = (currentIndex + 1) % images.length;
            updateSlider();
        });

        // Lógica para o botão "prev"
        prevButton.addEventListener("click", () => {
            currentIndex = (currentIndex - 1 + images.length) % images.length;
            updateSlider();
        });

        // Lógica para os bullets
        bullets.forEach((bullet, index) => {
            bullet.addEventListener("click", () => {
                currentIndex = index;
                updateSlider();
            });
        });

        // Inicializa o slider
        updateSlider();

        const section = document.querySelector('.frontPageCatalogProducts');
        const figure = section.querySelector('.figure-animate');
        const article = section.querySelector('.article-animate');

        const options = {
            root: null, // viewport
            rootMargin: '0px',
            threshold: 0.1 // 10% do elemento visível
        };

        const callback = (entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    figure.classList.add('show'); // Adiciona classe de animação
                    article.classList.add('show'); // Adiciona classe de animação
                    observer.unobserve(entry.target); // Para observar a seção novamente
                }
            });
        };

        const observer = new IntersectionObserver(callback, options);
        observer.observe(section);
    }
});


if (window.location.pathname.endsWith('representantes/') || window.location.pathname.endsWith('representantes')) {

    // Função para exibir os representantes
    function exibirRepresentantes(data) {
        const listRepresentants = document.getElementById('listRepresentants');
        listRepresentants.innerHTML = ''; // Limpa a lista anterior
    
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
    
                // Adiciona os <li> à lista
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


// Verifica se a URL termina com 'a-empresa/' ou 'a-empresa' (com ou sem a barra)
if (window.location.pathname.endsWith('a-empresa/') || window.location.pathname.endsWith('a-empresa')) {
    // Fade-in Animation
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

    // Scale-up Animation para Mission, Vision, Values
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

// Tab Panel
document.querySelectorAll('[role="tab"]').forEach(tab => {
    tab.addEventListener('click', () => {
        // Deselect all tabs and hide all tab panels
        document.querySelectorAll('[role="tab"]').forEach(t => {
            t.setAttribute('aria-selected', 'false');
            document.getElementById(t.getAttribute('aria-controls')).setAttribute('aria-hidden', 'true');
        });

        // Select the clicked tab and show the corresponding tab panel
        tab.setAttribute('aria-selected', 'true');
        document.getElementById(tab.getAttribute('aria-controls')).setAttribute('aria-hidden', 'false');
    });
});

