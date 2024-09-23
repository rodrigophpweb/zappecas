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