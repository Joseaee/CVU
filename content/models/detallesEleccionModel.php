<?php 

namespace Cvu\Content\Models;
use Cvu\Content\Config\Connect\connectDB;
use Cvu\Content\helpers\expRegTrait;
use Cvu\Content\helpers\HttpResponseTrait;
use \PDO;
use PDOException;

class DetallesEleccionModel extends ConnectDB{

    use expRegTrait;
    use HttpResponseTrait;

    private $conex;
    private $codigoDetallesEleccion;
    private $periodoDetallesEleccion;
    private $horaAperturaDetallesEleccion;
    private $horaCierreDetallesEleccion;
    private $codigoEleccion;

    public function __construct(){

        parent::__construct();
        $this->conex = parent::activeDB();
    } 

    /**
     * Consulta los detalles de las elecciones activas en la base de datos.
     *
     * @return array Información de los detalles de las elecciones activas, un mensaje si no hay detalles de las elecciones,
     *               o información de error en caso de excepción.
     */
    public function consultarDetallesElecciones(){

        try{

            $consultarDetallesElecciones = $this->conex->prepare("SELECT * FROM tbldetalleeleccion de WHERE de.estado = 1;");
            $consultarDetallesElecciones->execute();
            $respuesta = $consultarDetallesElecciones->fetchAll(PDO::FETCH_ASSOC);

            if(count($respuesta) == 0){

                return array("status" => 'error', "message" => 'No hay detalles de elecciones registradas.', "data" => '', "statusCode" => 404);
            }

            return array("status" => 'success', "message" => 'Hay detalles de elecciones registradas.', "data" => $respuesta, "statusCode" => 200);
        }
        catch(PDOException $error){

            return array("status" => 'error', "message" => 'Ha habido una excepcion.', "data" => $error->errorInfo, "statusCode" => 400);
        }
    }

    /**
     * Consulta las elecciones activas en la base de datos.
     *
     * @return array Información de las elecciones activas, un mensaje si no hay elecciones,
     *               o información de error en caso de excepción.
     */
    public function consultarElecciones(){

        try{

            $consultarElecciones = $this->conex->prepare("SELECT * FROM tbleleccion e WHERE e.estado = 1;");
            $consultarElecciones->execute();
            $respuesta = $consultarElecciones->fetchAll(PDO::FETCH_ASSOC);

            if(count($respuesta) == 0){

                return array("status" => 'error', "message" => 'No hay elecciones registradas.', "data" => '', "statusCode" => 404);
            }

            return array("status" => 'success', "message" => 'Hay elecciones registradas.', "data" => $respuesta, "statusCode" => 200);
        }
        catch(PDOException $error){

            return array("status" => 'error', "message" => 'Ha habido una excepcion.', "data" => $error->errorInfo, "statusCode" => 400);
        }
    }

    /**
     * Valida los valores de los detalles de una eleccion.
     *
     * @return array Respuesta con éxito o error en la validacion.
     */
    public function validarDetallesEleccion($periodo, $horaApertura, $horaCierre){

        date_default_timezone_set("America/Caracas");

        if(!preg_match_all($this->expFechas, $periodo)){

            return array("status" => 'error', "message" => 'La fecha no es valida.', "data" => false, "statusCode" => 412);
        }

        if(strtotime(date("Y-m-d")) > strtotime(date($periodo))){

            return array("status" => 'error', "message" => 'La fecha no puede ser menor a hoy.', "data" => false, "statusCode" => 412);
        }
        
        try{
            $consultarFechas = $this->conex->prepare("SELECT de.periodo FROM tbldetalleeleccion de WHERE de.estado = 1 AND de.codigo != ? ORDER BY de.periodo DESC;");
            $consultarFechas->bindValue(1, $this->codigoDetallesEleccion ?? '');
            $consultarFechas->execute();
            $respuesta = $consultarFechas->fetchAll(PDO::FETCH_COLUMN);

            foreach ($respuesta as $value){

                if(strtotime(date($value)) == strtotime(date($periodo))){

                    return array("status" => 'error', "message" => 'Ya hay una eleccion planificada para la fecha de '.date("d-m-Y",  strtotime($value)).'.', "data" => false, "statusCode" => 412);
                }
            }
        } catch(PDOException $error){

            return array("status" => 'error', "message" => 'Ha habido una excepcion.', "data" => $error->errorInfo, "statusCode" => 400);
        }

        if(!preg_match_all($this->expHoras, $horaApertura)){

            return array("status" => 'error', "message" => 'La hora de apertura no es valida.', "data" => false, "statusCode" => 412);
        }

        if(!preg_match_all($this->expHoras, $horaCierre)){

            return array("status" => 'error', "message" => 'La hora de cierre no es valida.', "data" => false, "statusCode" => 412);
        }

        if(strtotime(date($periodo.' '.$horaApertura)) >= strtotime(date($periodo.' '.$horaCierre))){

            return array("status" => 'error', "message" => 'La hora de apertura no puede ser despues de la de cierre y la de cierre no puede ser antes de la de apertura.', "data" => false, "statusCode" => 412);
        }

        $this->periodoDetallesEleccion = $periodo;
        $this->horaAperturaDetallesEleccion = $horaApertura;
        $this->horaCierreDetallesEleccion = $horaCierre;

        return array("status" => 'success', "message" => 'Datos validos.', "data" => true, "statusCode" => 200);
    }

