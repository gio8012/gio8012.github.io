<?php
   $nombre=$_POST['txt_nombre'];
   $a_p=$_POST['txt_apellidoPaterno'];
   $a_m=$_POST['txt_apellidoMaterno'];
   $edad=$_POST['txt_edad'];
   $fecha_nac=$_POST['txt_fechaNacimiento'];
   $sexo=$_POST['txt_sexo'];
   $clavep_test1=1;
    require('conexion1.php');


    if( $cn->connect_errno==0 ) {
        echo("Conexión exitosa");
        $insertar=$cn->query("insert into persona values(0,'".$nombre."','".$a_p."','".$a_m."','.$edad.','".$fecha_nac."','".$sexo."','.$clavep_test1.')");     
        if($insertar==1){          
           echo("El registro se guardo correctamente=".!$cn->connect_errno. "Insertar =".$insertar); 
        }
        else{
           echo("No se guardo el registro".$cn->error."insertar=".$insertar); //$insertar no devulve ningun valor cuando falla la consulta
        }
        $cn->close();  
    }
    else //2054 es el valor que devuelve $cn->connect_errno
         //Si la conexión falla 
      echo("Fallo la Conexión".$cn->connect_errno); 
      //Error(500) interno del servidor, checar sintaxis en php
?>