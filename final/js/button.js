function goToOrderStatus() {
    window.location.href = "order-status.html";
}

document.addEventListener("DOMContentLoaded", function () {
    console.log("Script loaded");
});

function viewOrderStatus() {
    window.location.href = "order-status.html"
}

function gotoConfirmOrder() {
    window.location.href = "confirm.html"
}

function gotoHome2() {
    window.location.href = "home2.html"
}

function gotoLogIn() {
    window.location.href = "log-in.html"
}

function gotoMenu() {
    window.location.href = "menu.php"
}

function gotoPayment() {
    window.location.href = "payment-1.html"
}

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