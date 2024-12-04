<?php 

namespace Cvu\Content\helpers;

trait httpResponseTrait {
    
    /**
     * Enviar una respuesta JSON.
     *
     * Este método se utiliza para enviar una respuesta en formato JSON al cliente. 
     * Se puede especificar el estado de la respuesta (éxito o error), un mensaje descriptivo 
     * y cualquier dato adicional que se desee incluir. El código de estado HTTP también 
     * se puede personalizar, permitiendo al desarrollador indicar el resultado de la 
     * operación (por ejemplo, 200 para éxito, 404 para no encontrado, etc.).
     *
     * @param string $status Estado de la respuesta ('success' o 'error').
     * @param string $message Mensaje que describe la respuesta.
     * @param mixed $data Datos adicionales a incluir en la respuesta (opcional).
     * @param int $statusCode Código de estado HTTP a enviar (opcional, por defecto 200).
     */
    public function jsonResponse($status = 'success', $message, $data = [], $statusCode = 200) {
        header('Content-Type: application/json');
        http_response_code($statusCode);
        echo json_encode(['status'=> $status,'message'=> $message,'data'=> $data]);
        die();
    }

    /**
     * Enviar una respuesta de error.
     *
     * Este método facilita el envío de una respuesta de error al cliente, 
     * utilizando el método `jsonResponse`. Permite especificar un mensaje 
     * de error y un código de estado HTTP que indica el tipo de error 
     * (por ejemplo, 400 para una solicitud incorrecta o 500 para un error interno).
     *
     * @param string $message Mensaje que describe el error.
     * @param int $statusCode Código de estado HTTP a enviar (opcional, por defecto 400).
     */
    public function errorResponse($message, $statusCode = 400) {
        $this->jsonResponse('error', $message, $statusCode);
    }

    /**
     * Redirigir a una URL específica.
     *
     * Este método se utiliza para redirigir al cliente a una URL diferente. 
     * Es útil en situaciones donde se necesita enviar al usuario a otra 
     * página, como después de una operación exitosa o cuando se requiere 
     * que el usuario complete un paso adicional. Al finalizar la redirección, 
     * se detiene la ejecución del script.
     *
     * @param string $url URL a la que se redirigirá al cliente.
     */
    public function redirect($url) {
        header('Location: ' . $url);
        die();
    }

    /**
     * Enviar una respuesta de texto plano.
     *
     * Este método permite enviar una respuesta simple en formato de texto plano. 
     * Se puede utilizar para devolver mensajes o datos que no requieren un formato 
     * más complejo, como JSON o HTML. Al igual que otros métodos, se puede 
     * especificar un código de estado HTTP.
     *
     * @param string $text Texto que se enviará como respuesta.
     * @param int $statusCode Código de estado HTTP a enviar (opcional, por defecto 200).
     */
    public function textResponse($text, $statusCode = 200) {
        header('Content-Type: text/plain');
        http_response_code($statusCode);
        echo $text;
        die();
    }

    /**
     * Enviar una respuesta HTML.
     *
     * Este método se utiliza para enviar contenido HTML al cliente. 
     * Es útil cuando se necesita devolver una página web o un fragmento de 
     * HTML. Al igual que en otros métodos, se puede especificar un código 
     * de estado HTTP para indicar el resultado de la operación.
     *
     * @param string $html Contenido HTML que se enviará como respuesta.
     * @param int $statusCode Código de estado HTTP a enviar (opcional, por defecto 200).
     */
    public function htmlResponse($html, $statusCode = 200) {
        header('Content-Type: text/html');
        http_response_code($statusCode);
        echo $html;
        die();
    }

    /**
     * Establecer encabezados comunes.
     *
     * Este método permite establecer múltiples encabezados HTTP de manera 
     * eficiente. Se pasa un array asociativo donde las claves son los nombres 
     * de los encabezados y los valores son sus respectivos valores. Esto es útil 
     * para añadir encabezados personalizados, como tipos de contenido, 
     * políticas de caché, entre otros, antes de enviar la respuesta.
     *
     * @param array $headers Array asociativo de encabezados a establecer.
     */
    public function setHeaders(array $headers) {
        foreach ($headers as $header => $value) {
            header("$header: $value");
        }
    }
}
