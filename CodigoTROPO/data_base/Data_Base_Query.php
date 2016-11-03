<?php

/**
 * Created by PhpStorm.
 * User: Jonan
 * Date: 10/24/2016
 * Time: 6:32 PM
 */

class Data_Base_Query
{



    public function Check_Credit($identificador){

        $database = new DataBase_Managment();
        $connection = $database->db_Connection();
        $result = $connection->query("SELECT saldo FROM usuario WHERE id_cliente = '$identificador'");
        $aux = $result->fetch_assoc();
        $connection->close();
        return $aux['saldo'];

    }


    public function Make_Sale($monto,$identificador,$numeroProveedor){

        $saldo = $this->Check_Credit($identificador);
        $aux1 = $saldo - $monto;
         if($aux1<=0){

             return "Saldo insuficiente";
         }
         else{
             $database = new DataBase_Managment();
             $connection = $database->db_Connection();
             $connection->query("UPDATE usuario SET saldo = '$aux1' WHERE id_cliente = '$identificador'");
             $result = $connection->query("SELECT saldo FROM proveedor WHERE numeroTelefono =  '$numeroProveedor'");
             $saldo = $result->fetch_assoc();
             $aux2 = $saldo['saldo'] + $monto;
             $connection->query("UPDATE proveedor SET saldo = '$aux2' WHERE numeroTelefono = '$numeroProveedor'");
             $connection->close();
         }

        return $aux1;


    }

    public function Add_Money($identificador,$cantidadDeposito){
        $database = new DataBase_Managment();
        $connection = $database->db_Connection();
        $result = $connection->query("SELECT saldo FROM usuario WHERE identificador =  '$identificador'");
        $saldo = $result->fetch_assoc();
        $aux1 = $saldo['saldo'] + $cantidadDeposito;
        $connection->query("UPDATE usuario SET saldo = '$aux1'");
        $connection->close();
    }

    public function Insert_Trasa($id_cliente,$id_proveedor,$operacion,$fecha,$monto){

        $database = new DataBase_Managment();
        $connection = $database->db_Connection();
        $result = $connection->query("INSERT INTO trasa (id_cliente,id_proveedor,operacion,fecha,monto) VALUES ('$id_cliente','$id_proveedor','$operacion','$fecha','$monto')");
        $connection->close();
        return $result;

    }

    
}
?>