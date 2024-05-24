<?= view('commons/head'); ?>
<header>
    <div class="form-row">

        <div class="form-group col-md-4"><br>
            <a href="<?= base_url() ?>"><img src="<?= base_url() ?>/public/img/return.png" class="imagen" alt="..." width="30">
            </a>
        </div>
        <div class="form-group col-md-4">
            <h3 class="titulo">Clientes</h3>
        </div>
        <div class="form-group col-md-4">

        </div>
    </div>
</header>

<body>

    <div><!-- contenedor principal-->
        <div class="container">
            <form class="form-clientes" method="POST">
                <div class="form-row">
                    <!-- -->
                    <input type="number" id="id_cliente" name="id_cliente" hidden>
                    <!-- -->
                    <div class="form-group col-md-4">
                        <label for="inputEmail4">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre del cliente" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputPassword4">Apellido</label>
                        <input type="text" class="form-control" id="apellido" name="apellido" placeholder="Apellido del cliente" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputAddress">Direccion</label>
                        <input type="text" class="form-control" id="direccion" name="direccion" placeholder="1234 Main St" required>
                    </div>
                </div>


                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="date">Fecha nacimiento</label>
                        <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" placeholder=" ">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="telefono">Telefono</label>
                        <input type="text" class="form-control" id="telefono" name="telefono" placeholder="+(503) 7777-5555" required>
                    </div>

                    <div class="form-group col-md-3">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="emaildelcliente@email.com" required>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="inputState">Categoria</label>
                        <select id="categoria" class="form-control" name="categoria" required>
                            <option>Selecciona...</option>
                            <option value="1" selected>Uno</option>
                            <option value="2">Dos</option>
                            <option value="3">Tres</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <button type="submit" class="btn btn-primary" id="guardarbtn">Guardar</button>
                    </div>
                </div>
            </form>
            <div class="form-row">
                <div class="form-group col-md-3">
                    <button type="" class="btn  btn-outline-warning" id="actualizarbtn">Actualizar</button>
                </div>
                <div class="form-group col-md-3">
                    <button type="" class="btn  btn-outline-danger" id="eliminarbtn">Eliminar</button>
                </div>
            </div>


            <br>
            <h4>Clientes registrados</h4>
            <h6>Da click sobre la fila que desees editar</h6>
            <br>
            <!--tabla -->
            <table class="table table-striped table-dark" id="clientTable">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Apellido</th>
                        <th scope="col">Direccion</th>
                        <th scope="col">fecha Nacimiento</th>
                        <th scope="col">Telefono</th>
                        <th scope="col">Email</th>
                        <th scope="col">Categoria</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>

                    </tr>

                </tbody>
            </table>
        </div>

    </div>
    <?= view('commons/footer'); ?>
    <!--verificando el estado del form -->
    <script>
        $(window).on('load', function() {
            if ($('#id_cliente').val() == '') {
                console.log(" no existe un identidicador, no hay registro a editar");
                $('#actualizarbtn').prop('disabled', true);
                $('#eliminarbtn').prop('disabled', true);
            }
        });
    </script>
    <!--Leyendo informacion de la base de datos -->
    <script>
        $(document).ready(function() {
            $.ajax({
                    url: base_url + 'Cliente/readClient',
                    type: 'POST',
                    dataType: 'json',
                })
                .done(function(data) {
                    if (data.code == 200) {
                        console.log("success", data.msj.success);
                        // location.reload();
                        $.each(data.data, function(idx, opt) {
                            $('#clientTable').append('<tr><td>' + opt.id_cliente + '</td><td>' + opt.nombre + '</td><td>' + opt.apellido + '</td><td>' + opt.direccion + '</td><td>' + opt.fecha_nacimiento + '</td><td>' + opt.telefono + '</td><td>' + opt.email + '</td><td>' + opt.id_categoria);
                        });
                    } else {
                        console.log("error", data.msj.error + " code=" + data.code);
                    }
                })
                .fail(function() {
                    console.log("Error, no se pudieron mostrar los datos");
                });

            return false;


        });
    </script>
    <!--Manipulando los registros de la tabla -->
    <script>
        $('#clientTable').on('click', 'tr', function() {
            var fila = $(this);
            var id_cliente = fila.find('td:eq(0)').text();
            var nombre = fila.find('td:eq(1)').text();
            var apellido = fila.find('td:eq(2)').text();
            var direccion = fila.find('td:eq(3)').text();
            var fecha_nacimiento = fila.find('td:eq(4)').text();
            var telefono = fila.find('td:eq(5)').text();
            var email = fila.find('td:eq(6)').text();
            var id_categoria = fila.find('td:eq(7)').text();

            $('#id_cliente').val(id_cliente);
            $('#nombre').val(nombre);
            $('#apellido').val(apellido);
            $('#direccion').val(direccion);
            $('#fecha_nacimiento').val(fecha_nacimiento);
            $('#telefono').val(telefono);
            $('#email').val(email);
            $('#categoria').val(id_categoria);

            $('#actualizarbtn').prop('disabled', false);
            $('#eliminarbtn').prop('disabled', false);
            $('#guardarbtn').prop('disabled', true);

        });
    </script>
    <!-- Creando nuevo cliente-->
    <script>
        $(".form-clientes").submit(function() {
            $.ajax({
                    url: base_url + 'Cliente/registro',
                    type: 'POST',
                    dataType: 'json',
                    data: $(this).serialize(),

                })
                .done(function(data) {
                    console.log(data);
                    if (data.code == 200) {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Clientea almacenados con exito',
                            showConfirmButton: false,
                            timer: 1500

                        });
                        location.reload();
                        // location.href=data.msj.redirect
                    } else {
                        console.log("error", data.msj.error + " code=" + data.code);
                        Swal.fire('No se pudieron almacemnar os datos')
                    }
                })
                .fail(function() {
                    alert_top("error", "Error, intente más tarde"); //este error se muestra si no existe conexion con el back
                });

            return false;

        });
    </script>
    <!-- Actualizando registros-->
    <script>
        $('#actualizarbtn').click(function() {
            //alert('Haz hecho clic en el botón actualizar!'+ identicador );
            var id_cliente = $('#id_cliente').val();
            console.log(id_cliente);

            //
            $.ajax({
                    url: base_url + 'Cliente/actualizar',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        id_cliente: $('#id_cliente').val(),
                        nombre: $('#nombre').val(),
                        apellido: $('#apellido').val(),
                        direccion: $('#direccion').val(),
                        fecha_nacimiento: $('#fecha_nacimiento').val(),
                        telefono: $('#telefono').val(),
                        email: $('#email').val(),
                        id_categoria: $('#categoria').val()
                    }

                })
                .done(function(data) {
                    console.log(data);
                    if (data.code == 200) {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Clientea Actualizados con exito',
                            showConfirmButton: false,
                            timer: 1500

                        });
                        location.reload();
                        // location.href=data.msj.redirect
                    } else {
                        console.log("error", data.msj.error + " code=" + data.code);
                        Swal.fire('No se pudieron almacemnar os datos')
                    }
                })
                .fail(function() {
                    Swal.fire('Opps al parecer tenemos un error al procesar los datos en el front')
                });

            return false;

        });
    </script>
    <!-- Eliminando registros-->
    <script>
        $('#eliminarbtn').click(function() {
            //alert('Haz hecho clic en el botón actualizar!'+ identicador );
            var id_cliente = $('#id_cliente').val();
            console.log(id_cliente);
            //
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: '¿Seguro de eliminar?',
                text: "!Esta accion no se puede revertir!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Si, borrar',
                cancelButtonText: 'No, cancelar!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    //
                    $.ajax({
                            url: base_url + 'Cliente/eliminar',
                            type: 'POST',
                            dataType: 'json',
                            data: {
                                id_cliente: $('#id_cliente').val()
                            }

                        })
                        .done(function(data) {
                            console.log(data);
                            if (data.code == 200) {
                                swalWithBootstrapButtons.fire(
                                    'Eliminado!',
                                    'El registro ha sido borrado de la existencia',
                                    'success'
                                )
                                location.reload();
                                // location.href=data.msj.redirect
                            } else {
                                console.log("error", data.msj.error + " code=" + data.code);
                                Swal.fire('No se pudieron elminar los datos, error del backend')
                            }
                        })
                        .fail(function() {
                            Swal.fire('Opps al parecer tenemos un error al procesar los datos en el front')
                        });
                    //

                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Cancelado',
                        'El registro esta seguro:)',
                        'error'
                    )
                }
            })
            //


            return false;


        });
    </script>