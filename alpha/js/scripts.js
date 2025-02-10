document.addEventListener("DOMContentLoaded", function () {

    window.scrollTo(0, 0);

    console.log("Smooth scroll script loaded!"); 
    document.querySelectorAll('.filter a[href^="#"]').forEach(anchor => {
        anchor.addEventListener("click", function (e) {
            e.preventDefault();

            const targetId = this.getAttribute("href").substring(1);
            const targetElement = document.getElementById(targetId);

            if (targetElement) {
                const offset = 210; 
                const elementPosition = targetElement.getBoundingClientRect().top + window.scrollY;

                console.log("Scrolling to:", targetId); 

                window.scrollTo({
                    top: elementPosition - offset,
                    behavior: "smooth"
                });
            }
        });
    });
});
