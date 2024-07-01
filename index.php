<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="img/icon.png" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WS Centro Automotivo</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="script.js"></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg position-fixed">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><img src="img/ws_noback1.png" alt="img-logo" id="logo-img"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">TOPO</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="https://wa.me/557398691752" target="blank">WHATSAPP</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            TIPO DE SERVIÇO
                        </a>

                        <ul class="dropdown-menu" style="width:max-content;">
                            <li style="background-color:aliceblue; margin-bottom:5px;"> <a class="btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">AR-CONDICIONADO</a></li>
                            <li style="background-color:aliceblue; margin-bottom:5px"> <a class="btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">ELÉTRICO</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li style="background-color:aliceblue; margin-bottom:5px"> <a class="btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">MECÂNICO</a></li>
                        </ul>
                    </li>
                    <a class="nav-link active" aria-current="page" href="#" style="display:flex; align-items:center;">ENTRAR <span class="material-symbols-outlined">login</span> </a>

                </ul>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="PROCURE ALGO..." aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">BUSCAR</button>
                </form>
            </div>
        </div>
    </nav>
</body>


<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasRightLabel">TIPO DO SERVIÇO</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body" style="margin-bottom:1rem;" id="offcanvas_right">
        <p>Instalação de ar condicionado automotivo</p>

        <p>Manutenção preventiva do sistema de ar condicionado</p>

        <p>Recarga de gás refrigerante</p>

        <p>Limpeza de ar condicionado automotivo</p>

        <p>Substituição de filtros de ar condicionado</p>

        <p>Diagnóstico de falhas no sistema de ar condicionado</p>

        <p>Reparo de vazamentos no sistema de ar condicionado</p>

        <p>Verificação e ajuste da pressão do gás refrigerante</p>

        <p>Troca de compressor de ar condicionado</p>

        <p>Troca de condensador de ar condicionado</p>

        <p>Reparo de evaporador de ar condicionado</p>

        <p>Substituição de correias e polias do sistema de ar condicionado</p>

        <p>Verificação e reparo de componentes elétricos do ar condicionado</p>

        <p>Limpeza de dutos de ar condicionado</p>

        <p>Troca de válvulas de expansão do ar condicionado</p>

        <p>Inspeção e substituição de mangueiras do sistema de ar condicionado</p>

        <p>Conversão de sistemas de ar condicionado R12 para R134a</p>

        <p>Teste de desempenho do sistema de ar condicionado</p>

        <p>Substituição de sensores de temperatura do ar condicionado</p>

        <p>Instalação de sistemas de controle de clima automotivo</p>

        <img src="img/ws_noback1.png" alt="img-logo" id="logo-img">

    </div>
</div>body>



<section class="section1">
    <div class="blur">
        <div class="container-fluid" id="section1_content">
            <h1>Bem-vindo a<br> WSAutoCenter</h1>
            <p>Sua confiança é nosso compromisso. No WSAutoCenter, nós oferecemos serviços automotivos de alta
                qualidade, atendimento personalizado e uma equipe altamente especializada para cuidar do seu veículo.
            </p>
            <div class="container-fluid">
                <button type="button" class="btn btn-primary" id="button1">Agende um serviço</button>
                <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling" id="button2">Sobre nós</button>

                <div class="offcanvas offcanvas-start" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="offcanvasScrollingLabel">Sobre a WSCentroAtomotivo</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <p style="color:black">Fundada em 17/06/2020, somos uma equipe concentrada em oferecer o melhor para nossos clientes, proporcionando qualidade e agilidade na entrega de serviços, além de contarmos com funcionários especializados no ramo automotivo. Faça-nos uma visita e confira pessoalmente alguns de nossos serviços.</p>
                        <img src="img/perfil.png" alt="imageemoffcanvas" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section2">
    <h1 id="h1_section2">Catálogo de Serviços</h1><br>
    <div class="container-fluid" id="items_section2">
        <div class="container-fluid" id="container_section2">
            <div class="container-fluid" id="section2_content">
                <div class="container-fluid" id="item1">
                    <strong>Serviços elétricos</strong>
                    <p>Serviços elétricos para linha leve, pesada e agrícola. Teste e substituição de bateria, cabeamento, lanternagem, entre outros.</p>
                    <img id="img1" src="img/eletricos.jpeg" alt="imagem1">
                </div>
            </div>
        </div>

        <div class="container-fluid" id="container_section2">
            <div class="container-fluid" id="section2_content">
                <div class="container-fluid" id="item1">
                    <strong>Serviços mecânicos</strong>
                    <p>Serviços mecânicos para linha leve e utilitários. Reparo do motor, troca de óleo (caminhonete e carros leves), manutenção de suspensão, freio, etc. </p>
                    <img id="img1" src="img/mecanicos.jpeg" alt="imagem1">
                </div>
            </div>
        </div>


        <div class="container-fluid" id="container_section2">
            <div class="container-fluid" id="section2_content">
                <div class="container-fluid" id="item1">
                    <strong>Peças</strong>
                    <p>Farois, parafusos, arranques, relês de partida, peças para alternador, conexões, limpadores de parabrisas, bobinas, filtros, etc.</p>
                    <img id="img1" src="img/pecas.jpeg" alt="imagem1">
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section4">
    <div class="container-fluid">
        <h1 style="font-size: 50px; font-family:Cambria, Cochin, Georgia, Times, 'Times New Roman', serif; color: white">Localização e Contato</h1>
        <div style="display: flex; flex-direction: column; gap:30px;">
            <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseWidthExample" aria-expanded="false" aria-controls="collapseWidthExample" onclick="inseretxt1()">
                Localização via maps
            </button>
            <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseWidthExample" aria-expanded="false" aria-controls="collapseWidthExample" onclick="inseretxt2()">
                Endereço
            </button>
            <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseWidthExample" aria-expanded="false" aria-controls="collapseWidthExample" onclick="inseretxt3()">
                Contatos
            </button>

        </div>
        <div style="min-height: 120px;">
            <div class="collapse collapse-horizontal" id="collapseWidthExample">
                <div class="card card-body" style="width: 300px;">
                    <div id="texto1"></div>
                </div>
            </div>
        </div>
    </div>
    <img src="img/maps.jpeg" class="img-fluid" alt="">
