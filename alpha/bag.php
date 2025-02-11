<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bag | Pete's Lunch Box</title>
    <link rel="icon" type="image/gif" href="/images/logo.png" />
    <link rel="stylesheet" href="css/general.css">
    <link rel="stylesheet" href="css/bag.css">
    <link rel="stylesheet" href="css/item-counter.css">
    <link rel="stylesheet" href="css/button.css">
</head>
<body>

    <div class="screen-container">

        <nav>
            <a href="menu.php">
                <img class="back-button" src="../images/icons/back.svg" alt="back icon">
            </a>
        </nav>

        <div class="nav-background">
            <svg width="441" height="236" viewBox="0 0 441 236" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M267.5 106.213C386.199 159.628 430.696 106.81 441 73.4255V-7.62939e-05H0V37.7385V235.744C46.1608 240.349 69.0512 170.373 79 142C92.0514 104.778 148.801 52.7971 267.5 106.213Z" fill="#C73715"/>
                <path d="M441 73.4255C430.696 106.81 386.199 159.628 267.5 106.213C148.801 52.7971 92.0514 104.778 79 142C69.0512 170.373 46.1608 240.349 0 235.744V184.823C8.92505 178.973 16.1824 170.909 22.0501 162.197C34.3676 143.909 41.4385 121.424 44.2457 106.213C50.5946 88.1992 67.0412 65.0657 95.0802 52.7785C108.974 46.69 125.834 43.1987 146.187 44.3118C166.654 45.431 191.101 51.2348 219.905 64.2746C280.084 91.5175 325.004 92.3562 356.668 80.3123C387.567 68.5594 403.311 45.4162 408.627 28.0988L408.63 28.0885L417.454 -7.62939e-05H441V73.4255Z" fill="#C73715"/>
                <path d="M403.456 -7.62939e-05H0V37.7385V170.373C3.40987 166.883 6.58679 162.897 9.51556 158.549C21.1549 141.267 27.9964 119.598 30.6793 104.898L30.7226 104.661L30.8036 104.428C37.4803 85.273 55.2038 59.4224 87.4769 45.2799C103.798 38.1276 123.714 34.0397 147.323 35.3308C170.819 36.6157 197.521 43.1995 227.68 56.8522C285.428 82.9945 324.449 82.1558 349.803 72.5119C375.916 62.5794 390.269 42.354 395.193 26.3067L395.196 26.2965L403.456 -7.62939e-05Z" fill="#C73715"/>
                </svg>
        </div>

        <div class="content-container">

            <div class="content">

                <h1>Your Lunchbox</h1>
    
                <div class="food-card">
                    <img class="food-pic" src="../images/menu-item/egg-and-cheese.jpg">
                    <div class="food-details">
                        <div class="food-details-title">
                            <h3>Egg & Cheese</h3>
                            <div class="price">$6.00</div>
                        </div>
                        <div class="food-description">
                            <p>Bagel, Bacon, Ketchup</p>
                        </div>
                        <div class="actions">
                            <div class="edit-delete-button">
                                <img src="../images/icons/edit.svg" alt="edit icon">
                                <img src="../images/icons/trash-can.svg" alt="delete icon">
                            </div>
                            <div class="product-count">
                                <button class="button-count" disabled>-</button>
                                <input type="text" readonly class="number-product" value="1">
                                <button class="button-count">+</button>
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
                        <div class="pop-item">
                                <img src="../images/menu-item/thai-tea.jpg" alt="Thai Tea">
                                <div class="description">
                                    <p>Thai Tea</p>
                                    <p>$3.00</p>
                                </div>
                                <button class="add-button">+</button>
                        </div>
                    </div>
            
            
                    <div class="pop-items-container">
                        <div class="pop-item">
                            <img src="../images/menu-item/hashbrown.png " alt="Hashbrown">
                            <div class="description">
                                <p>Hashbrown</p>
                                <p>$1.50</p>
                            </div>
                            <button class="add-button">+</button>
                        </div>
                    </div>
            
                    <div class="pop-items-container">
                        <div class="pop-item">
                            <img src="../images/menu-item/muffin.jpg" alt="Muffin">
                            <div class="description">
                                <p>Muffin</p>
                                <p>$2.50</p>
                            </div>
                            <button class="add-button">+</button>
                        </div>
                    </div>
            
                    <div class="pop-items-container">
                        <div class="pop-item">
                            <img src="../images/menu-item/grilled-cheese.jpg" alt="Grilled Cheese">
                            <div class="description">
                                <p>Grilled Cheese</p>
                                <p>$3.50</p>
                            </div>
                            <button class="add-button">+</button>
                        </div>
                    </div>
    
                </div>
                
                <div class="subtotal">
                    <h2>Subtotal:</h2> 
                    <h2>$6.00</h2>
                </div>
        
                <button class="filled-button" onclick="gotoLogIn()">LOG IN TO CONTINUE</button>
    
    
        </div>  
    </div>

    <script src="js/button.js"></script>
    
    
</body>
</html>