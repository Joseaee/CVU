<?php 

namespace Cvu\Content\Models;
use Cvu\Content\Config\Connect\connectDB;
use Cvu\Content\helpers\expRegTrait;
use Cvu\Content\helpers\HttpResponseTrait;
use \PDO;
use PDOException;

class CentroVotacionModel extends ConnectDB{

    use expRegTrait;
    use HttpResponseTrait;

    private $conex;
    private $codigoCentroVotacion;
    private $nombreCentroVotacion;
    private $presidenteCentroVotacion;
    private $secretarioCentroVotacion;
    private $lugarCentroVotacion;
    private $codigoDetallesEleccion;

    public function __construct(){

        parent::__construct();
        $this->conex = parent::activeDB();
    } 

    /**
     * Consulta centros de votacion activos en la base de datos.
     *
     * @return array Información de los centros de votacion activos, un mensaje si no hay centros de votacion,
     *               o información de error en caso de excepción.
     */
    public function consultarCentrosVotacion(){

        try{

            $consultarCentrosVotacion = $this->conex->prepare("SELECT * FROM tblcentrovotacion cv WHERE cv.estado = 1");
            $consultarCentrosVotacion->execute();
            $respuesta = $consultarCentrosVotacion->fetchAll(PDO::FETCH_ASSOC);

            if(count($respuesta) == 0){

                return array("status" => 'error', "message" => 'No hay centros de votacion registrados.', "data" => '', "statusCode" => 404);
            }

            return array("status" => 'success', "message" => 'Hay centros de votacion registradas.', "data" => $respuesta, "statusCode" => 200);
        }
        catch(PDOException $error){

            return array("status" => 'error', "message" => 'Ha habido una excepcion.', "data" => $error->errorInfo, "statusCode" => 400);
        }
    }


