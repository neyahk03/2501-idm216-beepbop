<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Egg &amp; Cheese Sandwich</title>
    <link rel="icon" type="image/gif" href="../images/logo.png" />
    <link rel="stylesheet" href="css/general.css">
    <link rel="stylesheet" href="css/detail.css">
    <link rel="stylesheet" href="css/button.css">
    <link rel="stylesheet" href="css/item-counter.css">
    <link rel="stylesheet" href="css/heart-button.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>    
</head>

<body>

    <div class="screen-container">

        <nav>
            <a href="menu.php">
                <img class="cancel-button" src="../images/icons/cancel.svg" alt="cancel icon">
            </a>
        </nav>

        <div class="content">
            <img src="../images/menu-item/egg-and-cheese.jpg" alt="egg and cheese" class="hero-image">

            <div class="description-container">
                <div class="description">
                    <h2>Egg &amp; Cheese</h2>
                    <h2>$4.50</h2>
                </div>
            </div>

            <div class="option-container">

                <form action="#" method="post">

                    <div class="option">

                        <div class="option-title">
                            <h2>Bread<img src="../images/icons/bread.svg" alt="info icon" class="icon"></h2>
                        </div>
                        <div class ="line">
                            <hr style="border: 2px solid var(--bg-yellow); width: 100%; margin: 0;">
                        </div>
                        <div class="bread-options">
                            <div class="bread-option">
                                <input type="radio" id="white" name="bread" value="white">
                                <label for="white" class="bread">
                                    White Bread
                                    
                                </label>
                            </div>

                            <div class="bread-option">
                                <input type="radio" id="wheat" name="bread" value="wheat">
                                <label for="wheat" class="bread">
                                    Wheat Bread
                                    
                                </label>
                            </div>


                            <div class="bread-option">
                                <input type="radio" id="croissant" name="bread" value="croissant">
                                <label for="croissant" class="bread">
                                    Croissant
                                    
                                </label>
                            </div>

                            <div class="bread-option">
                                <input type="radio" id="wrap" name="bread" value="wrap">
                                <label for="wrap" class="bread">
                                    Wrap
                                    
                                </label>
                            </div>

                            <div class="bread-option">
                                <input type="radio" id="pita" name="bread" value="pita">
                                <label for="pita" class="bread">
                                    Pita
                                    
                                </label>
                            </div>
                            
                            <div class="bread-option">
                                <input type="radio" id="hoagie" name="bread" value="hoagie">
                                <label for="hoagie" class="bread">
                                    hoagie
                                    
                                </label>
                            </div>
                        </div>
                        
                    </div>

                    <div class="option">
                        <div class="option-title">
                            <h2>Protein<img src="../images/icons/meat.svg" alt="info icon" class="icon"></h2>
                        </div>
                        <div class="line">
                            <hr style="border: 2px solid var(--bg-yellow); width: 100%; margin: 0;">
                        </div>

                        <div class="bread-options">
                            <div class="protein-option">
                                <input type="checkbox" id="bacon" name="protein" value="bacon">
                                <label for="bacon" class="protein">
                                    <p>Bacon</p>
                                    <p>+$1.50</p>
                                </label>
                            </div>

                            <div class="protein-option">
                                <input type="checkbox" id="turkey-bacon" name="protein" value="turkey-bacon">
                                <label for="turkey-bacon" class="protein">
                                    <p>Turkey Bacon</p>
                                    <p>+$1.50</p>
                                </label>
                            </div>

                            <div class="protein-option">
                                <input type="checkbox" id="ham" name="protein" value="ham">
                                <label for="ham" class="protein">
                                    <p>Ham</p>
                                    <p>+$1.50</p>
                                </label>
                            </div>
    
                            <div class="protein-option">
                                <input type="checkbox" id="sausage" name="protein" value="sausage">
                                <label for="sausage" class="protein">
                                    <p>Sausage</p>
                                    <p>+$1.50</p>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="option">
                        <div class="option-title">
                            <h2>Condiments<img src="../images/icons/salt.svg" alt="info icon" class="icon"></h2>
                        </div>
                        <div class="line">
                            <hr style="border: 2px solid var(--bg-yellow); width: 100%; margin: 0;">
                        </div>

                        <div class="condiment-options">
                            <div class="condiment-option">
                                <input type="checkbox" id="mayo" name="bread" value="mayo">
                                <label for="mayo" class="bread">
                                mayo
                                </label>
                            </div>

                            <div class="condiment-option">
                                <input type="checkbox" id="ketchup" name="bread" value="ketchup">
                                <label for="ketchup" class="bread">
                                    ketchup
                                </label>
                            </div>

                            <div class="condiment-option">
                                <input type="checkbox" id="salt" name="bread" value="salt">
                                <label for="salt" class="bread">
                                    salt
                                </label>
                            </div>

                            <div class="condiment-option">
                                <input type="checkbox" id="pepper" name="bread" value="pepper">
                                <label for="pepper" class="bread">
                                    pepper
                                </label>
                            </div>
                        </div>
                    </div>

                    <textarea class="note" id="note" name="note" placeholder="Add a note"></textarea>

                    <div class="fav-container">
                        <div class="product-count">
                            <button class="button-count decrement" disabled>-</button>
                            <input type="text" name="quantity" readonly class="number-product" value="1">
                            <button class="button-count increment">+</button>
                        </div>

                        <div class="heart-btn">
                            <img src="../images/icons/heart-empty.svg" alt="heart btn">
                        </div>

                        <!-- <div class="heart">
                            <div class='large-font text-center top-20'>
                                <ion-icon name="heart">
                                <div class='red-bg'></div>
                                </ion-icon>
                            </div>
                        </div> -->
                    </div>

                    <div class="subtotal">
                        <h2>Subtotal:</h2>
                        <h2>$4.50</h2>
                    </div>


                
                    <!-- <button class="add-to-bag" type="submit">
                        <h4>ADD TO BAG</h4>
                    </button> -->

                    
                    
                </form>
                
                
                
                <button class="filled-button" type="button" onclick="window.location.href='added-to-bag-animation.html'">
                    <h4>ADD TO BAG</h4>
                </button>
            </div>

            
            
        </div>


    </div>

    <script src="js/button.js"></script>
</body>
</html>