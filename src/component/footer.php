    
    </main>
    <script src="public/js/jquery.min.js"></script>
    <script src="public/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/sweetalert2.all.min.js"></script>
    <?php
        if(isset($params['scripts'])){
            
            foreach($params['scripts'] as $k){

                $type = $k['type'] ?? 'module';
                echo('<script src="'.$k['src'] .'" type="'.$type.'"></script>');
            }
        }
    ?>
</body>
</html>