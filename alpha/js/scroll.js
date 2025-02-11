// menu filter bar, scroll menu
// document.addEventListener("DOMContentLoaded", function () {

//     window.scrollTo(0, 0);

//     console.log("Smooth scroll script loaded!"); 
//     document.querySelectorAll('.filter a[href^="#"]').forEach(anchor => {
//         anchor.addEventListener("click", function (e) {
//             e.preventDefault();

//             const targetId = this.getAttribute("href").substring(1);
//             const targetElement = document.getElementById(targetId);

//             if (targetElement) {
//                 const offset = 210; 
//                 const elementPosition = targetElement.getBoundingClientRect().top + window.scrollY;

//                 console.log("Scrolling to:", targetId); 

//                 window.scrollTo({
//                     top: elementPosition - offset,
//                     behavior: "smooth"
//                 });
//             }
//         });
//     });
// });

// document.addEventListener("DOMContentLoaded", function () {
//     window.scrollTo(0, 0);
//     console.log("Smooth scroll script loaded!");

//     document.querySelectorAll('.filter a[href^="#"]').forEach(anchor => {
//         anchor.addEventListener("click", function (e) {
//             e.preventDefault();

//             const targetId = this.getAttribute("href").substring(1);
//             const targetElement = document.getElementById(targetId);

//             if (targetElement) {
//                 const offset = 100;
//                 const targetPosition = targetElement.getBoundingClientRect().top + window.scrollY - offset;
//                 smoothScrollTo(window.scrollY, targetPosition, 600); // Adjust duration for smoothness
//             }
//         });
//     });

//     function smoothScrollTo(start, end, duration) {
//         const startTime = performance.now();

//         function scrollStep(currentTime) {
//             const elapsedTime = currentTime - startTime;
//             const progress = Math.min(elapsedTime / duration, 1);
//             const easeInOutQuad = progress < 0.5
//                 ? 2 * progress * progress
//                 : 1 - Math.pow(-2 * progress + 2, 2) / 2;

//             window.scrollTo(0, start + (end - start) * easeInOutQuad);

//             if (progress < 1) {
//                 requestAnimationFrame(scrollStep);
//             }
//         }

//         requestAnimationFrame(scrollStep);
//     }
// });

// document.addEventListener("DOMContentLoaded", function () {
//     const filterLinks = document.querySelectorAll(".filter a");

//     filterLinks.forEach(link => {
//         link.addEventListener("click", function (event) {
//             event.preventDefault(); // Prevent default anchor behavior

//             const targetId = this.getAttribute("href").substring(1); // Remove #
//             const targetElement = document.getElementById(targetId);

//             if (targetElement) {
//                 window.scrollTo({
//                     top: targetElement.offsetTop - 50, // Adjust the offset if needed
//                     behavior: "smooth"
//                 });
//             }
//         });
//     });
// });



