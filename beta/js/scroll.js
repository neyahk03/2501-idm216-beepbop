document.querySelectorAll('.filter a').forEach(link => {
    link.addEventListener('click', function(event) {
        event.preventDefault();

        const targetId = this.getAttribute('href').substring(1);
        const targetElement = document.getElementById(targetId);
        const scrollContainer = document.querySelector('.menu-container'); // Change this if needed

        if (targetElement && scrollContainer) {
            scrollContainer.scrollTo({
                top: targetElement.offsetTop - scrollContainer.offsetTop,
                behavior: 'smooth'
            });
        }
    });
});

