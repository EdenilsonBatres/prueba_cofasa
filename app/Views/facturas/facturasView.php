<?= view('commons/head'); ?>
<header>
<div class="form-row">

        <div class="form-group col-md-4"><br>
            <a href="<?= base_url() ?>"><img src="<?= base_url() ?>/public/img/return.png" class="imagen" alt="..." width="30">
            </a>
        </div>
        <div class="form-group col-md-4">
            <h3 class="titulo">Facturas</h3>
        </div>
        <div class="form-group col-md-4">

        </div>
    </div>
</header>

<body>

    <div><!-- contenedor principal-->
        <div class="container">
            <form class="form-facturas" method="POST">
                <div class="form-row">
                    <!-- -->
                    <input type="number" id="id_factura" name="id_factura" hidden>
                    <!-- -->
                    <div class="form-group col-md-4">
                        <label for="inputState">Clientes</label>
                        <select id="clientes" class="form-control" name="clientes" required>
                            <option>Selecciona...</option>
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputPassword4">Fecha</label>
                        <input type="date" class="form-control" id="fecha" name="fecha" placeholder=" ">
                    </div>
                    <div class="form-group col-md-4">
                    <label for="inputPassword4"></label>
                        <button type="submit" class="btn btn-primary btn-block" id="guardarbtn">Generar Factura</button>
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
            <h4>Facturas Generadas</h4>
            <h6>Da click sobre la fila que desees editar</h6>
            <br>
            <!--tabla -->
            <table class="table table-striped table-dark" id="facturasTable">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">id_cliente</th>
                        <th scope="col">Cliente</th>
                        <th scope="col">Fecha</th>
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
    <!-- cargando selector-->
    <script>
        $(document).ready(function() {
            $.ajax({
                    url: base_url + 'Factura/cargandoClientes',
                    type: 'POST',
                    dataType: 'json',
                })
                .done(function(data) {
                    if (data.code == 200) {
                        console.log("success", data.msj);
                        // location.reload();
                       // console.log(data);
                        $.each(data.data, function(idx, opt) {
                            $('#clientes').append('<option value="' + opt.id_cliente + '">' + opt.nombre + '</option>');    
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
    <!--verificando el estado del form -->
      <script>
        $(window).on('load', function() {
            if ($('#id_factura').val() == '') {
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
                    url: base_url + 'Factura/readFactura',
                    type: 'POST',
                    dataType: 'json',
                })
                .done(function(data) {
                    if (data.code == 200) {
                        console.log("success", data.msj.success);
                        // location.reload();
                        $.each(data.data, function(idx, opt) {
                            $('#facturasTable').append('<tr><td>' + opt.num_factura + '</td><td>' + opt.id_cliente + '</td><td>' + opt.nombre + '</td><td>' + opt.fecha );
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
        $('#facturasTable').on('click', 'tr', function() {
            var fila = $(this);
            var id_factura = fila.find('td:eq(0)').text();
            var id_cliente = fila.find('td:eq(1)').text();
            var fecha = fila.find('td:eq(3)').text();
            

            $('#id_factura').val(id_factura);
            $('#clientes').val(id_cliente);
            $('#fecha').val(fecha);
           
            $('#actualizarbtn').prop('disabled', false);
            $('#eliminarbtn').prop('disabled', false);
            $('#guardarbtn').prop('disabled', true);

        });
    </script>  
    <!-- Creando nuevo factura-->
    <script>
        $(".form-facturas").submit(function() {
            $.ajax({
                    url: base_url + 'Factura/registro',
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
                            title: 'Factura almacenadas con exito',
                            showConfirmButton: false,
                            timer: 1500

                        });
                        location.reload();
                        // location.href=data.msj.redirect
                    } else {
                        console.log("error", data.msj.error + " code=" + data.code);
                        Swal.fire('No se pudieron almacemnar los datos')
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
            var id_factura = $('#id_factura').val();
            console.log(id_factura);

            //
            $.ajax({
                    url: base_url + 'Factura/actualizar',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        id_factura: $('#id_factura').val(),
                        id_cliente: $('#clientes').val(),
                        fecha: $('#fecha').val()
                    }

                })
                .done(function(data) {
                    console.log(data);
                    if (data.code == 200) {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Factura Actualizada con exito',
                            showConfirmButton: false,
                            timer: 1500

                        });
                        location.reload();
                        // location.href=data.msj.redirect
                    } else {
                        console.log("error", data.msj.error + " code=" + data.code);
                        Swal.fire('No se pudieron almacenar las facturas')
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
            var id_factura = $('#id_factura').val();
            console.log(id_factura);
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
                            url: base_url + 'Factura/eliminar',
                            type: 'POST',
                            dataType: 'json',
                            data: {
                                id_factura: $('#id_factura').val()
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