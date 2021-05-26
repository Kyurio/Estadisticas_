<?php

    // imports
    require_once("../../config/core/Autoload.php");
    require_once("../../extends/redirect.php");

    class Promedios extends Conexion {

        private $id;
        private $sucursal;
        private $fecha;
        private $saldo;

        function __construct(){
         
            $this->conexion = new Conexion();
            $this->conexion = $this->conexion->connect();

        }

        // inserta el promedio de sucursales
        public function CalcularPromedios ($año) {

            try{

                $this->fecha = filter_var ($año, FILTER_SANITIZE_NUMBER_INT);
                
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

        // guarda el historial promedios
        public function GrabarHistorialPromedio ($intSucursal, $strFecha, $intSaldo) {

            try {
            
                $this->sucursal = filter_var($intSucursal, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $this->fecha = filter_var($strFecha, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $this->saldo = filter_var($intSaldo, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                // inserta el resultado de los promedios calculados
                $sql = "CALL inserta_promedio_estadisticas(?,?,?)";
                $insert = $this->conexion->prepare($sql);
                $arrData = array($this->sucursal, $this->fecha, $this->saldo);
                $resInsert = $insert->execute($arrData);

                if($resInsert){
                    return true;
                }else{
                    return false;
                }

            } catch (Exception $e) {
                Err(500);
            }

        }

        public function GrabarHistorialPromedioAnterior ($intSucursal, $strFecha, $intSaldo) {

            try {
            
                $this->sucursal = filter_var($intSucursal, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $this->fecha = filter_var($strFecha, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $this->saldo = filter_var($intSaldo, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                // inserta el resultado de los promedios calculados
                $sql = "CALL inserta_promedio_estadisticas_año_anterior(?,?,?)";
                $insert = $this->conexion->prepare($sql);
                $arrData = array($this->sucursal, $this->fecha, $this->saldo);
                $resInsert = $insert->execute($arrData);

                if($resInsert){
                    return true;
                }else{
                    return false;
                }

            } catch (Exception $e) {
                Err(500);
            }

        }


    }