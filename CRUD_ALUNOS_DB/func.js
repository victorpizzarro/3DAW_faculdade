const form = document.getElementById("formAluno");
const nome = document.getElementById("nome");
const matricula = document.getElementById("matricula");
const email = document.getElementById("email");
const id = document.getElementById("id");
const msg = document.getElementById("msg");
const lista = document.getElementById("lista");

// Inserir ou editar
form.addEventListener("submit", e => {
    e.preventDefault();

    const dados = new FormData(form);
    const url = id.value ? "editar.php" : "inserir.php";

    fetch(url, { method: "POST", body: dados })
        .then(res => res.text())
        .then(texto => {
            msg.textContent = texto;
            form.reset();
            id.value = "";
            listarUsuarios();
        });
});

// Listar todos
function listarUsuarios() {
    fetch("listar.php")
        .then(res => res.json())
        .then(dados => {
            lista.innerHTML = "";
            const tabela = document.createElement("table");
            tabela.border = "1";
            tabela.style.borderCollapse = "collapse";
            tabela.style.width = "100%";
            tabela.innerHTML = `
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Matrícula</th>
                    <th>Email</th>
                    <th>Ações</th>
                </tr>
            `;
            dados.forEach(user => {
                const linha = document.createElement("tr");
                linha.innerHTML = `
                    <td>${user.id}</td>
                    <td>${user.nome}</td>
                    <td>${user.matricula}</td>
                    <td>${user.email}</td>
                    <td>
                        <button onclick="editarUsuario(${user.id}, '${user.nome}', '${user.matricula}', '${user.email}')">Editar</button>
                        <button onclick="excluirUsuario(${user.id})">Excluir</button>
                    </td>
                `;
                tabela.appendChild(linha);
            });
            lista.appendChild(tabela);
        });
}

// Excluir
function excluirUsuario(idAluno) {
    const dados = new FormData();
    dados.append("id", idAluno);

    fetch("deletar.php", { method: "POST", body: dados })
        .then(res => res.text())
        .then(texto => {
            msg.textContent = texto;
            listarUsuarios();
        });
}

// Editar
function editarUsuario(idAluno, nomeAluno, matriculaAluno, emailAluno) {
    id.value = idAluno;
    nome.value = nomeAluno;
    matricula.value = matriculaAluno;
    email.value = emailAluno;
    msg.textContent = "Modo edição: altere e clique em Enviar.";
}

// Buscar
document.getElementById("btnBuscar").addEventListener("click", () => {
    const termo = nome.value.trim();
    if (!termo) {
        alert("Digite um nome para buscar.");
        return;
    }

    fetch(`buscar.php?nome=${encodeURIComponent(termo)}`)
        .then(res => res.json())
        .then(dados => {
            lista.innerHTML = "";
            if (dados.length === 0) {
                lista.innerHTML = "<p>Nenhum aluno encontrado.</p>";
                return;
            }
            const tabela = document.createElement("table");
            tabela.border = "1";
            tabela.style.borderCollapse = "collapse";
            tabela.style.width = "100%";
            tabela.innerHTML = `
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Matrícula</th>
                    <th>Email</th>
                    <th>Ações</th>
                </tr>
            `;
            dados.forEach(user => {
                const linha = document.createElement("tr");
                linha.innerHTML = `
                    <td>${user.id}</td>
                    <td>${user.nome}</td>
                    <td>${user.matricula}</td>
                    <td>${user.email}</td>
                    <td>
                        <button onclick="editarUsuario(${user.id}, '${user.nome}', '${user.matricula}', '${user.email}')">Editar</button>
                        <button onclick="excluirUsuario(${user.id})">Excluir</button>
                    </td>
                `;
                tabela.appendChild(linha);
            });
            lista.appendChild(tabela);
        });
});

document.getElementById("btnListarTodos").addEventListener("click", listarUsuarios);

// Carregar lista ao abrir
listarUsuarios();
