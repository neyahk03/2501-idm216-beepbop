document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".product-count").forEach(function (counter) {
        let minusBtn = counter.querySelector(".minus-btn");
        let plusBtn = counter.querySelector(".plus-btn");
        let quantityInput = counter.querySelector(".number-product");
        let index = counter.getAttribute("data-index");
        let pricePerItem = parseFloat(counter.getAttribute("data-price-per-item"));

        // Get the correct item subtotal element
        let subtotalElement = counter.closest(".food-details").querySelector(".item-subtotal");

        let bagSubtotalElement = document.querySelector("#bag-subtotal");
        let totalSubtotalElement = document.querySelector(".total-subtotal");

        function updateCart(newQuantity) {
            fetch("functions/change_quantity.php", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({ index: index, quantity: newQuantity })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    quantityInput.value = newQuantity;
                    subtotalElement.textContent = "$" + (newQuantity * pricePerItem).toFixed(2);
                    
                    if (bagSubtotalElement) {
                        bagSubtotalElement.textContent = "$" + data.bag_subtotal.toFixed(2);
                    }
                    if (totalSubtotalElement) {
                        totalSubtotalElement.textContent = "$" + data.bag_subtotal.toFixed(2);
                    }

                    // Disable the minus button if quantity is 1
                    minusBtn.disabled = newQuantity === 1;
                } else {
                    alert("Error updating cart.");
                }
            })
            .catch(error => console.error("Error:", error));
        }

        // Initialize the minus button state
        minusBtn.disabled = parseInt(quantityInput.value) === 1;

        minusBtn.addEventListener("click", function () {
            let currentQuantity = parseInt(quantityInput.value);
            if (currentQuantity > 1) { 
                updateCart(currentQuantity - 1);
            }
        });

        plusBtn.addEventListener("click", function () {
            let currentQuantity = parseInt(quantityInput.value);
            updateCart(currentQuantity + 1);
        });
    });
});

