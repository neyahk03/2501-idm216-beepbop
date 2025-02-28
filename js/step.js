// document.addEventListener("DOMContentLoaded", function () {
//     let basePriceElement = document.getElementById("subtotal");
//     let subtotalInput = document.getElementById("subtotal_input");
//     let quantityInput = document.querySelector(".number-product");
//     let decrementBtn = document.querySelector(".decrement");
//     let incrementBtn = document.querySelector(".increment");

//     if (basePriceElement) {
//         let basePrice = parseFloat(basePriceElement.dataset.basePrice);

//         function updateSubtotal() {
//             let total = basePrice;
//             document.querySelectorAll("input[type='checkbox']:checked, input[type='radio']:checked").forEach(input => {
//                 let optionPrice = parseFloat(input.getAttribute("data-price")) || 0;
//                 total += optionPrice;
//             });

//             let quantity = parseInt(quantityInput.value) || 1;
//             let finalTotal = total * quantity;

//             basePriceElement.textContent = finalTotal.toFixed(2);
//             subtotalInput.value = finalTotal.toFixed(2);
//         }

//         document.querySelectorAll("input[type='checkbox'], input[type='radio']").forEach(input => {
//             input.addEventListener("change", updateSubtotal);
//         });

//         function updateButtons() {
//             decrementBtn.disabled = parseInt(quantityInput.value) <= 1;
//         }

//         incrementBtn.addEventListener("click", function (event) {
//             event.preventDefault();
//             quantityInput.value = parseInt(quantityInput.value) + 1;
//             updateSubtotal();
//             updateButtons();
//         });

//         decrementBtn.addEventListener("click", function (event) {
//             event.preventDefault();
//             if (parseInt(quantityInput.value) > 1) {
//                 quantityInput.value = parseInt(quantityInput.value) - 1;
//                 updateSubtotal();
//             }
//             updateButtons();
//         });

//         updateSubtotal();
//         updateButtons();
//     }
// });

// function updateBagQuantity() {
//     fetch("get_quantity.php")
//         .then(response => response.json())
//         .then(data => {
//             const quantityElement = document.getElementById("quantity");

//             if (data.totalQuantity > 0) {
//                 quantityElement.textContent = data.totalQuantity;
//                 quantityElement.style.display = "inline-block"; 
//             } else {
//                 quantityElement.style.display = "none"; 
//             }
//         })
//         .catch(error => console.error("Error fetching cart quantity:", error));
// }

// // Call this function after adding/removing items
// document.addEventListener("DOMContentLoaded", () => {
//     updateBagQuantity(); // Initial load
// });



document.addEventListener("DOMContentLoaded", function () {
    let basePriceElement = document.getElementById("subtotal");
    let subtotalInput = document.getElementById("subtotal_input");
    let quantityInput = document.querySelector(".number-product");
    let decrementBtn = document.querySelector(".decrement");
    let incrementBtn = document.querySelector(".increment");
    let index = quantityInput.dataset.index; // Get item index from dataset

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

            // **Send update request to update_cart.php**
            updateCart(index, quantity, finalTotal);
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

// ✅ Function to Update Cart via AJAX
function updateCart(index, quantity, subtotal) {
    fetch("update_quantity.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: `index=${index}&quantity=${quantity}&subtotal=${subtotal}`
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            updateBagQuantity(); // Update bag quantity dynamically
        }
    })
    .catch(error => console.error("Error updating cart:", error));
}

// ✅ Function to Update Shopping Bag Quantity
function updateBagQuantity() {
    fetch("get_quantity.php")
        .then(response => response.json())
        .then(data => {
            const quantityElement = document.getElementById("quantity");

            if (data.totalQuantity > 0) {
                quantityElement.textContent = data.totalQuantity;
                quantityElement.style.display = "inline-block"; 
            } else {
                quantityElement.style.display = "none"; 
            }
        })
        .catch(error => console.error("Error fetching cart quantity:", error));
}

// ✅ Ensure the bag quantity updates on page load
document.addEventListener("DOMContentLoaded", () => {
    updateBagQuantity();
});