    /**
     * Verifica si la eleccion existe en la base de datos y está activa.
     *
     * @param string $id El identificador de la eleccion.
     * 
     * @return array Información sobre la existencia de la eleccion, 
     *               o mensajes de error si no existe o si el ID no es válido, 
     *               o información de error en caso de excepción.
     */
    public function existeEleccion($id){

        try{ 

            if(preg_match_all($this->expCodigoEleccion, $id)){

                $consultarEleccion = $this->conex->prepare("SELECT * FROM tbleleccion e WHERE e.codigo = ? AND e.estado = 1;");
                $consultarEleccion->bindValue(1, $id);
                $consultarEleccion->execute();
                $respuesta = $consultarEleccion->fetch(PDO::FETCH_ASSOC);

                if($respuesta == ''){

                    return array("status" => 'error', "message" => 'La eleccion seleccionada no existe.', "data" => false, "statusCode" => 404);
                }

                $this->codigoEleccion = $id;

                return array("status" => 'success', "message" => 'La eleccion seleccionada es valida y existe.', "data" => true, "statusCode" => 200);
            }
            else{

                return array("status" => 'error', "message" => 'El codigo de elección no es valido.', "data" => false, "statusCode" => 412);
            }
        }
        catch(PDOException $error){

            return array("status" => 'error', "message" => 'Ha habido una excepcion.', "data" => $error->errorInfo, "statusCode" => 400);
        }
    }

    /**
     *  Llama a la funcion de insertar detalles de la eleccion.
     *
     * @return array Respuesta con éxito o error en la inserción.
     */
    public function getInsertarDetallesEleccion(){

        return $this->insertarDetallesEleccion();
    }

    /**
     * Inserta nuevos detalles de la eleccion en la base de datos.
     *
     * @return array Respuesta con éxito o error en la inserción.
     */
    private function insertarDetallesEleccion(){

        try{

            $this->conex->beginTransaction();

            $this->codigoDetallesEleccion = date('YmdHis', time()).'detalleElec:'.rand(100,999);

            $insertarDetallesEleccion = $this->conex->prepare("INSERT INTO tbldetalleeleccion (codigo, periodo, horaApertura, horaCierre, idEleccion) VALUES (?, ?, ?, ?, ?);");
            $insertarDetallesEleccion->bindValue(1, $this->codigoDetallesEleccion);
            $insertarDetallesEleccion->bindValue(2, $this->periodoDetallesEleccion);
            $insertarDetallesEleccion->bindValue(3, $this->horaAperturaDetallesEleccion);
            $insertarDetallesEleccion->bindValue(4, $this->horaCierreDetallesEleccion);
            $insertarDetallesEleccion->bindValue(5, $this->codigoEleccion);
            $insertarDetallesEleccion->execute();

            $this->conex->commit();

            return array("status" => 'success', "message" => 'Registro exitoso', "data" => '', "statusCode" => 200);
        }
        catch(PDOException $error){

            $this->conex->rollBack();
            return array("status" => 'error', "message" => 'Ha habido una excepcion.', "data" => $error->errorInfo, "statusCode" => 400);
        }
    }

    /**
     * Verifica si los detalles de la eleccion existe en la base de datos y está activa.
     *
     * @param string $id El identificador de los detalles de eleccion.
     * 
     * @return array Información sobre la existencia de los detalles de la eleccion, 
     *               o mensajes de error si no existe o si el ID no es válido, 
     *               o información de error en caso de excepción.
     */
    public function existeDetallesEleccion($id){

        try{ 

            if(preg_match_all($this->expCodigoDetallesEleccion, $id)){

                $consultarDetallesEleccion = $this->conex->prepare("SELECT * FROM tbldetalleeleccion de WHERE de.codigo = ? AND de.estado = 1;");
                $consultarDetallesEleccion->bindValue(1, $id);
                $consultarDetallesEleccion->execute();
                $respuesta = $consultarDetallesEleccion->fetch(PDO::FETCH_ASSOC);

                if($respuesta == ''){

                    return array("status" => 'error', "message" => 'Los detalles de eleccion seleccionado no existe.', "data" => false, "statusCode" => 404);
                }

                $this->codigoDetallesEleccion = $id;

                return array("status" => 'success', "message" => 'Los detalles de eleccion seleccionado es valida y existe.', "data" => true, "statusCode" => 200);
            }
            else{

                return array("status" => 'error', "message" => 'El codigo de detalles de eleccion no es valido.', "data" => false, "statusCode" => 412);
            }
        }
        catch(PDOException $error){

            return array("status" => 'error', "message" => 'Ha habido una excepcion.', "data" => $error->errorInfo, "statusCode" => 400);
        }
    }

