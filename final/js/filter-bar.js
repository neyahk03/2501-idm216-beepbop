document.addEventListener("DOMContentLoaded", function () {
    const filters = document.querySelectorAll(".filter-bar a");

    filters.forEach(filter => {
        filter.addEventListener("click", function (event) {
            // Remove 'active' class from all links
            filters.forEach(f => f.classList.remove("active"));

            // Add 'active' class to the clicked link
            this.classList.add("active");

            // Allow smooth scrolling to work correctly
        });
    });
});
