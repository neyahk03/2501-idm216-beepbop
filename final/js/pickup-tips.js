document.addEventListener("DOMContentLoaded", function () {
    // Handle Tips Selection
    const tipOptions = document.querySelectorAll(".tips-selection label");
    const tipDisplay = document.querySelector(".tips p:last-child");
    const subtotalDisplay = document.querySelector(".bag-subtotal h4:last-child");
    const totalDisplay = document.querySelector(".bag-total h2:last-child");
    const taxDisplay = document.querySelector(".tax p:last-child");

    let subtotal = parseFloat(subtotalDisplay.textContent.replace("$", "")); 
    let taxRate = 0.06;
    let selectedTip = 0.00;

    tipOptions.forEach(option => {
        option.addEventListener("click", function () {
            // Remove 'selected' class only within the tips section
            tipOptions.forEach(opt => opt.classList.remove("selected"));

            // Add 'selected' class to clicked tip
            this.classList.add("selected");

            // Update tip value
            selectedTip = parseFloat(this.getAttribute("data-value"));
            tipDisplay.textContent = `$${selectedTip.toFixed(2)}`;

            // Recalculate total
            let newTotal = subtotal + (subtotal * taxRate) + selectedTip;
            taxDisplay.textContent = `$${(subtotal * taxRate).toFixed(2)}`;
            totalDisplay.textContent = `$${newTotal.toFixed(2)}`;
        });
    });

    // Handle Pickup Time Selection
    const pickupOptions = document.querySelectorAll(".pickup-selection label");
    const pickupTimeInput = document.getElementById("selectedPickupTime");

    pickupOptions.forEach(option => {
        option.addEventListener("click", function () {
            // Remove 'selected' class from all options
            pickupOptions.forEach(opt => opt.classList.remove("selected"));

            // Add 'selected' class to the clicked pickup time
            this.classList.add("selected");

            // Get selected value and update the hidden input field
            let selectedTime = this.getAttribute("data-value");
            pickupTimeInput.value = selectedTime;

            // Update the hidden radio button as well (if needed)
            this.querySelector("input").checked = true;
        });
    });
});
