document.addEventListener("DOMContentLoaded", function () {
    let basePriceElement = document.getElementById("subtotal");
    let subtotalInput = document.getElementById("subtotal_input");
    let quantityInput = document.querySelector(".number-product");
    let decrementBtn = document.querySelector(".decrement");
    let incrementBtn = document.querySelector(".increment");

    const maxQuantity = 10;

    if (basePriceElement) {
        let basePrice = parseFloat(basePriceElement.dataset.basePrice);

        function updateSubtotal() {
            let total = basePrice;
            document.querySelectorAll("input[type='checkbox']:checked, input[type='radio']:checked").forEach(input => {
                let optionPrice = parseFloat(input.getAttribute("data-price")) || 0;
                total += optionPrice;
            });

            let quantity = parseInt(quantityInput.value) || 1;
            let finalTotal = total * quantity;

            basePriceElement.textContent = finalTotal.toFixed(2);
            subtotalInput.value = finalTotal.toFixed(2);
        }

        document.querySelectorAll("input[type='checkbox'], input[type='radio']").forEach(input => {
            input.addEventListener("change", updateSubtotal);
        });

        function updateButtons() {
            decrementBtn.disabled = parseInt(quantityInput.value) <= 1;
        }

        incrementBtn.addEventListener("click", function (event) {
            event.preventDefault();
            quantityInput.value = parseInt(quantityInput.value) + 1;
            updateSubtotal();
            updateButtons();
        });

        decrementBtn.addEventListener("click", function (event) {
            event.preventDefault();
            if (parseInt(quantityInput.value) > 1) {
                quantityInput.value = parseInt(quantityInput.value) - 1;
                updateSubtotal();
            }
            updateButtons();
        });

        updateSubtotal();
        updateButtons();
    }
});
