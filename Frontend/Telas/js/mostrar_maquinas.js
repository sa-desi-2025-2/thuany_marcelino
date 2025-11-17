document.addEventListener('DOMContentLoaded', function() {
    // 1. ESTRUTURA DE DADOS COM URLS DAS MÁQUINAS
    const linhasMaquinas = {
        'Linha 1': [
            { nome: "Injetora de Gabinetes (seca)", url: "Maquinas/Linha1/gab.php" },
            { nome: "Shrink", url: "Maquinas/Linha1/shrink.php" },
            { nome: "Carrossel de Testes", url: "Maquinas/Linha1/carrossel_teste.php" }
        ],
        'Linha 2': [
            { nome: "Injetora de Gabinetes (seca)", url: "Maquinas/Linha2/gab.php" },
            { nome: "Injetora de Portas", url: "Maquinas/Linha2/portas.php" },
            { nome: "Shrink", url: "Maquinas/Linha2/shrink.php" },
            { nome: "Carrossel de Testes", url: "Maquinas/Linha2/carrossel_teste.php" }
        ],
        'Linha 3': [
            { nome: "Injetora de Gabinetes (seca)", url: "Maquinas/Linha3/gab.php" },
            { nome: "Carrossel de Testes", url: "Maquinas/Linha3/carrossel_teste.php" },
            { nome: "Carrossel de Vácuo", url: "Maquinas/Linha3/carrossel_vacuo.php" },
            { nome: "Shrink", url: "Maquinas/Linha3/shrink.php" }
        ],
        'Linha 6': [
            { nome: "Injetora de Gabinetes (seca)", url: "Maquinas/Linha6/gab.php" },
            { nome: "Carrossel de Vácuo", url: "Maquinas/Linha6/carrossel_vacuo.php" },
            { nome: "Carrossel de Testes", url: "Maquinas/Linha6/carrossel_teste.php" }
        ],
        'Linha 8': [
            { nome: "Mini charge", url: "Maquinas/Linha8/mini_charge.php" },
            { nome: "Skin condenser", url: "Maquinas/Linha8/skin_condenser.php" },
            { nome: "Carrossel de Testes", url: "Maquinas/Linha8/carrossel_teste.php" },
            { nome: "Injetora de Gabinetes (seca)", url: "Maquinas/Linha8/gab.php" }
        ],
        'Linha 9': [
            { nome: "Injetora de Gabinetes (seca)", url: "Maquinas/Linha9/gab.php" },
            { nome: "Shrink MSK", url: "Maquinas/Linha9/shrink_msk.php" },
            { nome: "Shrink CPT", url: "Maquinas/Linha9/shrink_cpt.php" },
            { nome: "Carrossel de Testes", url: "Maquinas/Linha9/carrossel_teste.php" },
            { nome: "Carrossel de Vácuo", url: "Maquinas/Linha9/carrossel_vacuo.php" }
        ]
    };

    const containerMaquinas = document.getElementById('maquinas-container');
    const itensMenu = document.querySelectorAll('.dropdown-menu .dropdown-item'); 

    /**
     * Função para exibir os botões das máquinas e configurar a navegação
     * @param {string} linha 
     */
    function exibirMaquinas(linha) {
        // Limpa o conteúdo atual do contêiner
        containerMaquinas.innerHTML = '';

        const maquinas = linhasMaquinas[linha];

        if (maquinas && maquinas.length > 0) {
            const btnGroup = document.createElement('div');
            btnGroup.className = 'd-flex flex-wrap justify-content-center'; 

            // ITERA SOBRE O NOVO FORMATO DE DADOS { nome: "...", url: "..." }
            maquinas.forEach(maquinaObj => {
                const button = document.createElement('button');
                button.setAttribute('type', 'button');
                // Mantendo o estilo Bootstrap e customizado
                button.className = 'btn btn-secondary m-2'; 
                button.style.backgroundColor = '#D1D3D4'; 
                button.style.border = 'none';
                button.style.borderRadius = '5px';
                button.style.padding = '15px';
                button.style.color = '#333'; 
                button.style.whiteSpace = 'nowrap';  

                button.textContent = maquinaObj.nome;

                // *** LÓGICA DE REDIRECIONAMENTO AQUI ***
                button.addEventListener('click', () => {
                    // Redireciona o navegador para a URL definida no objeto da máquina
                    window.location.href = maquinaObj.url;
                });

                btnGroup.appendChild(button);
            });
            containerMaquinas.appendChild(btnGroup);
        } else {
            // Mensagem se não houver máquinas
            containerMaquinas.innerHTML = `<p class="text-secondary" style="font-size: 1.2rem;">Nenhuma máquina cadastrada para a **${linha}**.</p>`;
        }
    }

    // 2. Adiciona o evento de clique a cada item do menu
    itensMenu.forEach(link => { 
        const nomeLinha = link.textContent.trim(); 

        link.addEventListener('click', (event) => {
            // Previne o comportamento padrão (se for um link)
            event.preventDefault(); 
            // Exibe as máquinas da linha selecionada
            exibirMaquinas(nomeLinha);
        });
    });

    // *** EXTRA: EXIBIR MÁQUINAS DA LINHA 1 AO CARREGAR A PÁGINA (OPCIONAL) ***
    // Se você quiser que a Linha 1 seja carregada por padrão na primeira vez:
    // exibirMaquinas('Linha 1'); 
});