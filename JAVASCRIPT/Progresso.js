  const progresso = document.querySelector('.progresso');

    // Função para simular a carga de energia
    function carregar(intervalo) {
        let largura = 0;
        const intervalo = setInterval(frame, 20); // Velocidade da animação

        function frame() {
            if (largura >= 100) {
                clearInterval(intervalo);
            } else {
                largura++;
                progresso.style.width = largura + '%';
            }
        }
    }

    // Iniciar a animação
    carregar();