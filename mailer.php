<?php
include "conexao.php";

if (isset($_POST["enviar"])) {
    $contatos = isset($_POST['contacts']) ? $_POST['contacts'] : [];
    $messages = isset($_POST['messages']) ? $_POST['messages'] : [];
    $sendDate = isset($_POST['sendDate']) ? $_POST['sendDate'] : null;
    $observations = isset($_POST['observations']) ? $_POST['observations'] : [];


    // Ler o valor atual da lista do arquivo
    $listaFile = 'contador_lista.txt';
    $listaAtual = (int)file_get_contents($listaFile);
    $listaAtual++;

    // Atualizar o valor no arquivo
    file_put_contents($listaFile, $listaAtual);

    $lista = 'lista' . $listaAtual;

    if (!empty($contatos) && !empty($sendDate)) {
        foreach ($contatos as $index => $contactEmail) {
            $message = $messages[0] ?? ''; // Mensagem correspondente ao email
            $attachment = '';
            $observation = $observations[$index] ?? ''; // Observação correspondente ao email

            if (isset($_FILES['attachments']['name'][$index]) && !empty($_FILES['attachments']['name'][$index])) {
                $fileName = $_FILES['attachments']['name'][$index];
                $fileTmpName = $_FILES['attachments']['tmp_name'][$index];
                $filePath = 'uploads/' . $fileName;

                // Mover o arquivo para o diretório de uploads
                if (move_uploaded_file($fileTmpName, $filePath)) {
                    $attachment = $filePath;
                } else {
                    echo "Erro ao fazer upload do arquivo: " . $fileName;
                    continue;
                }
            }

            // Inserir dados no banco de dados
            $sql = "INSERT INTO emails (email, mensagem, data_envio, caminho, lista, observacao) VALUES ('$contactEmail', '$message', '$sendDate', '$attachment', '$lista', '$observation')";
            $resultado = banco($server, $user, $pass, $name, $sql);

            if ($resultado) {
                echo "Email agendado para o contato email: " . $contactEmail . "<br>";
            } else {
                echo "Erro ao agendar email para o contato email: " . $contactEmail . "<br>";
            }
        }
    } else {
        echo "Por favor, preencha todos os campos necessários.";
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meus e-mails</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="img/perfil.png" type="image/x-icon">
</head>

<body>
    <div class="container mt-5">
        <h2 class="text-center">Envio de email em massa</h2>
        <form id="emailForm" method="POST" action="mailer.php" enctype="multipart/form-data">
            <div id="contacts-container">
                <div class="contact-entry">
                    <div class="form-group">
                        <label for="contact">Contato</label><br>
                        <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight" id="loadContactsBtn">Selecione o contato</button>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop" id="carregar_listas">
                            Minhas Listas
                        </button>
                    </div>
                    <div class="form-group">
                        <label for="message">Mensagem</label>
                        <textarea class="form-control" name="messages[]" rows="3" placeholder="Escreva sua mensagem" required></textarea>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="sendDate">Data de Envio</label>
                <input type="datetime-local" class="form-control" id="sendDate" name="sendDate" required>
            </div>
            <button type="submit" class="btn btn-success" name='enviar'>Enviar</button>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Adicionar Contato</button>

            <div id="response" class="mt-3"></div>
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel" style="max-width:auto; width:80vw">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasRightLabel">Meus contatos</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div id="contactsContainer" class="offcanvas-body"></div>
                <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel" style="max-width:auto; width:80vw">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="offcanvasRightLabel">Meus contatos</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div id="contactsContainer" class="offcanvas-body"></div>
                </div>
            </div>
        </form>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Listas Disponiveis</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="listas_db">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Novo Contato</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form_novo_contato">
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">@</span>
                            <input type="text" class="form-control" placeholder="Nome" aria-label="Username" aria-describedby="basic-addon1" name="nome_contato">
                        </div>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Email" aria-label="Recipient's username" aria-describedby="basic-addon2" name="email_contato">
                            <span class="input-group-text" id="basic-addon2">@example.com</span>
                        </div>
                    </form>
                    <div id="modal-response" class="mt-3"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-primary" id="submit_btn">Adicionar</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('submit_btn').addEventListener('click', function() {
            var formData = new FormData(document.getElementById('form_novo_contato'));

            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'addcontato.php', true);

            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    var modalResponse = document.getElementById('modal-response');

                    if (response.status === 'success') {
                        modalResponse.innerHTML = '<div class="alert alert-success">Contato adicionado com sucesso!</div>';
                    } else {
                        modalResponse.innerHTML = '<div class="alert alert-danger">Erro ao adicionar contato: ' + response.message + '</div>';
                    }
                }
            };

            xhr.send(formData);
        });


        document.getElementById('loadContactsBtn').addEventListener('click', function() {
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'busca_contato.php', true);
            xhr.setRequestHeader('Content-Type', 'application/json');

            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    var container = document.getElementById('contactsContainer');
                    container.innerHTML = '';
                    if (response.status === 'success') {
                        var contacts = response.data;

                        for (var c = 0; c < contacts.length; c++) {
                            (function(contact) {
                                var div = document.createElement('div');
                                div.style.display = 'flex';
                                div.style.alignItems = 'center';
                                div.style.justifyContent = 'space-between';
                                div.style.border = '1px solid black';
                                div.style.borderRight = 'none';
                                div.style.borderLeft = 'none';
                                div.style.borderTop = 'none';
                                div.style.padding = '2px';

                                var checkbox = document.createElement('input');
                                checkbox.type = 'checkbox';
                                checkbox.className = 'btn-check';
                                checkbox.id = 'btncheck' + contact.id;
                                checkbox.autocomplete = 'off';
                                checkbox.name = 'contacts[]';
                                checkbox.value = contact.email;

                                var label = document.createElement('label');
                                label.className = 'btn btn-outline-primary';
                                label.htmlFor = 'btncheck' + contact.id;
                                label.textContent = contact.email;

                                var p = document.createElement('p');
                                p.textContent = contact.nome;

                                var fileInput = document.createElement('input');
                                fileInput.type = 'file';
                                fileInput.className = 'form-control-file';
                                fileInput.name = 'attachments[]';
                                fileInput.style.width = 'auto';

                                var obsInput = document.createElement('input');
                                obsInput.type = 'text';
                                obsInput.className = 'form-control observation-input';
                                obsInput.name = 'observations[]';
                                obsInput.placeholder = 'Observações';
                                obsInput.dataset.contactId = contact.id;
                                obsInput.style.width = 'auto';

                                // Adicionar evento para armazenar seleção no localStorage
                                checkbox.addEventListener('change', function() {
                                    var storedData = JSON.parse(localStorage.getItem('contactSelection')) || {};
                                    storedData[contact.id] = {
                                        checked: checkbox.checked,
                                        file: storedData[contact.id] ? storedData[contact.id].file : null,
                                        observation: storedData[contact.id] ? storedData[contact.id].observation : ''
                                    };
                                    localStorage.setItem('contactSelection', JSON.stringify(storedData));
                                });

                                fileInput.addEventListener('change', function() {
                                    var storedData = JSON.parse(localStorage.getItem('contactSelection')) || {};
                                    var filePath = fileInput.files.length > 0 ? fileInput.files[0].name : '';
                                    storedData[contact.id] = {
                                        checked: checkbox.checked,
                                        file: filePath,
                                        observation: storedData[contact.id] ? storedData[contact.id].observation : ''
                                    };
                                    localStorage.setItem('contactSelection', JSON.stringify(storedData));
                                });

                                obsInput.addEventListener('input', function() {
                                    var storedData = JSON.parse(localStorage.getItem('contactSelection')) || {};
                                    storedData[contact.id] = {
                                        checked: checkbox.checked,
                                        file: storedData[contact.id] ? storedData[contact.id].file : null,
                                        observation: obsInput.value
                                    };
                                    localStorage.setItem('contactSelection', JSON.stringify(storedData));
                                });

                                div.appendChild(checkbox);
                                div.appendChild(label);

                                var storedData = JSON.parse(localStorage.getItem('contactSelection')) || {};
                                if (storedData[contact.id]) {
                                    checkbox.checked = storedData[contact.id].checked;
                                    obsInput.value = storedData[contact.id].observation || '';
                                    if (storedData[contact.id].file) {
                                        var fileLabel = document.createElement('span');
                                        fileLabel.textContent = storedData[contact.id].file;
                                        div.appendChild(fileLabel);
                                    }
                                }

                                div.appendChild(fileInput);
                                div.appendChild(obsInput);
                                container.appendChild(div);
                            })(contacts[c]);
                        }

                        // Botão Limpar
                        var clearButton = document.createElement('button');
                        clearButton.textContent = 'Limpar';
                        clearButton.className = 'btn btn-danger mt-3';
                        clearButton.addEventListener('click', function() {
                            // Limpar localStorage
                            localStorage.removeItem('contactSelection');

                            // Limpar checkboxes e inputs de observação
                            var checkboxes = document.querySelectorAll('.btn-check');
                            checkboxes.forEach(function(checkbox) {
                                checkbox.checked = false;
                            });

                            var obsInputs = document.querySelectorAll('.observation-input');
                            obsInputs.forEach(function(obsInput) {
                                obsInput.value = '';
                            });

                            // Remover nomes de arquivo exibidos
                            var fileLabels = document.querySelectorAll('span');
                            fileLabels.forEach(function(fileLabel) {
                                fileLabel.remove();
                            });
                        });

                        container.appendChild(clearButton);
                    } else {
                        alert(response.message);
                    }
                }
            };

            xhr.send();
        });





        document.getElementById('carregar_listas').addEventListener('click', function(event) {
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'busca_listas.php', true);
            xhr.setRequestHeader('Content-Type', 'application/json');

            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    var listasContainer = document.getElementById('listas_db');
                    listasContainer.style.display = 'flex';
                    listasContainer.style.flexDirection = 'column';
                    listasContainer.style.gap = '16px';

                    listasContainer.innerHTML = '';

                    if (response.status === 'success') {
                        response.data.forEach(function(listaData, index) {
                            var listItem = document.createElement('div');
                            listItem.style.display = 'flex';
                            listItem.style.alignItems = 'center';
                            listItem.style.gap = '10px';

                            var button = document.createElement('button');
                            button.textContent = listaData.lista;
                            button.className = 'btn btn-primary';
                            button.type = 'button';
                            button.setAttribute('data-bs-toggle', 'collapse');
                            button.setAttribute('data-bs-target', '#collapse' + index);
                            button.setAttribute('aria-expanded', 'false');
                            button.setAttribute('aria-controls', 'collapse' + index);

                            var deleteButton = document.createElement('button');
                            deleteButton.textContent = 'Deletar Toda Lista';
                            deleteButton.className = 'btn btn-danger';
                            deleteButton.addEventListener('click', function() {
                                if (confirm('Tem certeza que deseja deletar esta lista?')) {
                                    var xhrDelete = new XMLHttpRequest();
                                    xhrDelete.open('POST', 'deletar_lista.php', true);
                                    xhrDelete.setRequestHeader('Content-Type', 'application/json');
                                    xhrDelete.onreadystatechange = function() {
                                        if (xhrDelete.readyState === 4 && xhrDelete.status === 200) {
                                            var response = JSON.parse(xhrDelete.responseText);
                                            if (response.status === 'success') {
                                                alert('Lista deletada com sucesso');
                                                document.getElementById('carregar_listas').click(); // Recarregar as listas
                                            } else {
                                                alert('Erro ao deletar a lista: ' + response.message);
                                            }
                                        }
                                    };
                                    xhrDelete.send(JSON.stringify({
                                        lista: listaData.lista
                                    }));
                                }
                            });

                            var collapseDiv = document.createElement('div');
                            collapseDiv.id = 'collapse' + index;
                            collapseDiv.className = 'collapse';

                            var collapseContent = document.createElement('div');
                            collapseContent.className = 'card card-body';

                            listaData.details.forEach(function(detail) {
                                var div = document.createElement('div');

                                div.innerHTML = `
                            <div style='background-color:aliceblue; border: 1px solid black; border-radius:10px; padding:1rem; margin-bottom: 5px'>
                                <strong>Data de envio: ${detail.data_envio}</strong><br><br>
                                <strong>Email:</strong> <input type="text" value="${detail.email}" class="form-control" data-id="${detail.id}" data-field="email">
                                <br><strong>Arquivo Atual:</strong><p>${detail.caminho}</p><br> 
                                <strong>Novo Arquivo:</strong> <input type="file" class="form-control" data-id="${detail.id}" data-field="caminho">
                                <br><strong>Observação:</strong> <input type="text" value="${detail.observacao}" class="form-control" data-id="${detail.id}" data-field="observacao">
                                <button class="btn btn-danger mt-2" data-id="${detail.id}" onclick="deleteEmail(${detail.id})">Apagar email</button>
                            </div>
                        `;

                                collapseContent.appendChild(div);
                            });

                            var updateButton = document.createElement('button');
                            updateButton.textContent = 'Atualizar';
                            updateButton.className = 'btn btn-primary mt-3';
                            updateButton.addEventListener('click', function() {
                                var formData = new FormData();
                                var inputs = collapseContent.querySelectorAll('input');

                                inputs.forEach(function(input) {
                                    var id = input.dataset.id;
                                    var field = input.dataset.field;
                                    var value = input.value;

                                    if (input.type === 'file' && input.files.length > 0) {
                                        formData.append(`files[${id}]`, input.files[0]);
                                    } else {
                                        formData.append(`${field}[${id}]`, value);
                                    }
                                });

                                var xhrUpdate = new XMLHttpRequest();
                                xhrUpdate.open('POST', 'update_listas.php', true);

                                xhrUpdate.onreadystatechange = function() {
                                    if (xhrUpdate.readyState === 4 && xhrUpdate.status === 200) {
                                        var response = JSON.parse(xhrUpdate.responseText);
                                        if (response.status === 'success') {
                                            alert('Dados atualizados com sucesso');
                                        } else {
                                            alert('Erro ao atualizar os dados: ' + response.message);
                                        }
                                    }
                                };
                                xhrUpdate.send(formData);
                            });

                            collapseContent.appendChild(updateButton);

                            collapseDiv.appendChild(collapseContent);

                            listItem.appendChild(button);
                            listItem.appendChild(deleteButton);
                            listasContainer.appendChild(listItem);
                            listasContainer.appendChild(collapseDiv);
                        });
                    } else {
                        alert(response.message);
                    }
                }
            };

            xhr.send();
        });

        function deleteEmail(emailId) {
            if (confirm('Tem certeza que deseja deletar este email?')) {
                var xhrDeleteEmail = new XMLHttpRequest();
                xhrDeleteEmail.open('POST', 'apagar_email.php', true);
                xhrDeleteEmail.setRequestHeader('Content-Type', 'application/json');
                xhrDeleteEmail.onreadystatechange = function() {
                    if (xhrDeleteEmail.readyState === 4 && xhrDeleteEmail.status === 200) {
                        var response = JSON.parse(xhrDeleteEmail.responseText);
                        if (response.status === 'success') {
                            alert('Email deletado com sucesso');
                            document.getElementById('carregar_listas').click(); // Recarregar as listas
                        } else {
                            alert('Erro ao deletar o email: ' + response.message);
                        }
                    }
                };
                xhrDeleteEmail.send(JSON.stringify({
                    id: emailId
                }));
            }
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>

</html>