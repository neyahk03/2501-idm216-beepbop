document.addEventListener("DOMContentLoaded", function() {
    document.querySelectorAll(".product-count").forEach(container => {
        let minusBtn = container.querySelector(".minus-btn");
        let plusBtn = container.querySelector(".plus-btn");
        let quantityInput = container.querySelector(".number-product");
        let index = container.dataset.index;
        let price = parseFloat(container.dataset.price);
        let subtotalElement = container.closest(".food-card").querySelector(".price");
        let foodCard = container.closest(".food-card"); // To remove item from DOM

        function updateQuantity(newQuantity) {
            fetch("../functions/update_cart.php", {
                method: "POST",
                headers: { "Content-Type": "application/x-www-form-urlencoded" },
                body: `index=${index}&quantity=${newQuantity}`
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    if (newQuantity === 0) {
                        foodCard.remove(); // Remove the item from the DOM
                    } else {
                        quantityInput.value = newQuantity;
                        let newSubtotal = (newQuantity * price).toFixed(2);
                        subtotalElement.textContent = `$${newSubtotal}`;
                    }
                }
            });
        }

        plusBtn.addEventListener("click", () => {
            let newQuantity = Math.min(10, parseInt(quantityInput.value) + 1); // Max limit 10
            updateQuantity(newQuantity);
        });

        minusBtn.addEventListener("click", () => {
            let newQuantity = Math.max(0, parseInt(quantityInput.value) - 1); // Allow zero (removal)
            updateQuantity(newQuantity);
        });
    });
});