document.addEventListener('DOMContentLoaded', () => {
    const tabela = document.querySelector('table');
    const botaoNovoUsuario = document.getElementById('btn-novo-usuario');

    // adiciona um identificador de cliques em toda a tabela, nos botões
    tabela.addEventListener('click', (evento) => {
        const elementoClicado = evento.target;
        const linha = elementoClicado.closest('tr');
        if (!linha) return;

        if (elementoClicado.classList.contains('btn-editar')) {
            iniciarEdicao(linha, elementoClicado);
        } else if (elementoClicado.classList.contains('btn-salvar')) {
            salvarAlteracoes(linha, elementoClicado);
        } else if (elementoClicado.classList.contains('btn-novo-usuario')) {
            salvarNovoUsuario(linha, elementoClicado);
        } else if (elementoClicado.value === 'DESABILITAR' || elementoClicado.value === 'HABILITAR') {
            alternarStatus(linha, elementoClicado);
        }
    });
    if (botaoNovoUsuario) {
        botaoNovoUsuario.addEventListener('click', () => {
            adicionarNovaLinha(tabela);
        });
    }
});

function iniciarEdicao(linha, botaoEditar) {
    // pega a linha e o botão que quero mexer
    const campos = linha.querySelectorAll('.campo-edicao');
    const botaoSalvar = linha.querySelector('.btn-salvar');

    campos.forEach(campo => {
        campo.removeAttribute('disabled');
    });

    botaoEditar.style.display = 'none';
    botaoSalvar.style.display = 'inline-block';
}

function salvarAlteracoes(linha, botaoSalvar) {
    const campos = linha.querySelectorAll('.campo-edicao');
    const botaoEditar = linha.querySelector('.btn-editar');
    const idUsuario = linha.getAttribute('data-id');

    // simular um formuláio sem precisar de um
    const dadosParaSalvar = new URLSearchParams();
    dadosParaSalvar.append('id', idUsuario);

    campos.forEach(campo => {

        dadosParaSalvar.append(campo.name, campo.value);
    });

    const url_update = '../../Backend/Main/main_update.php';

    // envia a requisição
    fetch(url_update, {
        method: 'POST',
        body: dadosParaSalvar,
        credentials: 'same-origin' // mantém cookies se houver autenticação de sessão
    })
        .then(response => {
            // Lê a resposta do servidor e tenta transformá-la em JSON. (texto legível para representar os dados)
            return response.json().then(json => ({ ok: response.ok, status: response.status, json }));
        })
        .then(({ ok, status, json }) => {
            console.log('Resposta HTTP:', status, json);
            if (!ok) {
                alert('Erro do servidor: ' + (json.message || 'Resposta com status ' + status));
                return;
            }
            // exibe mensagem de sucesso e chama finalizarEdicao() pra travar de novo os campos.
            if (json.success) {
                alert(json.message || 'Usuário atualizado com sucesso!');
                finalizarEdicao(linha, botaoSalvar, botaoEditar);
            } else {
                // dá erro e mostra o motivo
                alert('Falha ao atualizar: ' + (json.message || 'Sem detalhe'));
                console.error('Detalhes do backend:', json);
            }
        })
        // Captura qualquer erro de rede e mostra alerta.
        .catch(error => {
            console.error('Erro ao chamar main_update.php:', error);
            alert('Erro na comunicação com o servidor. Veja o console.');
        });
}
// Desativa   os campos de edição, esconde o salvar e mostra o editar de novo
function finalizarEdicao(linha, botaoSalvar, botaoEditar) {
    const campos = linha.querySelectorAll('.campo-edicao');

    campos.forEach(campo => {
        campo.setAttribute('disabled', 'disabled');
    });

    botaoSalvar.style.display = 'none';
    botaoEditar.style.display = 'inline-block';
}