    /**
     * Consulta los detalles de las elecciones activas en la base de datos.
     *
     * @return array Información de los detalles de las elecciones activas, un mensaje si no hay detalles de las elecciones,
     *               o información de error en caso de excepción.
     */
    public function consultarDetallesElecciones(){

        try{

            $consultarDetallesElecciones = $this->conex->prepare("SELECT * FROM tbldetalleeleccion de WHERE de.estado = 1");
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

                return array("status" => 'error', "message" => 'El codigo de detalles de elección no es valido.', "data" => false, "statusCode" => 412);
            }
        }
        catch(PDOException $error){

            return array("status" => 'error', "message" => 'Ha habido una excepcion.', "data" => $error->errorInfo, "statusCode" => 400);
        }
    }

    /**
     * Valida los valores del centro de votacion.
     *
     * @return array Respuesta con éxito o error en la inserción.
     */
    public function validarCentroVotacion($nombre, $presidente, $secretario, $lugar){

        if(!preg_match_all($this->expNombreCentroVotacion, $nombre)){

            return array("status" => 'error', "message" => 'El nombre no es valido.', "data" => false, "statusCode" => 412);
        }

        if(!preg_match_all(rtrim($this->expLetras, '/').'{1,45}$/', $presidente)){

            return array("status" => 'error', "message" => 'El presidente no es valido.', "data" => false, "statusCode" => 412);
        }

        if(!preg_match_all(rtrim($this->expLetras, '/').'{1,45}$/', $secretario)){

            return array("status" => 'error', "message" => 'El secretario no es valido.', "data" => false, "statusCode" => 412);
        }

        if(!preg_match_all(rtrim($this->expLetras, '/').'{1,45}$/', $lugar)){

            return array("status" => 'error', "message" => 'El lugar no es valido.', "data" => false, "statusCode" => 412);
        }

        $this->nombreCentroVotacion = $nombre;
        $this->presidenteCentroVotacion = $presidente;
        $this->secretarioCentroVotacion = $secretario;
        $this->lugarCentroVotacion = $lugar;

        return array("status" => 'success', "message" => 'Datos validos.', "data" => true, "statusCode" => 200);
    }

    /**
     *  Llama a la funcion de insertar centro de votacion.
     *
     * @return array Respuesta con éxito o error en la inserción.
     */
    public function getInsertarCentroVotacion(){

        return $this->insertarCentroVotacion();
    }

    /**
     * Inserta un nuevo centro de votacion en la base de datos.
     *
     * @return array Respuesta con éxito o error en la inserción.
     */
    private function insertarCentroVotacion(){

        try{

            $this->conex->beginTransaction();

            $this->codigoCentroVotacion =   date('YmdHis', time()).'cv:'.rand(100,999);

            $insertarCentroVotacion = $this->conex->prepare("INSERT INTO tblcentrovotacion (codigo, nombre, presidente, secretario, lugar, idEleccion) VALUES (?, ?, ?, ?, ?, ?)");
            $insertarCentroVotacion->bindValue(1, $this->codigoCentroVotacion);
            $insertarCentroVotacion->bindValue(2, $this->nombreCentroVotacion);
            $insertarCentroVotacion->bindValue(3, $this->presidenteCentroVotacion);
            $insertarCentroVotacion->bindValue(4, $this->secretarioCentroVotacion);
            $insertarCentroVotacion->bindValue(5, $this->lugarCentroVotacion);
            $insertarCentroVotacion->bindValue(6, $this->codigoDetallesEleccion);
            $insertarCentroVotacion->execute();

            $this->conex->commit();

            return array("status" => 'success', "message" => 'Registro exitoso', "data" => '', "statusCode" => 200);
        }
        catch(PDOException $error){

            $this->conex->rollBack();
            return array("status" => 'error', "message" => 'Ha habido una excepcion.', "data" => $error->errorInfo, "statusCode" => 400);
        }
    }

    /**
     * Verifica si el centro de votacion existe en la base de datos y está activa.
     *
     * @param string $id El identificador del centro de votacion.
     * 
     * @return array Información sobre la existencia del centro de votacion, 
     *               o mensajes de error si no existe o si el ID no es válido, 
     *               o información de error en caso de excepción.
     */
    public function existeCentroVotacion($id){

        try{ 

            if(preg_match_all($this->expCodigoCentroVotacion, $id)){

                $consultarCentroVotacion = $this->conex->prepare("SELECT * FROM tblcentrovotacion cv WHERE cv.codigo = ? AND cv.estado = 1;");
                $consultarCentroVotacion->bindValue(1, $id);
                $consultarCentroVotacion->execute();
                $respuesta = $consultarCentroVotacion->fetch(PDO::FETCH_ASSOC);

                if($respuesta == ''){

                    return array("status" => 'error', "message" => 'El centro de votacion seleccionado no existe.', "data" => false, "statusCode" => 404);
                }

                $this->codigoCentroVotacion = $id;

                return array("status" => 'success', "message" => 'El centro de votacion seleccionado es valido y existe.', "data" => true, "statusCode" => 200);
            }
            else{

                return array("status" => 'error', "message" => 'El codigo del centro de votacion no es valido.aa', "data" => false, "statusCode" => 412);
            }
        }
        catch(PDOException $error){

            return array("status" => 'error', "message" => 'Ha habido una excepcion.', "data" => $error->errorInfo, "statusCode" => 400);
        }
    }

    /**
     * Consulta el centro de votacion seleccionado.
     *
     * @return array Detalles del centro de votacion.
     */
    public function consultarCentroVotacionSeleccionado(){

        try{

            $consultarCentroVotacion = $this->conex->prepare("SELECT * FROM tblcentrovotacion cv WHERE cv.codigo = ? AND cv.estado = 1;");
            $consultarCentroVotacion->bindValue(1, $this->codigoCentroVotacion);
            $consultarCentroVotacion->execute();
            $respuesta = $consultarCentroVotacion->fetch(PDO::FETCH_ASSOC);  

            return array("status" => 'success', "message" => 'Se consulto el centro de votacion.'. $this->codigoCentroVotacion.'.', "data" => $respuesta, "statusCode" => 200);
        }
        catch(PDOException $error){

            return array("status" => 'error', "message" => 'Ha habido una excepcion.', "data" => $error->errorInfo, "statusCode" => 400);
        }
    }

    /**
     * Llama a la funcion de actualizar centro de votacion.
     *
     * @return array Respuesta con éxito o error en la actualización.
     */
    public function getActualizarCentroVotacion(){

        return $this->actualizarCentroVotacion();
    }

    /**
     * Actualiza un centro de votacion en la base de datos.
     *
     * @return array Respuesta con éxito o error en la actualización.
     */
    private function actualizarCentroVotacion(){

        try{

            $this->conex->beginTransaction();

            $actualizarCentroVotacion = $this->conex->prepare("UPDATE tblcentrovotacion cv SET cv.nombre = ?, cv.presidente = ?, cv.secretario = ?, cv.lugar = ?, cv.idEleccion = ? WHERE cv.codigo = ? AND cv.estado = 1;");
            $actualizarCentroVotacion->bindValue(1, $this->nombreCentroVotacion);
            $actualizarCentroVotacion->bindValue(2, $this->presidenteCentroVotacion);
            $actualizarCentroVotacion->bindValue(3, $this->secretarioCentroVotacion);
            $actualizarCentroVotacion->bindValue(4, $this->lugarCentroVotacion);
            $actualizarCentroVotacion->bindValue(5, $this->codigoDetallesEleccion);
            $actualizarCentroVotacion->bindValue(6, $this->codigoCentroVotacion);
            $actualizarCentroVotacion->execute();

            $this->conex->commit();

            return array("status" => 'success', "message" => 'El centro de votacion del codigo'.$this->codigoCentroVotacion.' fue actulizada exitosamente', "data" => '', "statusCode" => 200);
        }
        catch(PDOException $error){

            $this->conex->rollBack();
            return array("status" => 'error', "message" => 'Ha habido una excepcion.', "data" => $error->errorInfo, "statusCode" => 400);
        }
    }

    /**
     * Llama a la funcion de eliminar centro de votacion.
     *
     * @return array Respuesta con éxito o error en la eliminación.
     */
    public function getEliminarCentroVotacion(){

        return $this->eliminarCentroVotacion();
    }

    /**
     * Elimina logicamente un centro de votacion en la base de datos.
     *
     * @return array Respuesta con éxito o error en la eliminación.
     */
    private function eliminarCentroVotacion(){

        try{

            $consultarCentroVotacion = $this->conex->prepare("SELECT * FROM tblcentrovotacion cv WHERE cv.codigo = ? AND cv.estado = 1;");
            $consultarCentroVotacion->bindValue(1, $this->codigoCentroVotacion);
            $consultarCentroVotacion->execute();
            $respuesta = $consultarCentroVotacion->fetch(PDO::FETCH_ASSOC);

            if(!$respuesta){

                return array("status" => 'error', "message" => 'el centro de votacion no pudo ser borrada porque ya se iniciado la eleccion o ya finalizo.', "data" => false, "statusCode" => 404);
            }

            $eliminarCentroVotacion = $this->conex->prepare("UPDATE tblcentrovotacion cv SET cv.estado = 0 WHERE cv.codigo = ? AND cv.estado = 1;");
            $eliminarCentroVotacion->bindValue(1, $this->codigoCentroVotacion); 
            $eliminarCentroVotacion->execute(); 

            return array("status" => 'success', "message" => 'EL centro de votacion del codigo'.$this->codigoCentroVotacion.' fue eliminado exitosamente', "data" => '', "statusCode" => 200);
        }
        catch(PDOException $error){

            return array("status" => 'error', "message" => 'Ha habido una excepcion.', "data" => $error->errorInfo, "statusCode" => 400);
        }
    }
}