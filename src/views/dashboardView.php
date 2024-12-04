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

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"><i class="bx bx-search-alt"></i> Elector</h5>
                <button type="button" class="btn__close" data-bs-dismiss="modal">
                    <i class='bx bx-x'></i>
                </button>
            </div>
            <div class="modal-body">

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input__icon"><i class='bx bx-barcode'></i></span>
                    </div>
                    <input type="text" placeholder="Cedula">
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input__icon"><i class="bx bx-user"></i></span>
                    </div>
                    <input type="text" placeholder="Nombre" disabled>
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input__icon"><i class="bx bx-group"></i></span>
                    </div>
                    <input type="text" placeholder="Apellido" disabled>
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input__icon"><i class="bx bx-book-content"></i></span>
                    </div>
                    <select name="select" disabled>
                        <option value="value1">PNF1</option>
                        <option value="value2">PNF2</option>
                    </select>
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input__icon"><i class="bx bx-printer"></i></span>
                    </div>
                    <select name="select" disabled>
                        <option value="value1">H15</option>
                        <option value="value2">H11</option>
                    </select>
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input__icon"><i class='bx bxs-edit'></i></span>
                    </div>
                    <select name="select" disabled>
                        <option value="value1">Activo</option>
                        <option value="value2">Inactivo</option>
                    </select>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-success" data-bs-dismiss="modal">Guardar</button>
            </div>
        </div>
    </div>
</div>