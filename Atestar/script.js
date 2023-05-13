let counter = 0;
let intervalId;

function startCounter() {
    intervalId = setInterval(incrementCounter, 1000); // Incrementa o contador a cada segundo (1000ms)
}

function stopCounter() {
    clearInterval(intervalId); // Para o contador
}

function incrementCounter() {
    counter++;
    document.getElementById('counter').textContent = counter; // Atualiza o valor do contador na página
}
