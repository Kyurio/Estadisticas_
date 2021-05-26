<?php

    // imports
    require_once("../../config/core/Autoload.php");
    require_once("../../extends/redirect.php");

    class Resumen extends Conexion {

        private $año;

        function __construct(){
         
            $this->conexion = new Conexion();
            $this->conexion = $this->conexion->connect();

        }

        // inserta el promedio de sucursales
        public function CalcularPromedios ($año) {

            $this->año  = filter_var($año, FILTER_SANITIZE_NUMBER_INT);

            try{                
                // extrae los promediso mensuales
                $sql  =  ("SELECT sucursal_se, fecha_se, ROUND(AVG(saldo_se)) AS total 
                        FROM saldo_estadistica WHERE YEAR(fecha_se) = '$año'
                        GROUP BY sucursal_se, month(fecha_se)");
                        
                $stmt =  $this->conexion->query($sql);
                $row  =  $stmt->fetchAll();

                if ($row) {
                    return $row;
                }
                
            }catch (Exception $e){
                Err(500);
            }

        }



    }