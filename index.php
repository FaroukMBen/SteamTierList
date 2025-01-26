<?php

$steamID = null;
$GLOBALS["gamesList"] = null;

$GLOBALS["steamAPIKey"] = "api_key";


function getSteamGames($steamID,$freeGamesIncluded=False){
    $apiBaseKey = "https://api.steampowered.com/IPlayerService/GetOwnedGames/v1/";
    $url = $apiBaseKey . "?key=" . $GLOBALS["steamAPIKey"] . "&steamid=" . $steamID . "&include_appinfo=true";
    
    $curl = curl_init($url);
    curl_setopt_array($curl,[
        CURLOPT_RETURNTRANSFER => True,
        CURLOPT_SSL_VERIFYPEER => False
    ]);
    
    $response = curl_exec($curl);

    $response = json_decode($response,true);

    foreach($response["response"]["games"] as $game){
        $gamesList[] = [
            "id"=> $game["appid"], 
            "name" => $game["name"] ?? null,
            "hash" => $game['img_icon_url']
        ];

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
        $GLOBALS["gamesList"] = getSteamGames($steamID,True);
    }
}



?>

<html>
    <head>
        <title>Steam Tier Listing</title>
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
        <form method="POST" action="">
            <label for="inputSteamID">Recuperez vos jeux Steam</label>
            <input type="text" name="steamID" placeholder="Enter your Steam ID ...">
            <input type="submit" action="formSteamID">
        </form>
        <section>
            <h2>Your Games</h2>
            <?php
                foreach($GLOBALS["gamesList"] as $game){
                    $path = gameImagePathByID($game);
                    echo '
                    <div class="game">
                        <p>'. $game["name"] .'</p>
                        <img src="'. $path .'" alt="img'. $game["name"] .'"> 
                    </div>
                    ';
                }
            ?>
        </section>
    </body>
</html>