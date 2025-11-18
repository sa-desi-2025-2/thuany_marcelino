// As variáveis `todasEwos` e `MAQUINA_ID` são definidas no <script> do HTML

const STORAGE_KEY = `ewos_visualizadas_${MAQUINA_ID}`;

function getVisualizadas() {
    const jsonString = localStorage.getItem(STORAGE_KEY);
    const array = jsonString ? JSON.parse(jsonString) : [];
    return new Set(array);
}

function setVisualizadas(ewosSet) {
    const array = Array.from(ewosSet);
    localStorage.setItem(STORAGE_KEY, JSON.stringify(array));
}


function renderizarTabelas() {
    const visualizadas = getVisualizadas();
    const tabelaExistenteBody = document.querySelector('#tabela-existente tbody');
    const tabelaNovaBody = document.querySelector('#tabela-nova tbody');
    const btnFeito = document.getElementById('btn-feito');

    tabelaExistenteBody.innerHTML = '';
    tabelaNovaBody.innerHTML = '';

    let temEwoNova = false; 

    todasEwos.forEach(ewo => {
        const tr = document.createElement('tr');
        const tdNumero = document.createElement('td');
        
        
        let linkHtml = '';
        if (ewo.link_documento) {
             linkHtml = `<a href="${ewo.link_documento}" target="_blank"><i class="bi bi-file-earmark-text-fill doc-icon"></i></a>`;
        } else {
             linkHtml = `<i class="bi bi-file-earmark-text doc-icon"></i>`;
        }
        
        tdNumero.innerHTML = `${linkHtml} ${ewo.numero_ewo}`;
        tr.appendChild(tdNumero);


        
        if (!visualizadas.has(ewo.numero_ewo)) {
            
            tdNumero.classList.add('ewo-nova');
            tabelaNovaBody.appendChild(tr);
            temEwoNova = true; 
        } else {
            
            tabelaExistenteBody.appendChild(tr);
        }
    });

    
    btnFeito.style.display = temEwoNova ? 'block' : 'none';
}


function handleFeitoClick() {
    const visualizadas = getVisualizadas();
    let ewosMarcadas = 0;
    
    
    todasEwos.forEach(ewo => {
        if (!visualizadas.has(ewo.numero_ewo)) {
            visualizadas.add(ewo.numero_ewo);
            ewosMarcadas++;
        }
    });

    if (ewosMarcadas > 0) {
        setVisualizadas(visualizadas);
        renderizarTabelas(); 
    }
}


document.addEventListener('DOMContentLoaded', () => {
    
    renderizarTabelas();
    
    document.getElementById('btn-feito').addEventListener('click', handleFeitoClick);
});