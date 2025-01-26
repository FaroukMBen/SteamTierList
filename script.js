let tierCount = 0;
let tierCreatedCounter = 0;

/**
 * Creates a new tier and appends it to the 'tierContainer' element.
 * Each tier consists of:
 * - A title (with a user-defined name or default value)
 * - A rank number (incremented with each new tier)
 * - A games container (for tier-specific games)
 * - A delete button to remove the tier
 * 
 * The function also clears the input field, logs the tier creation in the console, 
 * and increments the tier count and tier created counter.
 */
function createTier() {
    const consoleE = document.getElementById('console');
    
    let tierName = document.getElementById('newTierName').value.trim() || "New tier";

    document.getElementById('newTierName').value = "";

    const tier = document.createElement('div');
    tier.classList.add('Tier');
    tier.id = 'tier' + tierCreatedCounter;  // Unique ID based on a counter

    const tierTitle = document.createElement('p');
    tierTitle.classList.add('tierTitle');
    tierTitle.textContent = tierName;

    const tierRank = document.createElement('p');
    tierRank.textContent = tierCount;

    const tierGamesContainer = document.createElement('div');
    tierGamesContainer.classList.add('tierGamesContainer');

    const tierDeleteButton = document.createElement('button');
    tierDeleteButton.onclick = function() {
        deleteTier(tier.id);
    };
    tierDeleteButton.textContent = "Delete tier";

    tier.appendChild(tierRank); 
    tier.appendChild(tierTitle);  
    tier.appendChild(tierGamesContainer);  
    tier.appendChild(tierDeleteButton);  

    const tierContainer = document.getElementById('tierContainer');
    tierContainer.appendChild(tier);

    tierCount++;
    tierCreatedCounter++;

    const action = document.createElement('p');
    action.textContent = `Tier created with id: ${tier.id} and name: ${tierName}`;
    consoleE.appendChild(action);
}


/**
 * Deletes a tier element from the page based on its ID.
 * Logs the deletion action to the console section.
 *
 * @param {string} tierID - The ID of the tier to be deleted.
 */
function deleteTier(tierID) {
    const consoleE = document.getElementById('console');

    const tier = document.getElementById(tierID);

    const tierTitle = document.querySelector(`#${tierID} .tierTitle`);

    const tierContainer = document.getElementById('tierContainer');

    tierContainer.removeChild(tier);

    const action = document.createElement('p');
    action.textContent = `Tier deleted with id: ${tier.id} and name: ${tierTitle.textContent}`;
    consoleE.appendChild(action);
}


/**
 * Toggles the visibility of the console section and updates the display button text.
 * Logs the console visibility state to the console section.
 */
function displayConsole() {
    const consoleE = document.getElementById('console');

    const displayButton = document.getElementById('displayConsoleButton');

    if (window.getComputedStyle(consoleE).display != "none") {  // To get the style of the section from the css file because style.display only retrieves what's directly set in the HTML
        consoleE.style.display = "none";
        displayButton.textContent = "Show console";
    } else {
        consoleE.style.display = "block";
        displayButton.textContent = "Hide console";
    }

    const action = document.createElement('p');
    action.textContent = "Display of the console is set to " + consoleE.style.display;
    consoleE.appendChild(action);
}

window.addEventListener('beforeunload', function(event) {
    event.preventDefault();
});

window.addEventListener('load', function(event) {
    this.alert("BEWARE: If you refresh or quit the page you will lose your tierList progression");
});