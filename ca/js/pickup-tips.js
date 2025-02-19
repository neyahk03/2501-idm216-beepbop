document.addEventListener("DOMContentLoaded", function () {
    const pickupOptions = document.querySelectorAll(".pickup-selection p");
    const tipOptions = document.querySelectorAll(".tips p");
    
    // Function to handle selection
    function handleSelection(options) {
        options.forEach(option => {
            option.addEventListener("click", function () {
                // Remove 'selected' class from all options
                options.forEach(opt => opt.classList.remove("selected"));
                // Add 'selected' class to clicked option
                this.classList.add("selected");
            });
        });
    }
    
    // Apply selection handling to pickup options and tip options
    handleSelection(pickupOptions);
    handleSelection(tipOptions);
    
    // Add custom styles for selected state
    const style = document.createElement('style');
    style.innerHTML = `
        .selected {
            background-color: var(--brown); 
            color: white; 
            transition: background-color 0.3s ease, color 0.3s ease;
        }
    `;
    document.head.appendChild(style);
});
