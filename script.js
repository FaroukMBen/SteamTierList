let tierCount = 0;

function createTier(){

    let tierName = document.getElementById('newTierName').value;

    if(tierName == ""){
        tierName = "new tier";
    }

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

}