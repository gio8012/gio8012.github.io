<?php
$peso = (float)  $_POST['txt_peso'];
$altura = (float) $_POST['txt_altura'];
$clavep_persona1 =$_POST['txt_id']; ;
require('conexion1.php');
if ($peso > 0 && $altura > 0) {
   // Calcular el IMC
   $calc_imc = $peso / ($altura * $altura);
   
   // Mostrar el resultado con 2 decimales
   echo "Tu IMC es: " . number_format($calc_imc, 2);
}
if( $cn->connect_errno==0) {
    echo("Conexión exitosa");
    //Sintaxis guia
    //insert into plan_salud values(0,'dieta equilibrada','realiza ejercicio,no fumar');  
    $insertar=$cn->query("insert into imc values(0,".$peso.",".$altura.",".$calc_imc.",'.$clavep_persona1.')");

    if($insertar==1){          
      echo("El registro se guardo correctamente=".!$cn->connect_errno. "Insertar =". $insertar); 
   }
   else{
      echo("No se guardo el registro".$cn->error."insertar=".$insertar); //$insertar no devulve ningun valor cuando falla la consulta
   }
   $cn->close();  
}
else{ //2054 es el valor que devuelve $cn->connect_errno
    //Si la conexión falla 
 echo("Fallo la Conexión".$cn->connect_errno); 
 //Error(500) interno del servidor, checar sintaxis en php
}
?>