function alternarStatus(linha, botaoStatus) {
    const idUsuario = linha.getAttribute('data-id');
    // determina os status
    const statusAtual = botaoStatus.value === 'DESABILITAR' ? 'ATIVO' : 'INATIVO';
    const novoStatus = statusAtual === 'ATIVO' ? 'INATIVO' : 'ATIVO';

    // cria objeto para montar os dados no formato formulário
    const dados = new URLSearchParams();
    dados.append('id', idUsuario);
    dados.append('novo_status', novoStatus);

    const url_status = '../../Backend/Main/main_status.php';

    // faz a requisição - manda a mensagem
    fetch(url_status, {
        method: 'POST',
        body: dados,
        credentials: 'same-origin'
    })
        // Transforma resposta em JSON
        .then(response => response.json())
        .then(json => {
            if (json.success) {
                alert(json.message || `Usuário agora está ${novoStatus}.`);

                // Atualiza o texto da célula e o botão na tabela sem recarregar
                const celulaStatus = linha.children[4];
                celulaStatus.textContent = novoStatus;

                // Atualiza a cor do texto conforme o novo status
                celulaStatus.classList.remove('text-success', 'text-danger');
                celulaStatus.classList.add(novoStatus === 'ATIVO' ? 'text-success' : 'text-danger');
                
                // Atualiza texto e cor do botão
                if (novoStatus === 'ATIVO') {
                    botaoStatus.value = 'DESABILITAR';
                    botaoStatus.classList.remove('btn-success');
                    botaoStatus.classList.add('btn-danger');
                } else {
                    botaoStatus.value = 'HABILITAR'
                    botaoStatus.classList.remove('btn-danger');
                    botaoStatus.classList.add('btn-success');
                }
                
                botaoStatus.value = novoStatus === 'ATIVO' ? 'DESABILITAR' : 'HABILITAR';
            } else {
                alert('Falha ao atualizar status: ' + (json.message || 'Sem detalhe'));
            }
        })
        // trata erros de conexao
        .catch(err => {
            console.error('Erro ao alterar status:', err);
            alert('Erro ao comunicar com o servidor.');
        });
}

function adicionarNovaLinha(tabela) {
    const tbody = tabela.querySelector('tbody');
    const novaLinha = document.createElement('tr');
    novaLinha.setAttribute('data-id', 'novo_' + Date.now());

    novaLinha.innerHTML = `
                <td><input type="text" name="nome" class="campo-edicao"></td>
                <td><input type="text" name="nome_usuario" class="campo-edicao"></td>
                <td><input type="email" name="email" class="campo-edicao"></td>
                <td>
                    <select name="tipo_acesso" class="campo-edicao">
                        <option value="USUÁRIO">USUÁRIO</option>
                        <option value="ADMINISTRADOR">ADMINISTRADOR</option>
                    </select>
                </td>
                <td>ATIVO</td>
                <td>
                    <button type="button" class="btn-novo-usuario btn btn-success">CADASTRAR</button>
                </td>
            `;

    tbody.appendChild(novaLinha);
}

function salvarNovoUsuario(linha, botaoSalvar) {
    const campos = linha.querySelectorAll('.campo-edicao');
    const dados = new URLSearchParams();

    campos.forEach(campo => dados.append(campo.name, campo.value));
    dados.append('status_acesso', 'ATIVO');

    const url_insert = '../../Backend/Main/main_insert.php';

    fetch(url_insert, {
        method: 'POST',
        body: dados,
        credentials: 'same-origin'
    })
        .then(response => response.json())
        .then(json => {
            if (json.success) {
                alert(json.message || 'Usuário cadastrado com sucesso!');
                location.reload(); // recarrega tabela pra exibir novo usuário
            } else {
                alert('Erro ao cadastrar: ' + (json.message || 'Sem detalhe'));
            }
        })
        .catch(err => {
            console.error('Erro ao cadastrar novo usuário:', err);
            alert('Falha na comunicação com o servidor.');
        });
}