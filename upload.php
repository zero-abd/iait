<?php
$allowedExts = array("gif", "jpeg", "jpg", "png", "PNG");
$temp = explode(".", $_FILES["file"]["name"]);
$extension = end($temp);
if ((($_FILES["file"]["type"] == "image/gif") || ($_FILES["file"]["type"] == "image/jpeg") || ($_FILES["file"]["type"] == "image/jpg") || ($_FILES["file"]["type"] == "image/pjpeg") || ($_FILES["file"]["type"] == "image/PNG") || ($_FILES["file"]["type"] == "image/png")) && ($_FILES["file"]["size"] < 1048576) && in_array($extension, $allowedExts)) {
    if ($_FILES["file"]["error"] > 0) {
        echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
    } else {

        $fileName = $temp[0] . "." . $temp[1];
        $temp[0] = rand(0, 3000); //Set to random number
        $fileName;

        if (file_exists("uploads/" . $_FILES["file"]["name"])) {
            echo $_FILES["file"]["name"] . " already exists. Please try again";
        } else {
            $temp = explode(".", $_FILES["file"]["name"]);
            $newfilename = round(microtime(true)) . '.' . end($temp);
            move_uploaded_file($_FILES["file"]["tmp_name"], "uploads/" . $newfilename);
            //echo "Stored in: " . "../img/imageDirectory/" . $_FILES["file"]["name"];
            //echo $newfilename;
            $img = file_get_contents('uploads/'. $newfilename); 
            $data = base64_encode($img); 
            //echo $data; 
            $cp1 = "<!DOCTYPE html>
<html lang='en' >
<head>
  <meta charset='UTF-8'>
</head>
<body>
<html>
  <head>
    <meta name='viewport' content='width=device-width' />
    <style type='text/css'>
      html,
body {
  background-color: ";

  $cp2 = ";
  width: 100%;
  height: 100%;
  margin: 50;
  padding: 50;
  overflow: hidden;
}
html .slides,
body .slides,
html > .dg,
body > .dg {
  display: none;
}
@media (min-width: 1000) {

  body > .dg {
    display: block;
  }
}

    </style>
     <script src='https://cdnjs.cloudflare.com/ajax/libs/dat-gui/0.5/dat.gui.min.js'></script>
     <script type='text/javascript'> 
        alert('Particles playground loaded successfully! Have fun. If it does not load, try refreshing your browser');
        </script>
     <script type='text/javascript'>
       var init = function(){
  var isMobile = navigator.userAgent &&
    navigator.userAgent.toLowerCase().indexOf('mobile') >= 0;
  var isSmall = window.innerWidth < 1000;
  
  var ps = new ParticleSlider({
    ptlGap: isMobile || isSmall ? 0 : 0,
    ptlSize: isMobile || isSmall ? 0 : 0,
    width: 1e9,
    height: 1e9
  });
    
  var gui = new dat.GUI();
  gui.add(ps, 'ptlGap').min(0).max(5).step(1).onChange(function(){
    ps.init(true);
  });
  gui.add(ps, 'ptlSize').min(1).max(5).step(1).onChange(function(){
    ps.init(true);
  });
  gui.add(ps, 'restless');
  gui.addColor(ps, 'color').onChange(function(value){
    ps.monochrome = true;
    ps.setColor(value);
    ps.init(true);
  });
  
  
  (window.addEventListener
   ? window.addEventListener('click', function(){ps.init(true)}, false)
   : window.onclick = function(){ps.init(true)});
}

var initParticleSlider = function(){
  var psScript = document.createElement('script');
  (psScript.addEventListener
    ? psScript.addEventListener('load', init, false)
    : psScript.onload = init);
  psScript.src = 'https://s3-us-west-2.amazonaws.com/s.cdpn.io/23500/ps-0.9.js';
  psScript.setAttribute('type', 'text/javascript');
  document.body.appendChild(psScript);
}
    
(window.addEventListener
  ? window.addEventListener('load', initParticleSlider, false)
  : window.onload = initParticleSlider);
     </script>
  </head>
  <body id='particle-slider'>
      <div class='slides'>
        <div id='first-slide' class='slide' data-src='data:image/png;base64,";
        $cp3 = "
        '>
        </div>
        </div>
        <canvas class='draw'></canvas>
  </body>
</html>";
         
        $color = file_get_contents("uploads/color.txt");
        $cp_t = $cp1.$color.$cp2.$data.$cp3;
        file_put_contents("uploads/".$newfilename.".html", $cp_t);
        header("Location:uploads/".$newfilename.".html", true, 303);
        exit();
        }
    }
} else {
    echo "Invalid file! Only image files(png, jpg, jpeg and gif) under 1MB are supported.";
}
?>
