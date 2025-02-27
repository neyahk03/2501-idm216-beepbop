
let decrementBtn = document.querySelector(".decrement");
        let incrementBtn = document.querySelector(".increment");
        let quantityInput = document.querySelector(".number-product"); // Define quantityInput

        function updateButtons() {
            decrementBtn.disabled = parseInt(quantityInput.value) <= 1;
        }

        // Increment button functionality
        incrementBtn.addEventListener("click", function (event) {
            event.preventDefault();
            quantityInput.value = parseInt(quantityInput.value) + 1;
            updateButtons();
        });

        // Decrement button functionality
        decrementBtn.addEventListener("click", function (event) {
            event.preventDefault();
            if (parseInt(quantityInput.value) > 1) {
                quantityInput.value = parseInt(quantityInput.value) - 1;
            }
            updateButtons();
        });

        // Initialize button states
        updateButtons();


        // heart button
        document.querySelector(".heart-btn").addEventListener("click", function() {
            let img = this.querySelector("img");
            if (img.src.includes("heart-empty.svg")) {
                img.src = "../images/icons/heart-full.svg"; // Change to filled heart
            } else {
                img.src = "../images/icons/heart-empty.svg"; // Revert to outline heart
            }
        });