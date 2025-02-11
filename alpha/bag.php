<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bag | Pete's Lunch Box</title>
    <link rel="icon" type="image/gif" href="/images/logo.png" />
    <link rel="stylesheet" href="css/bag.css">
    <link rel="stylesheet" href="css/general.css">
    <link rel="stylesheet" href="../css/item-counter.css">
</head>
<body>

    <div class="screen-container">

        <nav>
            <a href="menu.php">
                <img class="back-button" src="../images/icons/back.svg" alt="back icon">
            </a>
        </nav>

        <div class="content">

            <h1>Your Lunchbox</h1>

            <div class="food-card">
                <img class="food-pic" src="/images/menu-item/egg-and-cheese.jpg">
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

        </div> 

        <div class="subtotal">
            <h2>Subtotal:</h2> 
            <h2>$6.00</h2>
        </div>
        <button class="proceed-button">LOG IN TO CONTINUE</button>

    </div>  
    
</body>
</html>