<?php 

namespace Cvu\Content\Models;
use Cvu\Content\Config\Connect\connectDB as connectDB;
use \PDO;
use PDOException;

class SessionModel extends ConnectDB{

    private $conex;
    private $cedula;

    public function __construct(){

        parent::__construct();
        $this->conex = parent::activeDB();
    } 

    public function existeEstudiante($id){

        try{ 
            if(preg_match_all("/^[1-9]\d{6,7}$/", $id)){

                $existeEstudiante = $this->conex->prepare("SELECT e.cedula, e.nombre, e.apellido, e.rol FROM tblestudiante e WHERE e.cedula = ?");
                $existeEstudiante->bindValue(1, $id);
                $existeEstudiante->execute();

                $validarId = $existeEstudiante->fetchAll(PDO::FETCH_ASSOC);

                if(isset($validarId[0])){

                    $this->cedula = $id;

                    return array("respuesta" => true);
                }
                else{

                    return array("error" => "No existe el estudiante en los registros.");
                }
            }
            else{

                return array("error" => "La cedula ingresada no cumple con los parametros establecidos.");
            }
        }
        catch(PDOException $error){

            return array("errorInfo" => $error->errorInfo);
        }
    }
}