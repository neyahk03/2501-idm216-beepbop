// document.addEventListener("DOMContentLoaded", function () {
//     const totalSubtotalElement = document.querySelector(".total-subtotal");

//     document.querySelectorAll(".product-count").forEach((container) => {
//         const minusBtn = container.querySelector(".minus-btn");
//         const plusBtn = container.querySelector(".plus-btn");
//         const quantityInput = container.querySelector(".number-product");
//         const itemSubtotal = container.closest(".food-details").querySelector(".item-subtotal");
//         const itemCard = container.closest(".food-card"); // The entire item container
//         const itemIndex = container.dataset.index;
//         const pricePerItem = parseFloat(container.dataset.pricePerItem);

//         function updateQuantity(change) {
//             let currentQuantity = parseInt(quantityInput.value);
//             let newQuantity = currentQuantity + change;

//             if (newQuantity < 1) {
//                 // If quantity is 0, remove the item from the cart
//                 fetch("functions/remove_item.php", {

//                     method: "POST",
//                     headers: { "Content-Type": "application/x-www-form-urlencoded" },
//                     body: `index=${itemIndex}`
//                 }).then(response => response.json())
//                   .then(data => {
//                       if (data.success) {
//                           itemCard.remove(); // Remove the item from the UI
//                           updateTotalSubtotal();
//                         //   update menu quanitty
//                           updateCartQuantity(); 
//                       }
//                   });
//                 return;
//             }

//             // Update quantity and subtotal
//             quantityInput.value = newQuantity;
//             let newSubtotal = (newQuantity * pricePerItem).toFixed(2);
//             itemSubtotal.textContent = `$${newSubtotal}`;

//             // Update total subtotal
//             updateTotalSubtotal();

//             // Send updated quantity to the server
//             fetch("functions/change_quantity.php", {
//                 method: "POST",
//                 headers: { "Content-Type": "application/x-www-form-urlencoded" },
//                 body: `index=${itemIndex}&quantity=${newQuantity}`
//             });
//         }

//         minusBtn.addEventListener("click", () => updateQuantity(-1));
//         plusBtn.addEventListener("click", () => updateQuantity(1));
//     });

//     function updateCartQuantity(quantity) {
//         const quantityElement = document.getElementById("quantity");
//         if (quantityElement) {
//             quantityElement.textContent = quantity;
//         }
//     }

//     function updateTotalSubtotal() {
//         let totalSubtotal = 0;
//         document.querySelectorAll(".item-subtotal").forEach((subtotalElement) => {
//             totalSubtotal += parseFloat(subtotalElement.textContent.replace("$", ""));
//         });

//         totalSubtotalElement.textContent = `$${totalSubtotal.toFixed(2)}`;
//     }
// });

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

