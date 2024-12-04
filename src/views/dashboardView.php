<div class="contenedor__dashboard">

    <?php
        require_once 'src/component/menu_lateral.php'
    ?>

    <section class="content__dashboard">
        <section class="top__section row">
            <div class="breadcrumb col-lg-10 col-md-8 col-sm-10 col-10">
                <h1><i class='bx bxs-dashboard'></i> Panel de Control</h1>
                <h4>¡Hola, Hendherson! <i class='bx bxs-hand'></i></h4>
            </div>

            <div class="slider__content">
                <button class="btn__slider active" id="btn_left"></button>
                <button class="btn__slider" id="btn_center"></button>
                <button class="btn__slider" id="btn_right"></button>
            </div>

            <div class="slider slider__left row">
                <a href="?url=estudiantes" class="modulo col-lg-5 col-md-5 col-sm-6 col-10">
                    <div class="modulo__icon">
                        <i class='bx bxs-graduation'></i>
                    </div>
                    <div class="modulo__info">
                        <h4>Estudiantes</h4>
                        <span>0</span>
                    </div>
                    <i class='modulo__icon__fondo bx bxs-graduation'></i>
                </a>

                <a href="?url=candidatos" class="modulo col-lg-5 col-md-5 col-sm-6 col-10">
                    <div class="modulo__icon">
                        <i class='bx bxs-group'></i>
                    </div>
                    <div class="modulo__info">
                        <h4>Candidatos</h4>
                        <span>0</span>
                    </div>
                    <i class='modulo__icon__fondo bx bxs-group'></i>
                </a>

                <a href="?url=resultados" class="modulo col-lg-5 col-md-5 col-sm-6 col-10">
                    <div class="modulo__icon">
                        <i class='bx bxs-pie-chart-alt-2'></i>
                    </div>
                    <div class="modulo__info">
                        <h4>Resultados</h4>
                        <span>0</span>
                    </div>
                    <i class='modulo__icon__fondo bx bxs-pie-chart-alt-2'></i>
                </a>

                <a href="?url=cartillaCandidatos" class="modulo_esp col-lg-5 col-md-5 col-sm-6 col-10">
                    <div class="modulo__icon">
                        <i class='bx bxs-archive-in'></i>
                    </div>
                    <div class="modulo__info">
                        <h4>Apertura de Elecciones</h4>
                        <span>0</span>
                    </div>
                    <i class='modulo__icon__fondo bx bxs-archive-in'></i>
                </a>
            </div>

            <!-- SLIDER CENTER ---------------------------  -->

            <div class="slider slider__center hidden row">
                <a href="?url=pnf" class="modulo col-lg-5 col-md-5 col-sm-6 col-10">
                    <div class="modulo__icon">
                        <i class='bx bx-book-content'></i>
                    </div>
                    <div class="modulo__info">
                        <h4>PNF</h4>
                        <span>0</span>
                    </div>
                    <i class='modulo__icon__fondo bx bx-book-content'></i>
                </a>

                <a href="?url=secciones" class="modulo col-lg-5 col-md-5 col-sm-6 col-10">
                    <div class="modulo__icon">
                        <i class='bx bx-intersect'></i>
                    </div>
                    <div class="modulo__info">
                        <h4>Secciones</h4>
                        <span>0</span>
                    </div>
                    <i class='modulo__icon__fondo bx bx-intersect'></i>
                </a>

                <a href="?url=centroVotacion" class="modulo col-lg-5 col-md-5 col-sm-6 col-10">
                    <div class="modulo__icon">
                        <i class='bx bx-printer'></i>
                    </div>
                    <div class="modulo__info">
                        <h4>Centro de Votación</h4>
                        <span>0</span>
                    </div>
                    <i class='modulo__icon__fondo bx bx-printer'></i>
                </a>

                <a href="?url=cartillaCandidatos" class="modulo_esp col-lg-5 col-md-5 col-sm-6 col-10">
                    <div class="modulo__icon">
                        <i class='bx bxs-archive-in'></i>
                    </div>
                    <div class="modulo__info">
                        <h4>Apertura de Elecciones</h4>
                        <span>0</span>
                    </div>
                    <i class='modulo__icon__fondo bx bxs-archive-in'></i>
                </a>
            </div>

            <!-- SLIDER RIGHT ---------------------------  -->

            <div class="slider slider__right hidden row">
                <a href="?url=mesaTrabajo" class="modulo col-lg-5 col-md-5 col-sm-6 col-10">
                    <div class="modulo__icon">
                        <i class='bx bx-camera-home'></i>
                    </div>
                    <div class="modulo__info">
                        <h4>Mesa de Trabajo</h4>
                        <span>0</span>
                    </div>
                    <i class='modulo__icon__fondo bx bx-camera-home'></i>
                </a>

                <a href="?url=elecciones" class="modulo col-lg-5 col-md-5 col-sm-6 col-10">
                    <div class="modulo__icon">
                        <i class='bx bx-select-multiple'></i>
                    </div>
                    <div class="modulo__info">
                        <h4>Elecciones</h4>
                        <span>0</span>
                    </div>
                    <i class='modulo__icon__fondo bx bx-select-multiple'></i>
                </a>

                <a href="?url=detallesEleccion" class="modulo col-lg-5 col-md-5 col-sm-6 col-10">
                    <div class="modulo__icon">
                        <i class='bx bx-detail'></i>
                    </div>
                    <div class="modulo__info">
                        <h4>Detalle Elecciones</h4>
                        <span>0</span>
                    </div>
                    <i class='modulo__icon__fondo bx bx-detail'></i>
                </a>

                <a href="?url=cartillaCandidatos" class="modulo_esp col-lg-5 col-md-5 col-sm-6 col-10">
                    <div class="modulo__icon">
                        <i class='bx bxs-archive-in'></i>
                    </div>
                    <div class="modulo__info">
                        <h4>Apertura de Elecciones</h4>
                        <span>0</span>
                    </div>
                    <i class='modulo__icon__fondo bx bxs-archive-in'></i>
                </a>
            </div>
        </section>
    </section>
</div>