<?php

require_once("../../config/query/Promedios.php");
require_once("../../config/core/Autoload.php");
require_once("../../extends/redirect.php");

$objPromedios = new Promedios();

$option = 'extraer';
$año = 2020;

switch ($option) {

    echo $option;
    case 'insertar':
        
        function insertar_promedios() {

            try {
        
                $año = date("Y");
                $añoAnterior = date("Y", strtotime($año."- 1 year"));
        
                // graba el año actual
                if($select = $objPromedios->CalcularPromedios($año)){
        
                    foreach($select as $item) {
        
                        if($objPromedios->GrabarHistorialPromedio($item["sucursal_se"], $item["fecha_se"], $item["total"])){
                            echo "true";
                        }else{
                            echo "false";
                        }
        
                    }
                
                }
        
                // graba el año anterior
                if($selectAñoAnterior = $objPromedios->CalcularPromedios($añoAnterior)){
        
                    foreach($selectAñoAnterior as $item) {
        
                        if($objPromedios->GrabarHistorialPromedioAnterior($item["sucursal_se"], $item["fecha_se"], $item["total"])){
                            echo "true";
                        }else{
                            echo "false";
                        }
        
                    }
        
                }
        
        
            } catch (Exception $th) {
            
                Err(500);
        
            }
        
        }

    break;

    case 'extraer':
        
        function extraer_promedios() {
            echo "toy qui";
            $objPromedios = new Promedios();
            try {
        
                
                if($select = $objPromedios->CalcularPromedios(2020)){
        
                    echo json_encode($select);
        
                }
        
            } catch (Exception $th) {
                Err(500);
            }
        
        }

    break;
    
    default:
        
        echo "no funciona xd";

    break;
}
