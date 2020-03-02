<?php

error_reporting(E_ALL);
ini_set('display_errors', true);
ini_set('html_errors', true);
ini_set('display_errors', true);
/**
* Mauricio Bermudez Vargas 21/07/2019 06:20 p.m.
*/

$dir = "inicio.php";
//$test = $_GET['testId'];
$test = 1;
if (isset($test)) {

}
else {
  //Registro nuevo
  $test = 0;
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Progressive Web Application">
    <meta name="theme-color" content="#499bea" />
    <title>Inicio</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="manifest" href="manifest.json">
    <link rel="stylesheet" type="text/css" media="screen" href="css/css_inicio.css" />
    <script type="text/javascript" src="jq/jquery-3.2.1.min.js"></script>
    <script src="js/cargaAudios.js"></script>
    <script src="js/camara.js"></script>     
</head>
<body>
<div id="mainArea">
        <div id="menu">
            <a id="salir" href="<?php echo $dir;?>"></a>
        </div>
        <div id="miCamera">
            <video id="video" autobuffer></video>
            <canvas id="canvas"></canvas>
            <button id="startbutton">¡Activa Camara!</button>
            <button id="stopbutton">¡Haz Foto!</button>
            <img src="http://placekitten.com/g/320/261" id="photo" alt="photo">
            <p id="result"></p>
        </div>        
        <div id="tabla">
            <div id="fila">
              <div id="containerPlay">               
                <template>                                       
                  <div id="itemPlay" class="itemPlay">
                    <audio id="audioPlay" class="audioPlay" controls>
                      <source id="source" class="audioPlay" type="audio/ogg"/>
                    </audio>
                    <p id="fecha" class="audioPlay"></p>
                    <div id="borrarAudio" class="borrarAudio">                      
                    </div>
                  </div> 
                </template>                                 
              </div>  
            </div>
        </div>
</div>
<div id="statusBar">                              
</div>
<!-- <script type="text/javascript" src="https://unpkg.com/@zxing/library@latest"></script> -->
<script async src="js/zxing.js"></script>
<script>

var streaming = false,
  video        = document.querySelector('#video'),
  canvas       = document.querySelector('#canvas'),
  photo        = document.querySelector('#photo'),
  startbutton  = document.querySelector('#startbutton'),
  stopbutton  = document.querySelector('#stopbutton'),
  width = 320,
  height = 0;
  
startbutton.addEventListener('click', function(ev){ camaraStart(); ev.preventDefault();}, false);
stopbutton.addEventListener('click', function(ev){ camaraStop(); barcode(); ev.preventDefault();}, false);

cargaAudios();

function barcode() {
  
  const codeReader = new ZXing.BrowserBarcodeReader();
  
  const img = document.getElementById('photo')
  
  codeReader.decodeFromImage(img)
          .then(result => {
            console.log(result);
            resultEl.textContent = result.text;
            document.getElementById('result').textContent = result.text
          })
          .catch(err => {
            console.error(err);
            document.getElementById('result').textContent = err;
          });  
          
  return 0;
}

if ('serviceWorker' in navigator) {
  window.addEventListener('load', () => {
    navigator.serviceWorker.register('./service-worker.js')
        .then((reg) => {
          console.log('Registrando el Service worker.', reg);
        }, function(err) {
      // registration failed :(
      console.log('Error al registrar el ServiceWorker: ', err);
    });
  });
}

$('#salir').html('<img src="./img/salir.png">');

</script>
</body>
</html>