<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bag | Pete's Lunch Box</title>
    <link rel="icon" type="image/gif" href="/images/logo.png" />
    <link rel="stylesheet" href="css/general.css">
    <link rel="stylesheet" href="css/bag.css">
    <!-- <link rel="stylesheet" href="css/item-counter.css"> -->
    <link rel="stylesheet" href="css/button.css">
    <link rel="stylesheet" href="css/foodcard.css">
</head>
<body>

    <div class="screen-container">

        <nav>
            <a href="menu.php">
                <img class="back-button" src="../images/icons/back.svg" alt="back icon">
            </a>
        </nav>

        <div class="nav-background">
            <svg xmlns="http://www.w3.org/2000/svg" width="441" height="236" viewBox="0 0 441 236" fill="none">
            <path d="M179.285 106.81C60.5861 160.226 10.3038 120.939 0 87.5539V0.000106812H441V37.7386V235.744C394.839 240.349 377.786 183 366.813 151.707C353.762 114.485 297.984 53.3949 179.285 106.81Z" fill="#C73715"/>
            <path d="M0 87.5539C10.3038 120.939 60.5861 160.226 179.285 106.81C297.984 53.3949 353.762 114.485 366.813 151.707C377.786 183 394.839 240.349 441 235.744V184.823C432.075 178.973 424.818 170.909 418.95 162.197C406.632 143.909 399.561 121.424 396.754 106.213C390.405 88.1994 373.959 65.0659 345.92 52.7787C332.026 46.6902 315.166 43.1989 294.813 44.3119C274.346 45.4312 249.899 51.235 221.095 64.2748C160.916 91.5177 115.996 92.3564 84.3317 80.3125C53.4325 68.5596 37.6894 45.4163 32.3729 28.099L32.3698 28.0887L23.5462 0.000106812H0V87.5539Z" fill="#C73715"/>
            <path d="M37.5437 0.000106812H441V37.7386V170.373C437.59 166.883 434.413 162.897 431.484 158.549C419.845 141.267 413.004 119.598 410.321 104.898L410.277 104.661L410.196 104.428C403.52 85.2732 385.796 59.4226 353.523 45.2801C337.202 38.1278 317.286 34.0399 293.677 35.331C270.181 36.6159 243.479 43.1997 213.32 56.8524C155.572 82.9947 116.551 82.156 91.1968 72.5121C65.0836 62.5796 50.7308 42.3542 45.8075 26.3069L45.8043 26.2967L37.5437 0.000106812Z" fill="#C73715"/>
</svg>
        </div>

        <div class="content-container">

            <div class="content">

                <h1>Your Lunchbox</h1>
    
                <div class="food-card">

                    <img class="food-pic" src="../images/menu-item/egg-and-cheese.jpg">

                    <div class="food-details">
                        
                        <div class="food-description">
                            <div class="food-details-title">
                                <h3>Egg &amp; Cheese</h3>
                                <p class="price">$7.00</p>
                            </div>
                            
                            <p>Bagel, Bacon, Salt + Pepper...</p>
                            <p><strong>Notes</strong>: no cheese</p>
                        </div>

                        <div class="actions">

                            <div class="button-container">
                                <a href="detail.html" class="edit-button">
                                    
                                    <img src="../images/icons/edit.svg" alt="edit icon">
                                </a>

                                <a href="#" class="delete-button">

                                    <img src="../images/icons/trash-can.svg" alt="delete icon">
                                </a>
                            </div>

                            <div class="product-count">
                                <button class="button-count" disabled>
                                    <img src="../images/icons/minus-black.svg" alt="minus button">
                                </button>
                                <input type="text" readonly class="number-product" value="1">
                                <button class="button-count">
                                    <img src="../images/icons/plus-black.svg" alt="plus icon">
                                </button>
                            </div>

                        </div>

                    </div>

                </div>
    
                
                
            </div>
            
        </div> 
        
        <div class="total-container">
                <h4>Popular items to add to your order:</h4>

                <div class="popular-items">
            
            
                    <div class="pop-items-container">
                        
                                <img src="../images/menu-item/thai-tea.jpg" alt="Thai Tea">

                                <div class="description">
                                    <div>

                                        <p>Thai Tea</p>
                                        <p>$3.00</p>
                                    </div>

                                    <button class="add-button">
                                        <img src="../images/icons/add-icon-border.svg" alt="add button">
                                    </button>
                                </div>
                                
                        
                    </div>

                    <div class="pop-items-container">
                        
                                <img src="../images/menu-item/hashbrown.png " alt="Hashbrown">

                                <div class="description">
                                    <div>

                                        <p>Hashbrown</p>
                                        <p>$1.50</p>
                                    </div>

                                    <button class="add-button">
                                        <img src="../images/icons/add-icon-border.svg" alt="add button">
                                    </button>
                                </div>
                                
                        
                    </div>

                    <div class="pop-items-container">
                        
                                <img src="../images/menu-item/muffin.jpg " alt="Muffin">

                                <div class="description">
                                    <div>

                                        <p>Muffin</p>
                                        <p>$2.50</p>
                                    </div>

                                    <button class="add-button">
                                        <img src="../images/icons/add-icon-border.svg" alt="add button">
                                    </button>
                                </div>
                                
                        
                    </div>
            
            
                    
            
                    <div class="pop-items-container">
                        
                        <img src="../images/menu-item/grilled-cheese.jpg" alt="Grilled Cheese">

                        <div class="description">
                            <div>

                                <p>Grilled Cheese</p>
                                <p>$3.50</p>
                            </div>

                            <button class="add-button">
                                <img src="../images/icons/add-icon-border.svg" alt="add button">
                            </button>
                        </div>
                        
                
                    </div>
            
                    
    
                </div>
                
                <div class="subtotal">
                    <h2>Subtotal:</h2> 
                    <h2>$6.00</h2>
                </div>
        
                <button class="filled-button" onclick="gotoPayment()">PROCEED TO CHECK OUT</button>
    
    
        </div>  
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            let decrementBtns = document.querySelectorAll(".button-count:first-of-type");
            let incrementBtns = document.querySelectorAll(".button-count:last-of-type");
            let quantityInputs = document.querySelectorAll(".number-product");

            function updateButtons(input, decrementBtn) {
                decrementBtn.disabled = parseInt(input.value) <= 1;
            }

            incrementBtns.forEach((btn, index) => {
                btn.addEventListener("click", function (event) {
                    event.preventDefault();
                    quantityInputs[index].value = parseInt(quantityInputs[index].value) + 1;
                    updateButtons(quantityInputs[index], decrementBtns[index]);
                });
            });

            decrementBtns.forEach((btn, index) => {
                btn.addEventListener("click", function (event) {
                    event.preventDefault();
                    if (parseInt(quantityInputs[index].value) > 1) {
                        quantityInputs[index].value = parseInt(quantityInputs[index].value) - 1;
                    }
                    updateButtons(quantityInputs[index], decrementBtns[index]);
                });
            });

            // Initialize button states
            quantityInputs.forEach((input, index) => updateButtons(input, decrementBtns[index]));
        });
    </script>  
    <script src="js/button.js"></script>
    
</body>
</html>