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
            <nav>
                <a href="index.php">HOME</a>
                <a href="tierlist.php" id="currentPage">TIERLIST</a>
            </nav>

            <section id="consoleContainer">
                <div id="console">
                </div>
                <button onclick=displayConsole() id="displayConsoleButton">Show console</button>
            </section>

            <section id="tierlist">
                <button onclick=createTier()>Create a new tier</button>
                <input type="text" id="tierNameInput">
                
                <div id="tierContainer">

                </div>
            </section>
                        
            
            
            <section id="games">
                <h2>Your Games</h2>
                <div>
                    <?php
                        // Must delete the div
                        if($_SESSION["gamesList"] != null){
                            foreach($_SESSION["gamesList"] as $game){
                                $path = gameImagePathByID($game);
                                echo '
                                <div class="game gameTierList">
                                    <img src="'. $path .'" alt="img'. $game["name"] .'">
                                </div>
                                ';
                            }
                        }else{
                            echo "<p> No games found </p>";
                        }
                    ?>
                </div>
        </section>

            <script src="script.js"></script>
        </body>
    </html>