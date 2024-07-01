function inseretxt1() {
    const texto1 = '<a href="https://maps.app.goo.gl/GCijbtFjApqPer2XA" target="blank">Ir pelo GPS</a>'
    document.getElementById("texto1").innerHTML = texto1;
}

function inseretxt2() {
    const texto1 = '<a> Av. Alcides Lacerda, 157 - Rosa Neto, Eunápolis - BA, 45823-150</a>'
    document.getElementById("texto1").innerHTML = texto1;
}

function inseretxt3() {
    const texto1 = '<a href="mailto:wscentroautomotivo960@gmail.com" style="display:flex; align-items: center; text-decoration:none;"><span class="material-symbols-outlined">send</span> E-mail</a><br> <a href="tel:+5573998413091" style="display:flex; align-items:center; text-decoration: none;"><span class="material-symbols-outlined">call</span>Telefone</a><br> <a target="blank" href="https://wa.link/u9kimh" style="display:flex; align-items:center; text-decoration: none;"><i class="fab fa-whatsapp"></i> WhatsApp</a>';
    document.getElementById("texto1").innerHTML = texto1;
}

function ver_mais() {
    const fotos = document.getElementById('avaliacoes2');
    fotos.style.display = 'flex';
}

let imagesDisplayed = false;
function toggleImages() {
    const icon = document.getElementById("icon");
    const container = document.getElementById('avaliacoes2');
    const botao = document.getElementById('botao_imgs');
    if (imagesDisplayed) {
        while (container.firstChild) {
            container.removeChild(container.firstChild);
        }
        imagesDisplayed = false;
        botao.childNodes[0].textContent = "Ver Mais ";
        icon.textContent = "visibility";
    } else {
        for (let i = 1; i < 26; i++) {
            const img = document.createElement('img');
            img.src = `img/av${i}.png`;
            img.classList.add('img-fluid', 'img-thumbnail');
            img.alt = '...';
            container.appendChild(img);
        }
        imagesDisplayed = true;
        botao.childNodes[0].textContent = "Ver Menos ";
        icon.textContent = "visibility_off";
    }
}