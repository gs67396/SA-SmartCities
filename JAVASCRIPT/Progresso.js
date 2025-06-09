const energyBar = document.getElementById('energyBar');
let currentEnergy = 0;
let isCharging = true;

function updateEnergyBar() {
    if (isCharging) {
        currentEnergy += 2; // Aumenta a energia
    } else {
        currentEnergy -= 2; // Diminui a energia
    }

    if (currentEnergy > 100) {
        currentEnergy = 100; // Limite superior
        isCharging = false;
    } else if (currentEnergy < 0) {
        currentEnergy = 0; // Limite inferior
        isCharging = true;
    }

    energyBar.style.width = currentEnergy + '%';
}

setInterval(updateEnergyBar, 1000); // Atualiza a barra a cada segundo
