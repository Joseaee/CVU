<?php 

namespace Cvu\Content\Models;
use Cvu\Content\Config\Connect\connectDB;
use Cvu\Content\helpers\expRegTrait;
use Cvu\Content\helpers\HttpResponseTrait;
use \PDO;
use PDOException;

class EleccionModel extends ConnectDB{

    use expRegTrait;
    use HttpResponseTrait;

    private $conex;
    private $codigoEleccion;
    private $nombreEleccion;
    private $fechaEleccion;

    public function __construct(){

        parent::__construct();
        $this->conex = parent::activeDB();
    } 

    /**
     * Consulta las elecciones activas en la base de datos.
     *
     * @return array Información de las elecciones activas, un mensaje si no hay elecciones,
     *               o información de error en caso de excepción.
     */
    public function consultarElecciones(){

        try{

            $consultarElecciones = $this->conex->prepare("SELECT * FROM tbleleccion e WHERE e.estado = 1");
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
     * Valida los valores de la eleccion.
     *
     * @return array Respuesta con éxito o error en la inserción.
     */
    public function validarEleccion($nombre, $fecha){

        if(!preg_match_all($this->expNombreEleccion, $nombre)){

            return array("status" => 'error', "message" => 'El nombre no es valido.', "data" => false, "statusCode" => 412);
        }

        date_default_timezone_set("America/Caracas");

        if(!preg_match_all($this->expFechas, $fecha) || (strtotime(date("Y-m-d")) > strtotime(date($fecha)))){

            return array("status" => 'error', "message" => 'La fecha no es valida.', "data" => false, "statusCode" => 412);
        }

        $consultarFechas = $this->conex->prepare("SELECT e.fecha FROM tbleleccion e WHERE e.estado = 1 AND e.codigo != ? ORDER BY e.fecha DESC;");
        $consultarFechas->bindValue(1, $this->codigoEleccion ?? '');
        $consultarFechas->execute();
        $respuesta = $consultarFechas->fetchAll(PDO::FETCH_COLUMN);

        foreach ($respuesta as $value){

            if(strtotime(date($value)) == strtotime(date($fecha))){

                return array("status" => 'error', "message" => 'Ya hay una eleccion planificada para la fecha de '.date("d-m-Y",  strtotime($value)).'.', "data" => false, "statusCode" => 412);
            }
        }

        $this->nombreEleccion = $nombre;
        $this->fechaEleccion = $fecha;

        return array("status" => 'success', "message" => 'Datos validos.', "data" => true, "statusCode" => 200);
    }

    /**
     *  Llama a la funcion de insertar eleccion.
     *
     * @return array Respuesta con éxito o error en la inserción.
     */
    public function getInsertarEleccion(){

        return $this->insertarEleccion();
    }

    /**
     * Inserta una nueva eleccion en la base de datos.
     *
     * @return array Respuesta con éxito o error en la inserción.
     */
    private function insertarEleccion(){

        try{
            $this->conex->beginTransaction();

            $this->codigoEleccion =   date('Ymdhi', time()).'eleccion:'.rand(100,999);

            $insertarEleccion = $this->conex->prepare("INSERT INTO tbleleccion (codigo, nombre, fecha) VALUES (?, ?, ?)");
            $insertarEleccion->bindValue(1, $this->codigoEleccion);
            $insertarEleccion->bindValue(2, $this->nombreEleccion);
            $insertarEleccion->bindValue(3, $this->fechaEleccion);
            $insertarEleccion->execute();

            $this->conex->commit();

            return array("status" => 'success', "message" => 'Registro exitoso', "data" => '', "statusCode" => 200);
        }
        catch(PDOException $error){

            $this->conex->rollBack();
            return array("status" => 'error', "message" => 'Ha habido una excepcion.', "data" => $error->errorInfo, "statusCode" => 400);
        }
    }

    /**
     * Verifica si la eleccion existe en la base de datos y está activa.
     *
     * @param string $id El identificador de la eleccion.
     * 
     * @return array Información sobre la existencia de la eleccion y si tiene asientos, 
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
     * Consulta los detalles de la eleccion seleccionada.
     *
     * @return array Detalles de la eleccion.
     */
    public function consultarEleccionSeleccionada(){

        try{

            $consultarEleccion = $this->conex->prepare("SELECT * FROM tbleleccion e WHERE e.codigo = ? AND e.estado = 1;");
            $consultarEleccion->bindValue(1, $this->codigoEleccion);
            $consultarEleccion->execute();
            $respuesta = $consultarEleccion->fetch(PDO::FETCH_ASSOC);  

            return array("status" => 'success', "message" => 'Se consulto la eleccion'. $this->codigoEleccion.'.', "data" => $respuesta, "statusCode" => 200);
        }
        catch(PDOException $error){

            return array("status" => 'error', "message" => 'Ha habido una excepcion.', "data" => $error->errorInfo, "statusCode" => 400);
        }
    }

    /**
     * Llama a la funcion de actualizar eleccion.
     *
     * @return array Respuesta con éxito o error en la actualización.
     */
    public function getActualizarEleccion(){

        return $this->actualizarEleccion();
    }

    /**
     * Actualiza una eleccion en la base de datos.
     *
     * @return array Respuesta con éxito o error en la actualización.
     */
    private function actualizarEleccion(){

        try{

            $this->conex->beginTransaction();

            $actualizarEleccion = $this->conex->prepare("UPDATE tbleleccion e SET e.nombre = ?, e.fecha = ? WHERE e.codigo = ? AND e.estado = 1;");
            $actualizarEleccion->bindValue(1, $this->nombreEleccion);
            $actualizarEleccion->bindValue(2, $this->fechaEleccion);
            $actualizarEleccion->bindValue(3, $this->codigoEleccion);
            $actualizarEleccion->execute();

            $this->conex->commit();

            return array("status" => 'success', "message" => 'La eleccion del codigo'.$this->codigoEleccion.' fue actulizada exitosamente', "data" => '', "statusCode" => 200);
        }
        catch(PDOException $error){

            $this->conex->rollBack();
            return array("status" => 'error', "message" => 'Ha habido una excepcion.', "data" => $error->errorInfo, "statusCode" => 400);
        }
    }

    /**
     * Llama a la funcion de eliminar eleccion.
     *
     * @return array Respuesta con éxito o error en la eliminación.
     */
    public function getEliminarEleccion(){

        return $this->eliminarEleccion();
    }

    /**
     * Elimina logicamente una Eleccion en la base de datos.
     *
     * @return array Respuesta con éxito o error en la eliminación.
     */
    private function eliminarEleccion(){

        try{

            $consultarEleccion = $this->conex->prepare("SELECT * FROM tbleleccion e WHERE e.codigo = ? AND e.estado = 1;");
            $consultarEleccion->bindValue(1, $this->codigoEleccion);
            $consultarEleccion->execute();
            $respuesta = $consultarEleccion->fetch(PDO::FETCH_ASSOC);

            if(!$respuesta){

                return array("status" => 'error', "message" => 'La elección no pudo ser borrada porque ya fue iniciada o ya finalizo.', "data" => false, "statusCode" => 404);
            }

            $eliminarEleccion = $this->conex->prepare("UPDATE tbleleccion e SET e.estado = 0 WHERE e.codigo = ? AND e.estado = 1;");
            $eliminarEleccion->bindValue(1, $this->codigoEleccion); 
            $eliminarEleccion->execute(); 

            return array("status" => 'success', "message" => 'La eleccion del codigo'.$this->codigoEleccion.' fue eliminada exitosamente', "data" => '', "statusCode" => 200);
        }
        catch(PDOException $error){

            return array("status" => 'error', "message" => 'Ha habido una excepcion.', "data" => $error->errorInfo, "statusCode" => 400);
        }
    }
}