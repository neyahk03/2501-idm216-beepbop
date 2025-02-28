document.querySelector(".heart-btn").addEventListener("click", function() {
    console.log('button is clicked')
    let img = this.querySelector("img");
    if (img.src.includes("heart-empty.svg")) {
        img.src = "../images/icons/heart-full.svg"; // Change to filled heart
    } else {
        img.src = "../images/icons/heart-empty.svg"; // Revert to outline heart
    }
});