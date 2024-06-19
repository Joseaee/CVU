<?php 

namespace Cvu\Content\helpers;

trait HttpResponseTrait {
    
    /**
     * Enviar una respuesta JSON.
     *
     * @param mixed $data
     * @param int $statusCode
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
     * @param string $message
     * @param int $statusCode
     */
    public function errorResponse($message, $statusCode = 400) {
        $this->jsonResponse('error', $message, $statusCode);
    }

    /**
     * Redirigir a una URL específica.
     *
     * @param string $url
     */
    public function redirect($url) {
        header('Location: ' . $url);
        die();
    }

    /**
     * Enviar una respuesta de texto plano.
     *
     * @param string $text
     * @param int $statusCode
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
     * @param string $html
     * @param int $statusCode
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
     * @param array $headers
     */
    public function setHeaders(array $headers) {
        foreach ($headers as $header => $value) {
            header("$header: $value");
        }
    }
}
