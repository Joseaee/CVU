<?php
/**
 * Renderiza un diseño utilizando los parámetros proporcionados.
 *
 * Esta función extrae las variables del arreglo `$params['variables']` y las hace accesibles dentro del alcance de la función.
 * Luego, incluye el archivo de cabecera (`head.php`) y el contenido principal especificado en `$params['mainContent']`.
 * Si el archivo de contenido principal no existe, redirige a la URL de error especificada en `$params['errorUrl']`.
 * Finalmente, incluye el archivo de pie de página (`footer.php`).
 *
 * @param array $params Un arreglo asociativo que contiene los parámetros para renderizar el diseño.
 *                      - 'variables' (opcional): Un arreglo asociativo de variables para extraer en variables con el nombre de la key.
 * 						- 'title': El titulo de la pagina en la etiqueta title.	
 * 						- 'links': Los archivos css que iran linkeados a la vista. Ejemplo: [rel => 'stylesheet', href => '', attr => ''].
 * 						- 'navbar': Un valor booleano por si se necesita colocar el navbar.
 *                      - 'mainContent': La ruta al archivo de la vista que ira como contenido principal a incluir.
 *                      - 'errorUrl': La URL a redirigir en caso de que el archivo de contenido principal no exista.
 * 						- 'footer': Un valor booleano por si se necesita colocar el footer.
 * 						- 'scripts': Los archivos scripts que iran linkeados a la vista. Ejemplo: [type => 'module', src => ''].
 *
 * @return void
 */
function renderLayout(array $params) {
    if(isset($params['variables'])) extract($params['variables']);
    require_once 'src/component/head.php';

	if(isset($params['navbar'])) require_once 'src/component/navbar.php';

		if(file_exists($params['mainContent'])){
			include_once $params['mainContent'];
		} else{

			die('<script>window.location="?url='.$params['errorUrl'].'"</script>');
		}
    if(isset($params['footer'])) require_once 'src/component/footer.php';
    require_once 'src/component/scripts.php';
}