</section>

<picture>
    <div class="container-fluid" id="avaliacoes1">
        <div class="container-fluid" id="vermais_title">

            <h1 id="header_see_more">Avaliações dos nossos Clientes</h1>

            <button type="button" class="btn btn-info" data-bs-toggle="dropdown" aria-expanded="false" onclick="toggleImages()" style="display:flex; align-items:center; gap: 1rem;" id="botao_imgs">
                Ver Mais <span class="material-symbols-outlined" id="icon">visibility</span>
            </button>
        </div>


        <?php
        for ($i = 1; $i < 5; $i++) {
            echo '<img src="img/av' . $i . '.png" class="img-fluid img-thumbnail" alt="...">';
        }
        ?>
    </div>
    <div class="container-fluid" id="avaliacoes2">
    </div>

    <script>
        function ver_mais() {
            const container = document.getElementById('avaliacoes2');
            for (let i = 1; i < 26; i++) {
                const img = document.createElement('img');
                img.src = `img/av${i}.png`;
                img.classList.add('imgfluid');
                img.alt = '...';
                container.appendChild(img);
            }
        }
    </script>




</picture>


<div class="container_footer" id="footer">
    <footer class="py-5">
        <div id="row_footer">

            <div class="col-6 col-md-2 mb-3">
                <h5>Informações Úteis</h5>
                <ul class="nav flex-column" id="ul_footer">
                    <li class="nav-item mb-2"><a href="#">Inicio</a></li>
                    <li class="nav-item mb-2">Segunda-sexta das 8:00 às 17:30</li>
                    <li class="nav-item mb-2"><a href="#"> </a>Sábado: 8:00 às 12:00</li>
                    <li class="nav-item mb-2"><a href="https://www.instagram.com/ws.centroautomotivo.c/">Acompanhe nosso Instagram</a></li>
                </ul>
            </div>

            <div class="col-md-5 offset-md-1 mb-3">
                <form id="form_email" action="sendmail.php" method="post">
                    <h5>Mande-nos um email</h5>
                    <div class="d-flex flex-column flex-sm-row w-100 gap-2">
                        <label for="newsletter1" class="visually-hidden">Seu melhor email</label>
                        <input id="newsletter1" type="text" class="form-control" placeholder="Seu e-mail aqui..." title="Te responderemos o mais rápido possível!">
                        <button class="btn btn-primary" type="button">Enviar</button>
                    </div>
                    <div class="form-floating" style="width:100%;">
                        <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea"></textarea>
                        <label for="floatingTextarea">Deixe sua mensagem</label>
                    </div>
                </form>
            </div>
        </div>

        <div class="d-flex flex-column  justify-content-center border-top" id="copy_footer">
            <p>&copy; 2024 WS Centro Automotivo, Todos os direitos reservados.</p>
            <img src="img/ws_noback1.png" alt="" class="img-fluid" id="img_footer">
        </div>
    </footer>
</div>

</html>