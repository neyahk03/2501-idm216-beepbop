// document.addEventListener("DOMContentLoaded", function () {
//     const pickupButtons = document.querySelectorAll(".pickup-selection button");
//     const tipsButtons = document.querySelectorAll(".tips-selection button");

//     function selectPickupTime(time) {
//         document.getElementById("selected-time").textContent = time;
//         sessionStorage.setItem("pickup_time", time);

//         // Remove active class from all buttons
//         pickupButtons.forEach(btn => btn.classList.remove("active"));
//         // Add active class to the clicked button
//         event.target.classList.add("active");
//     }

//     function updateTotal(tip) {
//         sessionStorage.setItem("selected_tip", tip);
        

//         // Remove active class from all buttons
//         tipsButtons.forEach(btn => btn.classList.remove("active"));
//         // Add active class to the clicked button
//         event.target.classList.add("active");
//     }

//     // Attach event listeners to pickup time buttons
//     pickupButtons.forEach(button => {
//         button.addEventListener("click", function () {
//             selectPickupTime(this.textContent);
//         });
//     });

//     // Attach event listeners to tip buttons
//     tipsButtons.forEach(button => {
//         button.addEventListener("click", function () {
//             updateTotal(parseFloat(this.textContent.replace("$", "")) || 0);
//         });
//     });

// });

// function updateTotal(tipAmount) {
//     // Update the tips amount in the div
//     document.querySelector(".tips p:last-child").textContent = `$${tipAmount.toFixed(2)}`;
    
//     // Get the existing subtotal and tax from the page
//     let subtotal = parseFloat(document.querySelector(".bag-subtotal h4:last-child").textContent.replace('$', ''));
//     let tax = parseFloat(document.querySelector(".tax p:last-child").textContent.replace('$', ''));
    
//     // Calculate new total
//     let newTotal = subtotal + tax + tipAmount;
    
//     // Update the total in the UI
//     document.querySelector(".bag-total h2:last-child").textContent = `$${newTotal.toFixed(2)}`;
// }

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
