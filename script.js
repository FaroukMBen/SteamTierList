let tierCount = 0;

function createTier(){

    const consoleE = document.getElementById('console');
    let tierName = document.getElementById('newTierName').value || "New tier";

    document.getElementById('newTierName').value = "";

    const tier = document.createElement('div');
    tier.classList.add('Tier');
    tier.id = 'tier' + tierCount;

    const tierTitle = document.createElement('p');
    tierTitle.classList.add('tierTitle');
    tierTitle.textContent = tierName;

    const tierGamesContainer = document.createElement('div');
    tierGamesContainer.classList.add('tierGamesContainer');

    tier.appendChild(tierTitle);
    tier.appendChild(tierGamesContainer);

    document.getElementById('tierContainer').appendChild(tier);

    tierCount++;

    const action = document.createElement('p');
    action.textContent = "Tier created with id : " + tier.id + " and name : " + tierName;

    consoleE.appendChild(action);

}

function displayConsole(){
    
    const consoleE = document.getElementById('console');
    const displayButton = document.getElementById('displayConsoleButton');


    if(window.getComputedStyle(consoleE).display != "none"){ // To get the style of the section from the css file because style.display only retrieves what's directly set in the HTML
        consoleE.style.display = "none";
        displayButton.textContent = "Show console";
    }
    else{
        consoleE.style.display = "block";
        displayButton.textContent = "Hide console";
    }

    const action = document.createElement('p');
    action.textContent = "Display of the console is set to " + consoleE.style.display;

    consoleE.appendChild(action);
}