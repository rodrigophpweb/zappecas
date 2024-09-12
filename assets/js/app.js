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