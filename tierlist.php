    <?php
        session_start();

        function gameImagePathByID($game, $imgType='header'){
        
            if($imgType == 'icon'){
                return 'http://media.steampowered.com/steamcommunity/public/images/apps/'. $game['id'] .'/'. $game['hash'] .'.jpg';
            }else{
                return 'https://cdn.cloudflare.steamstatic.com/steam/apps/'. $game['id'] .'/'. $imgType .'.jpg';
            }
        }
    ?>
    <html>
        <head>
            <title>Steam Tier Listing</title>
            <link rel="stylesheet" href="styles.css">
        </head>
        <body>
            <section id="console">
                <h2>Console</h2>
            </section>

            <button onclick=displayConsole() id="displayConsoleButton">Show console</button>
            
            <input type="text" id="newTierName">
            <button onclick=createTier()>Create a new tier</button>
            
            <section id="tierContainer">

            </section>
            
            <section>
                <h2>Your Games</h2>
                <a href="tierlist.php">Go to Tier List Maker</a>
                <div>
                    <?php
                        foreach($_SESSION["gamesList"] as $game){
                            $path = gameImagePathByID($game, 'icon');
                            echo '
                            <div class="gameIcon">
                                <img src="'. $path .'" alt="img'. $game["name"] .'" height="50px" width="50px"> 
                            </div>
                            ';
                        }
                    ?>
                </div>
            </section>

            <script src="script.js"></script>
        </body>
    </html>