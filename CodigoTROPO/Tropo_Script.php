<?php

include 'busine_logical/data_base/Data_Base_Query.php';
include 'busine_logical/data_base/DataBase_Managment.php';
require 'tropo.class.php';


$session = new Session();
$initialText = $session->getInitialText();
$from = $session->getFrom();
$numeroProveedor = $from["id"];
$tropo = new Tropo();



//---------------------Trabajo con el mensaje del arduino--------------------------------------
$numeroCase = substr($initialText,0,1);
if($numeroCase == "1"){
    $idCliente = substr($initialText,3);

}
else{
    if($numeroCase == "2"){
        $numeroCase = "2";
        $i = 3;
        $stop = true;
        while ($stop == true){
            $auxiliar = substr($initialText,$i,1);
            if($auxiliar == ","){
                $stop = false;
            }
            else{
                $idCliente .= $auxiliar;
                $i++;
            }


        }
        $monto = substr($initialText,$i+2);
    }
    else{
        $tropo->message("Formato de Datos Incorrectos" . $result, array("to" => "+" . $numeroProveedor, "network" => "SMS"));
        $tropo->RenderJson();
    }

}

//----------------------Tratamiento de los Case-------------------------------------------------

switch ($numeroCase){

    case 1:

        $operacion = "Consultar Saldo";
        $fecha = date("Y-m-d h:i:sa");
        $monto = null;

        $Data_Base_Query = new Data_Base_Query();
        $result = $Data_Base_Query->Check_Credit($idCliente);
        $Data_Base_Query->Insert_Trasa($idCliente, $numeroProveedor, $operacion, $fecha,$monto);
        //------------------------Enviar un mensaje con el saldo----------------------------------------------
        $tropo->message("El saldo de su cuenta es : ".$result, array("to"=>"+".$numeroProveedor, "network"=>"SMS"));
        $tropo->RenderJson();





        break;

    case 2:

        $fecha = date("Y-m-d h:i:sa");
        $Data_Base_Query = new Data_Base_Query();
        $result = $Data_Base_Query->Make_Sale($monto,$idCliente,$numeroProveedor);
        if($result == "Saldo insuficiente"){
            //------------------------Enviar un mensaje de Saldo Insuficiente----------------------------------------------
            $operacion = "Consultar Saldo";
            $monto = null;
            $Data_Base_Query->Insert_Trasa($idCliente, $numeroProveedor, $operacion, $fecha,$monto);
            $result = $Data_Base_Query->Check_Credit($idCliente);
            $tropo->message("El saldo de su cuenta es insuficiente y su saldo actual es :".$result, array("to"=>"+".$numeroProveedor, "network"=>"SMS"));
            $tropo->RenderJson();

            break;
        }
        else {
            //------------------------Enviar un mensaje de exito y el saldo restante----------------------------------------------
            $operacion = "Comprar Articulo";
            $Data_Base_Query->Insert_Trasa($idCliente, $numeroProveedor, $operacion, $fecha, $monto);
            $tropo->message("La transaccion a sido completada con Exito y su saldo es : " . $result, array("to" => "+" . $numeroProveedor, "network" => "SMS"));
            $tropo->RenderJson();


            break;
        }
}


?>