    /**
     * Consulta los detalles de la eleccion seleccionada.
     *
     * @return array Detalles de la eleccion.
     */
    public function consultarDetallesEleccionSeleccionada(){

        try{

            $consultarDetallesEleccion = $this->conex->prepare("SELECT * FROM tbldetalleeleccion de WHERE de.codigo = ? AND de.estado = 1;");
            $consultarDetallesEleccion->bindValue(1, $this->codigoDetallesEleccion);
            $consultarDetallesEleccion->execute();
            $respuesta = $consultarDetallesEleccion->fetch(PDO::FETCH_ASSOC);  

            return array("status" => 'success', "message" => 'Se consulto los detalles de eleccion'. $this->codigoDetallesEleccion.'.', "data" => $respuesta, "statusCode" => 200);
        }
        catch(PDOException $error){

            return array("status" => 'error', "message" => 'Ha habido una excepcion.', "data" => $error->errorInfo, "statusCode" => 400);
        }
    }

    /**
     * Llama a la funcion de actualizar detalles de una eleccion.
     *
     * @return array Respuesta con éxito o error en la actualización.
     */
    public function getActualizarDetallesEleccion(){

        return $this->actualizarDetallesEleccion();
    }

    /**
     * Actualiza los detalles de una eleccion en la base de datos.
     *
     * @return array Respuesta con éxito o error en la actualización.
     */
    private function actualizarDetallesEleccion(){

        try{

            $this->conex->beginTransaction();

            $actualizarDetallesEleccion = $this->conex->prepare("UPDATE tbldetalleeleccion de SET de.periodo = ?, de.horaApertura = ?, de.horaCierre = ?, de.idEleccion = ? WHERE de.codigo = ? AND de.estado = 1;");
            $actualizarDetallesEleccion->bindValue(1, $this->periodoDetallesEleccion);
            $actualizarDetallesEleccion->bindValue(2, $this->horaAperturaDetallesEleccion);
            $actualizarDetallesEleccion->bindValue(3, $this->horaCierreDetallesEleccion);
            $actualizarDetallesEleccion->bindValue(4, $this->codigoEleccion);
            $actualizarDetallesEleccion->bindValue(5, $this->codigoDetallesEleccion);
            $actualizarDetallesEleccion->execute();

            $this->conex->commit();

            return array("status" => 'success', "message" => 'Los detalels de eleccion del codigo'.$this->codigoDetallesEleccion.' fue actulizado exitosamente', "data" => '', "statusCode" => 200);
        }
        catch(PDOException $error){

            $this->conex->rollBack();
            return array("status" => 'error', "message" => 'Ha habido una excepcion.', "data" => $error->errorInfo, "statusCode" => 400);
        }
    }

    /**
     * Llama a la funcion de eliminar detalles de eleccion.
     *
     * @return array Respuesta con éxito o error en la eliminación.
     */
    public function getEliminarDetallesEleccion(){

        return $this->eliminarDetallesEleccion();
    }

    /**
     * Elimina logicamente un detalles de Eleccion en la base de datos.
     *
     * @return array Respuesta con éxito o error en la eliminación.
     */
    private function eliminarDetallesEleccion(){

        try{

            $consultarEleccion = $this->conex->prepare("SELECT * FROM tbldetalleeleccion de WHERE de.codigo = ? AND de.estado = 1;");
            $consultarEleccion->bindValue(1, $this->codigoDetallesEleccion);
            $consultarEleccion->execute();
            $respuesta = $consultarEleccion->fetch(PDO::FETCH_ASSOC);

            if(!$respuesta){

                return array("status" => 'error', "message" => 'Los detalles de eleccion no pudo ser borrado porque ya fue iniciada las elecciones o ya finalizaron.', "data" => false, "statusCode" => 404);
            }

            $eliminarEleccion = $this->conex->prepare("UPDATE tbldetalleeleccion de SET de.estado = 0 WHERE de.codigo = ? AND de.estado = 1;");
            $eliminarEleccion->bindValue(1, $this->codigoDetallesEleccion); 
            $eliminarEleccion->execute(); 

            return array("status" => 'success', "message" => 'Los detalles de eleccion del codigo'.$this->codigoDetallesEleccion.' fue eliminado exitosamente', "data" => '', "statusCode" => 200);
        }
        catch(PDOException $error){

            return array("status" => 'error', "message" => 'Ha habido una excepcion.', "data" => $error->errorInfo, "statusCode" => 400);
        }
    }
}