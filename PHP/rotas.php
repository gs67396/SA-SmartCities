<?php
    session_start();

    if (!isset($_SESSION["conectado"]) || $_SESSION["conectado"] != true) {
        header("Location: login.php");
        exit;
    }
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/rotasstyle.css">
    <link rel="stylesheet" href="../CSS/menu.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <title>Rotas</title>
</head>

<body>
    <header>
       <div class="navbar" id="navbar" style="display: none;">
        <a href="../PHP/Inicio.php"><div><img src="../IMAGENS/SmartTrain.png" alt=""></div></a>
        <a href="../PHP/Inicio.php"> Inicio </a>
        <a href="../PHP/rotas.php"> Rotas </a>
        <a href="../PHP/dashboard.php"> Dashboard</a>
        <a href="../PHP/Alertas.php">Alertas</a>
        <a href="../PHP/configuracoes.php">Configurações</a>
    </div>
        <div id="map" style="width: 100%; height: 400px; position: relative;"
            class="leaflet-container leaflet-touch leaflet-fade-anim leaflet-grab leaflet-touch-drag leaflet-touch-zoom"
            tabindex="0">
            <div class="leaflet-pane leaflet-map-pane" style="transform: translate3d(0px, 0px, 0px);">
                <div class="leaflet-pane leaflet-tile-pane">
                    <div class="leaflet-layer " style="z-index: 1; opacity: 1;">
                        <div class="leaflet-tile-container leaflet-zoom-animated"
                            style="z-index: 17; transform: translate3d(-2338px, -1456px, 0px) scale(4);"></div>
                        <div class="leaflet-tile-container leaflet-zoom-animated"
                            style="z-index: 19; transform: translate3d(0px, 0px, 0px) scale(1);"><img alt=""
                                src="https://tile.openstreetmap.org/14/8183/5443.png"
                                class="leaflet-tile leaflet-tile-loaded"
                                style="width: 256px; height: 256px; transform: translate3d(78px, -48px, 0px); opacity: 1;"><img
                                alt="" src="https://tile.openstreetmap.org/14/8184/5443.png"
                                class="leaflet-tile leaflet-tile-loaded"
                                style="width: 256px; height: 256px; transform: translate3d(334px, -48px, 0px); opacity: 1;"><img
                                alt="" src="https://tile.openstreetmap.org/14/8183/5444.png"
                                class="leaflet-tile leaflet-tile-loaded"
                                style="width: 256px; height: 256px; transform: translate3d(78px, 208px, 0px); opacity: 1;"><img
                                alt="" src="https://tile.openstreetmap.org/14/8184/5444.png"
                                class="leaflet-tile leaflet-tile-loaded"
                                style="width: 256px; height: 256px; transform: translate3d(334px, 208px, 0px); opacity: 1;"><img
                                alt="" src="https://tile.openstreetmap.org/14/8182/5443.png"
                                class="leaflet-tile leaflet-tile-loaded"
                                style="width: 256px; height: 256px; transform: translate3d(-178px, -48px, 0px); opacity: 1;"><img
                                alt="" src="https://tile.openstreetmap.org/14/8185/5443.png"
                                class="leaflet-tile leaflet-tile-loaded"
                                style="width: 256px; height: 256px; transform: translate3d(590px, -48px, 0px); opacity: 1;"><img
                                alt="" src="https://tile.openstreetmap.org/14/8182/5444.png"
                                class="leaflet-tile leaflet-tile-loaded"
                                style="width: 256px; height: 256px; transform: translate3d(-178px, 208px, 0px); opacity: 1;"><img
                                alt="" src="https://tile.openstreetmap.org/14/8185/5444.png"
                                class="leaflet-tile leaflet-tile-loaded"
                                style="width: 256px; height: 256px; transform: translate3d(590px, 208px, 0px); opacity: 1;">
                        </div>
                    </div>
                </div>
                <div class="leaflet-pane leaflet-overlay-pane"></div>
                <div class="leaflet-pane leaflet-shadow-pane"></div>
                <div class="leaflet-pane leaflet-marker-pane"></div>
                <div class="leaflet-pane leaflet-tooltip-pane"></div>
                <div class="leaflet-pane leaflet-popup-pane"></div>
                <div class="leaflet-proxy leaflet-zoom-animated"
                    style="transform: translate3d(2.09507e+06px, 1.39366e+06px, 0px) scale(8192);"></div>
            </div>
            <div class="leaflet-control-container">
                <div class="leaflet-top leaflet-left">
                    <div class="leaflet-control-zoom leaflet-bar leaflet-control"><a class="leaflet-control-zoom-in"
                            href="#" title="Zoom in" role="button" aria-label="Zoom in" aria-disabled="false"><span
                                aria-hidden="true">+</span></a><a class="leaflet-control-zoom-out" href="#"
                            title="Zoom out" role="button" aria-label="Zoom out" aria-disabled="false"><span
                                aria-hidden="true">−</span></a>
                    </div>
                </div>
                <div class="leaflet-top leaflet-right"></div>
                <div class="leaflet-bottom leaflet-left"></div>
                <div class="leaflet-bottom leaflet-right">
                    <div class="leaflet-control-attribution leaflet-control"><a href="https://leafletjs.com"
                            title="A JavaScript library for interactive maps"><svg aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" width="12" height="8" viewBox="0 0 12 8"
                                class="leaflet-attribution-flag">
                                <path fill="#4C7BE1" d="M0 0h12v4H0z"></path>
                                <path fill="#FFD500" d="M0 4h12v3H0z"></path>
                                <path fill="#E0BC00" d="M0 7h12v1H0z"></path>
                            </svg> Leaflet</a> <span aria-hidden="true">|</span> © <a
                            href="http://www.openstreetmap.org/copyright">OpenStreetMap</a></div>
                </div>
            </div>
            <div class="home"><button id="menuButton" onclick="openav()"><img id="icon"
                        src="../IMAGENS/Hamburger_icon.svg.png"></button></div>
            <script src="../JAVASCRIPT/menu.js"></script>
        </div>

        <script>
            const map = L.map('map').setView([-26.335, -48.830], 13);

            const tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
            }).addTo(map);
        </script>
    </header>
    <main>
        <div class="content">
            <div class="rotasLogo">
                Rotas
            </div>

            <div class="tabs">
                <div>
                    <button onclick="changetab('todas')">Todas</button>
                    <div class="tabindicator" id="todastab"></div>
                </div>

                <div>
                    <button onclick="changetab('atuais')">Atuais</button>
                    <div class="tabindicator" id="atuaisstab" style="display: none;"></div>
                </div>

                <div>
                    <button onclick="changetab('alertas')">Alertas</button>
                    <div class="tabindicator" id="alertasstab" style="display: none;"></div>
                </div>
                <script src="../JAVASCRIPT/rotas.js"></script>
            </div>


            <div id="todascontent">
                <a href="../PHP/traininfo.php">
                    <div class="traindisplay">
                        <img src="../IMAGENS/trem1.png" alt="">
                        <div class="trainid">017</div>
                       <div class="traintext">
                            <div>
                                <div class="text">Lugar 1</div>
                                <div class="text">18:00</div>
                            </div>
                            <div class="text">-</div>
                            <div>
                                <div class="text">Lugar 2</div>
                                <div class="text">20:00</div>
                            </div>

                        </div>
                    </div>
                </a>
                <a href="../PHP/traininfo.php">
                    <div class="traindisplay">
                        <img src="../IMAGENS/trem1.png" alt="">
                        <div class="trainid">017</div>
                        <div class="traintext">
                            <div>
                                <div class="text">Lugar 1</div>
                                <div class="text">18:00</div>
                            </div>
                            <div class="text">-</div>
                            <div>
                                <div class="text">Lugar 2</div>
                                <div class="text">20:00</div>
                            </div>

                        </div>

                    </div>
                </a>

                <a href="../PHP/traininfo.php">

                    <div class="traindisplay">
                        <img src="../IMAGENS/trem1.png" alt="">
                        <div class="trainid">017</div>
                       <div class="traintext">
                            <div>
                                <div class="text">Lugar 1</div>
                                <div class="text">18:00</div>
                            </div>
                            <div class="text">-</div>
                            <div>
                                <div class="text">Lugar 2</div>
                                <div class="text">20:00</div>
                            </div>

                        </div>
                    </div>
                </a>


            </div>

            <div id="atuaiscontent" style="display: none">
                <div class="nodatalert">
                    <h1>Não há rotas disponíveis no momento.</h1>
                </div>

            </div>

            <div id="alertascnotent" style="display: none">
                <div class="nodatalert">
                    <h1>Não há alertas disponíveis no momento.</h1>
                </div>
            </div>


        </div>

        </div>

    </main>

    <footer>

    </footer>

</body>

</html>