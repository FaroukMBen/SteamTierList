<?php
session_start();

$steamID = null;
$_SESSION["gamesList"] = null;

$GLOBALS["steamAPIKey"] = "85BA65C1F05152740E42267DA183B684";


function getSteamGames($steamID, $includeFG,$includeAppInfo="true"){
    $apiBaseKey = "https://api.steampowered.com/IPlayerService/GetOwnedGames/v1/";

    

    $url = $apiBaseKey . "?key=" . $GLOBALS["steamAPIKey"] . "&steamid=" . $steamID . "&include_appinfo=" . $includeAppInfo . "&include_played_free_games" . $includeFG;
    
    $curl = curl_init($url);
    curl_setopt_array($curl,[
        CURLOPT_RETURNTRANSFER => True,
        CURLOPT_SSL_VERIFYPEER => False
    ]);
    
    $response = curl_exec($curl);

    $response = json_decode($response,true);

    $gamesList = [];

    if($response != ""){
        foreach($response["response"]["games"] as $game){
            $gamesList[] = [
                "id"=> $game["appid"], 
                "name" => $game["name"] ?? null,
                "hash" => $game['img_icon_url']
            ];
        }
    }else{
        $gamesList = null;
    }
    
    return $gamesList;

}

function gameImagePathByID($game, $imgType='header'){
    
    if($imgType == 'icon'){
        return 'http://media.steampowered.com/steamcommunity/public/images/apps/'. $game['id'] .'/'. $game['hash'] .'.jpg';
    }else{
        return 'https://cdn.cloudflare.steamstatic.com/steam/apps/'. $game['id'] .'/'. $imgType .'.jpg';
    }
}


//Getting the steam ID
if($_SERVER["REQUEST_METHOD"] == "POST"){
    if ($_POST["action"] = "formSteamID"){
        $steamID =$_POST["steamID"];
        if (isset($_POST['includeFreeGames'])) {
            $includeFreeGames = "true";
        } else {
            $includeFreeGames = "false";
        }

        $_SESSION["gamesList"] = getSteamGames($steamID,$includeFreeGames);
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
            <a href="index.php" id="currentPage">HOME</a>    
            <a href="tierlist.php">TIERLIST</a>
        </nav>

        <form method="POST" action="" id="formSteamID">
            <input type="text" name="steamID" placeholder="Enter your Steam ID ..." id="steamIDInput">
            
            <input type="checkbox" name="includeFreeGames" id="includeFreeGames">
            <label for="includeFreeGames">Include free games</label>

            <input type="submit" action="formSteamID" value="Get your games">
        </form>
        
        <section id="games">
            <h2>Your Games</h2>
            <div>
                <?php
                    if($_SESSION["gamesList"] != null){
                        foreach($_SESSION["gamesList"] as $game){
                            $path = gameImagePathByID($game);
                            echo '
                            <div class="game gameIndex"> 
                                <img src="'. $path .'" alt="img'. $game["name"] .'"> 
                                <p>'. $game["name"] .'</p>
                            </div>
                            ';
                        }
                    }else{
                        echo "<p> No games found </p>";
                    }
                ?>
            </div>
            <a href="tierlist.php" id="goTierList">Go to Tier List Maker</a>
        </section>

    </body>
</html>