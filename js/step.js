document.addEventListener("DOMContentLoaded", function() {
    let basePrice = parseFloat(<?= json_encode($price) ?>);
    let subtotalElement = document.getElementById("subtotal");

    function updateSubtotal() {
        let total = basePrice;
        document.querySelectorAll("input[type='checkbox']:checked, input[type='radio']:checked").forEach(input => {
            let optionPrice = parseFloat(input.getAttribute("data-price")) || 0;
            total += optionPrice;
        });

        subtotalElement.textContent = total.toFixed(2);
    }

    document.querySelectorAll("input[type='checkbox'], input[type='radio']").forEach(input => {
        input.addEventListener("change", updateSubtotal);
    });
});