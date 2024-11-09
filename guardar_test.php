<?php
$rd_resp1 = isset($_POST['rd_resp1']) ? (int)$_POST['rd_resp1'] : 0;
$rd_resp2 = isset($_POST['rd_resp2']) ? (int)$_POST['rd_resp2'] : 0;
$rd_resp3 = isset($_POST['rd_resp3']) ? (int)$_POST['rd_resp3'] : 0;
$rd_resp4 = isset($_POST['rd_resp4']) ? (int)$_POST['rd_resp4'] : 0;
$rd_resp5 = isset($_POST['rd_resp5']) ? (int)$_POST['rd_resp5'] : 0;
$rd_resp6 = isset($_POST['rd_resp6']) ? (int)$_POST['rd_resp6'] : 0;
$rd_resp7 = isset($_POST['rd_resp7']) ? (int)$_POST['rd_resp7'] : 0;
$rd_resp8 = isset($_POST['rd_resp8']) ? (int)$_POST['rd_resp8'] : 0;
$rd_resp9 = isset($_POST['rd_resp9']) ? (int)$_POST['rd_resp9'] : 0;
$rd_resp10 = isset($_POST['rd_resp10']) ? (int)$_POST['rd_resp10'] : 0;

$resultado = $rd_resp1 + $rd_resp2 + $rd_resp3 + $rd_resp4 + $rd_resp5 + 
                 $rd_resp6 + $rd_resp7 + $rd_resp8 + $rd_resp9 + $rd_resp10;

$fecha = date("14/10/24");

$clavep_plan_salud1=$_POST['txt_nivel'];

    require('conexion1.php');
    
    if( $cn->connect_errno ==0) {
      echo("Conexión exitosa");
      //Sintaxis guia
      //insert into plan_salud values(0,'dieta equilibrada','realiza ejercicio,no fumar');  
      $insertar=$cn->query("insert into test values(0,'.$fecha.','.$resultado.','.$clavep_plan_salud1.')");

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