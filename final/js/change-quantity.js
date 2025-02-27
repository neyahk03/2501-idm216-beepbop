document.addEventListener("DOMContentLoaded", function () {
    const totalSubtotalElement = document.querySelector(".total-subtotal");

    document.querySelectorAll(".product-count").forEach((container) => {
        const minusBtn = container.querySelector(".minus-btn");
        const plusBtn = container.querySelector(".plus-btn");
        const quantityInput = container.querySelector(".number-product");
        const itemSubtotal = container.closest(".food-details").querySelector(".item-subtotal");
        const itemCard = container.closest(".food-card"); // The entire item container
        const itemIndex = container.dataset.index;
        const pricePerItem = parseFloat(container.dataset.pricePerItem);

        function updateQuantity(change) {
            let currentQuantity = parseInt(quantityInput.value);
            let newQuantity = currentQuantity + change;

            if (newQuantity < 1) {
                // If quantity is 0, remove the item from the cart
                fetch("remove_item.php", {
                    method: "POST",
                    headers: { "Content-Type": "application/x-www-form-urlencoded" },
                    body: `index=${itemIndex}`
                }).then(response => response.json())
                  .then(data => {
                      if (data.success) {
                          itemCard.remove(); // Remove the item from the UI
                          updateTotalSubtotal();
                      }
                  });
                return;
            }

            // Update quantity and subtotal
            quantityInput.value = newQuantity;
            let newSubtotal = (newQuantity * pricePerItem).toFixed(2);
            itemSubtotal.textContent = `$${newSubtotal}`;

            // Update total subtotal
            updateTotalSubtotal();

            // Send updated quantity to the server
            fetch("change_quantity.php", {
                method: "POST",
                headers: { "Content-Type": "application/x-www-form-urlencoded" },
                body: `index=${itemIndex}&quantity=${newQuantity}`
            });
        }

        minusBtn.addEventListener("click", () => updateQuantity(-1));
        plusBtn.addEventListener("click", () => updateQuantity(1));
    });

    function updateTotalSubtotal() {
        let totalSubtotal = 0;
        document.querySelectorAll(".item-subtotal").forEach((subtotalElement) => {
            totalSubtotal += parseFloat(subtotalElement.textContent.replace("$", ""));
        });

        totalSubtotalElement.textContent = `$${totalSubtotal.toFixed(2)}`;
    }
});

