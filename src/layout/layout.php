<?php
function renderLayout(array $params) {
    if(isset($params['variables'])) extract($params['variables']);
    require_once 'src/component/head.php';
    
		if(file_exists($params['mainContent'])){

			include_once $params['mainContent'];
		} else{

			die('<script>window.location="?url='.$params['errorUrl'].'"</script>');
		}
    
    require_once 'src/component/footer.php';
}