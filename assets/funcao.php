<?php
function upload($tmp,$nome,$largura,$pasta){
    $img = imagecreatefromjpeg($tmp);
    $x = imagesx($img);
    $y = imagesy($img);
    $altura =($largura *$y)/$x;
    $nova=  imagecreatetruecolor($largura, $altura);
    imagecopyresampled($nova,$img,0,0,0,0,$largura,$altura,$x,$y);
    imagejpeg($nova,"$pasta/$nome");
    imagedestroy($nova);
    imagedestroy($img);
    
    return($nome);
}