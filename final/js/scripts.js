
// for payment screen, the place button is disabled when the payment method is not chose


// for the payment selection confirm button
function confirmPayment() {
    const selectedPayment = document.querySelector('input[name="payment"]:checked');

    if (selectedPayment) {
        const selectedIcon = selectedPayment.getAttribute("data-icon"); 
        localStorage.setItem("paymentMethod", selectedPayment.value);
        localStorage.setItem("paymentIcon", selectedIcon);
        window.location.href = "checkout.php"; 
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
