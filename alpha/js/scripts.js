document.addEventListener("DOMContentLoaded", function () {

    window.scrollTo(0, 0);

    console.log("Smooth scroll script loaded!"); 
    document.querySelectorAll('.filter a[href^="#"]').forEach(anchor => {
        anchor.addEventListener("click", function (e) {
            e.preventDefault();

            const targetId = this.getAttribute("href").substring(1);
            const targetElement = document.getElementById(targetId);

            if (targetElement) {
                const offset = 210; 
                const elementPosition = targetElement.getBoundingClientRect().top + window.scrollY;

                console.log("Scrolling to:", targetId); 

                window.scrollTo({
                    top: elementPosition - offset,
                    behavior: "smooth"
                });
            }
        });
    });
});

// for payment screen, the place button is disabled when the payment method is not chose
function goToPaymentSelection() {
    window.location.href = "payment-selection.html";
}

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