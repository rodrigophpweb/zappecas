// Component Banner
document.addEventListener("DOMContentLoaded", function() {
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
});

document.querySelectorAll('.state').forEach(state => {
    state.addEventListener('click', function() {
        const stateId = this.id; // Obtém o ID do estado clicado

        fetch(`/wp-json/wp/v2/representante?state=${stateId}`)
        .then(response => response.json())
        .then(data => {
            const listRepresentants = document.getElementById('listRepresentants');
            listRepresentants.innerHTML = ''; // Limpa a lista anterior

            if (data.length > 0) {
                data.forEach(representant => {
                    const titleLi = document.createElement('li');
                    titleLi.innerHTML = `<span class="titleRepresentantName">${representant.title}</span>`; // Acesse 'title' diretamente
                    
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

                    const phraseRepresentant = document.querySelector('#phraseRepresentant');
                    phraseRepresentant.style.display = 'none';

                    const titleRepresentant = document.querySelector('.titleRepresentant');
                    titleRepresentant.style.display = "block";

                });
            } else {
                listRepresentants.innerHTML = '<p>Nenhum representante encontrado para este estado.</p>';
            }
        })
        .catch(error => console.error('Erro ao buscar representantes:', error));
        
    });
});


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

// Fade-in Animation
const fadeSection = document.querySelector('.fade-in-section');

// Observador para o efeito fade-in
const observer = new IntersectionObserver(entries => {
entries.forEach(entry => {
    if (entry.isIntersecting) {
        fadeSection.classList.add('fade-in');
        observer.unobserve(fadeSection); // Para de observar após ativar
    }
    });
});

observer.observe(fadeSection);

// Scale-up Animation para Mission, Vision, Values
const scaleSection = document.querySelector('.scale-up-section');

// Observador para o efeito scale-up
const mvv = new IntersectionObserver(entries => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            scaleSection.classList.add('scale-in');
            mvv.unobserve(scaleSection); // Para de observar após ativar
        }
    });
});

mvv.observe(scaleSection);


function animateCountUp(element, targetValue, duration) {
    let startValue = 0;
    let increment = targetValue / (duration / 50); // Dividir o total de tempo pelo número de incrementos
    let currentValue = startValue;
    let interval = setInterval(function () {
        currentValue += increment;
        if (currentValue >= targetValue) {
            currentValue = targetValue;
            clearInterval(interval);
        }
        element.innerText = Math.floor(currentValue); // Atualiza o número no HTML
    }, 50);
}

// Função para verificar se a seção está visível na tela
function checkVisibility() {
    const section = document.querySelector('.companyYourNumbers');
    const numbers = document.querySelectorAll('.companyYourNumbers .count');

    const yourNumbers = new IntersectionObserver((entries, yourNumbers) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                // Quando a seção entra na tela, começa a animação de contagem
                numbers.forEach((number, index) => {
                    const targetValue = parseInt(number.getAttribute('data-target'), 10); // Aqui pegamos o valor do data-target
                    if (!isNaN(targetValue)) {
                        animateCountUp(number, targetValue, 2000); // 2000ms = 2 segundos para contar
                    }
                });
                yourNumbers.disconnect(); // Para a observação após disparar a animação
            }
        });
    }, { threshold: 0.5 }); // Ajuste do threshold para garantir que 50% da seção esteja visível

    yourNumbers.observe(section); // Observa a seção 'companyYourNumbers'
}
checkVisibility();
