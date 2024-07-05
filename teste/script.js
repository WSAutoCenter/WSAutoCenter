
document.getElementById('consultaForm').addEventListener('submit', function (event) {
    event.preventDefault(); // Evita o comportamento padrão do formulário

    var formData = new FormData(this); // Coleta os dados do formulário

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'consulta.php', true); // Muda para POST
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var data = JSON.parse(xhr.responseText);
            var resultDiv = document.getElementById('result');
            var nome_user = document.getElementById('nome_user');
            resultDiv.innerHTML = '';
            if (data.length > 0) {
                data.forEach(function (item) {
                    var p = document.createElement('p');
                    p.textContent = item.nome;
                    resultDiv.appendChild(p);
                });
                alert('Email já cadastrado!');
            } else {
                resultDiv.textContent = 'Nenhum dado encontrado.';
            }
        } else if (xhr.readyState === 4) {
            console.error('Erro na consulta: ', xhr.statusText);
        }
    };
    xhr.send(formData);
});


document.getElementById('form').addEventListener('submit', function(event){
    event.preventDefault();
    var formdata = new FormData(this);
    var xhr = new XMLHttpRequest();

    
});