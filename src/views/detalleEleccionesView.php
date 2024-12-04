<div class="contenedor__dashboard mt-4">
    <section class="content__dashboard">
        <section class="top__section row my-5">
            <div class="breadcrumb col-lg-11 col-md-8 col-sm-10 col-10 mt-5">
                <h1><i class='bx bxs-cog'></i> Gestionar Detalle de Elecciones</h1>
                <nav class="nav__breakcrumb">
                    <ul class="ul__breakcrumb">
                        <li class="li__breakcrumb">
                            <a href="#" class="link__breakcrumb"><i class='bx bxs-dashboard'></i> Panel de Control</a>
                        </li>
                        /
                        <li class="li__breakcrumb">
                            <a href="#" class="link__breakcrumb"><i class='bx bxs-detail'></i> Gestionar Detalle de Elecciones</a>
                        </li>
                    </ul>
                </nav>
            </div>

            <div class="tabla__modulo col-lg-11 col-md-8 col-sm-10 col-10">
                <div class="table-responsive">
                    <button class="btn__agregar float-end my-2 mx-1" title="Agregar" id="Agregar" data-bs-toggle="modal" data-bs-target="#exampleModalCenter">Agregar <i class='bx bx-plus-circle'></i></button>
                    <button class="btn__pdf float-end my-2 mx-1" title="Exportar PDF"><i class='bx bxs-file-pdf'></i>Exportar PDF</button>
                    <button class="btn__excel float-end my-2 mx-1" title="Importar EXCEL"><i class='bx bxs-file'></i>Importar Excel</button>
                    <table class="table mb-4">
                        <thead>
                            <tr class="header__titles">
                                <th>Periodo</th>
                                <th>Hora Apertura</th>
                                <th>Hora Cierre</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>2024-2025</td>
                                <td>8:00 AM</td>
                                <td>12:00 PM</td>
                                <td class="status1">Activo</td>
                                <td>
                                    <button class="btn__mas" title="Detalles"><i class='bx bx-search-alt'></i></button>
                                    <button class="btn__modificar" title="Editar"><i class='bx bxs-pencil'></i></button>
                                    <button class="btn__borrar" title="Borrar"><i class='bx bxs-trash'></i></button>
                                </td>
                            </tr>

                            <tr>
                                <td>2024-2025</td>
                                <td>9:00 AM</td>
                                <td>13:00 PM</td>
                                <td class="status0">Inactivo</td>
                                <td>
                                    <button class="btn__mas"><i class='bx bx-search-alt'></i></button>
                                    <button class="btn__modificar"><i class='bx bxs-pencil'></i></button>
                                    <button class="btn__borrar"><i class='bx bxs-trash'></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </section>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"><i class="bx bxs-detail"></i> Agregar Detalles de Eleccion</h5>
                <button type="button" class="btn__close" data-bs-dismiss="modal">
                    <i class='bx bx-x'></i>
                </button>
            </div>
            <div class="modal-body">

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input__icon"><i class='bx bx-barcode'></i></span>
                    </div>
                    <input type="text" placeholder="Codigo">
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input__icon"><i class='bx bx-calendar'></i></span>
                    </div>
                    <input type="date" placeholder="Periodo">
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input__icon"><i class='bx bx-time-five'></i></span>
                    </div>
                    <input type="time" placeholder="Hora de Apertura">
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input__icon"><i class='bx bx-time-five'></i></span>
                    </div>
                    <input type="time" placeholder="Hora de Cierre">
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input__icon"><i class='bx bx-select-multiple'></i></span>
                    </div>
                    <select name="select">
                        <option value="value1">Eleccion1</option>
                        <option value="value2">Eleccion2</option>
                    </select>
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input__icon"><i class='bx bxs-edit'></i></span>
                    </div>
                    <select name="select">
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