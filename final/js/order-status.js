document.addEventListener("DOMContentLoaded", function () {
    const progressBar = document.querySelector(".progress-bar");
    const inProgress = document.querySelector(".status.in-progress");
    const done = document.getElementById("done");
    const orderStatusText = document.getElementById("order-status");

    if (progressBar.dataset.complete === "false") {
        // Blink effect
        let blinkCount = 6; // Number of blinks
        let blinkInterval = setInterval(() => {
            inProgress.classList.toggle("blink");
            blinkCount--;
            if (blinkCount <= 0) {
                clearInterval(blinkInterval);
                inProgress.classList.remove("blink");

                // Change to completed state
                done.style.opacity = "1";
                orderStatusText.textContent = "Order is completed. Pick up now!";
            }
        }, 500);
    } else {
        // If order is complete, set directly to completed state
        done.style.opacity = "1";
        orderStatusText.textContent = "Order is completed. Pick up now!";
    }
});
