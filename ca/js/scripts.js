
// for payment screen, the place button is disabled when the payment method is not chose


document.addEventListener("DOMContentLoaded", function () {
    console.log("Payment screen loaded");

    const paymentContainer = document.querySelector(".choose-payment");
    const placeOrderButton = document.getElementById("place-order-button");

    if (!paymentContainer || !placeOrderButton) {
        console.error("Error: Required elements not found in DOM.");
        return;
    }

    function updateButtonState() {
        const selectedPayment = localStorage.getItem("paymentMethod");
        const selectedPaymentIcon = localStorage.getItem("paymentIcon");

        if (selectedPayment && selectedPaymentIcon) {
            // Replace the whole .choose-payment div content
            paymentContainer.innerHTML = `
                <div class="selected-payment" style="padding-left: 1.5rem;">
                    <img src="${selectedPaymentIcon}" alt="${selectedPayment}">
                </div>
            `;
        } else {
            // Default display
            paymentContainer.innerHTML = `
                <img src="../images/icons/add.svg" alt="Add icon">
                <p>Add payment method</p>
            `;
        }

        if (selectedPayment) {
            placeOrderButton.classList.remove("disabled"); 

        } else {
            placeOrderButton.classList.add("disabled");

        }
    }

    updateButtonState();
});

// for the payment selection confirm button
function confirmPayment() {
    const selectedPayment = document.querySelector('input[name="payment"]:checked');

    if (selectedPayment) {
        const selectedIcon = selectedPayment.getAttribute("data-icon"); 
        localStorage.setItem("paymentMethod", selectedPayment.value);
        localStorage.setItem("paymentIcon", selectedIcon);
        window.location.href = "payment-1.html"; 
    } else {
        alert("Please select a payment method.");
    }
}

function goToPaymentSelection() {
    window.location.href = "payment-selection.html";
}

function goToOrderStatus() {
    window.location.href = "order-status.html";
}

document.addEventListener("DOMContentLoaded", function () {
    console.log("Script loaded for view order status");
});
