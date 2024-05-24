<?= view('commons/head'); ?>
<header>
<div class="form-row">

        <div class="form-group col-md-4"><br>
            <a href="<?= base_url() ?>"><img src="<?= base_url() ?>/public/img/return.png" class="imagen" alt="..." width="30">
            </a>
        </div>
        <div class="form-group col-md-4">
            <h3 class="titulo">Productos</h3>
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
                    <input type="number" id="id_producto" name="id_producto" hidden>
                    <!-- -->
                    <div class="form-group col-md-4">
                        <label for="inputEmail4">Nombre del producto</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Producto" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputPassword4">Precio</label>
                        <input type="number" class="form-control" id="precio" name="precio" step="0.01" min="0" placeholder="$">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputAddress">Stock</label>
                        <input type="number" class="form-control" id="stock" name="stock" placeholder="1" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-3">
                        <button type="submit" class="btn btn-primary" id="guardarbtn">Almacenar</button>
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
            <h4>Productos registrados</h4>
            <h6>Da click sobre la fila que desees editar</h6>
            <br>
            <!--tabla -->
            <table class="table table-striped table-dark" id="productosTable">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Stock</th>
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
            if ($('#id_producto').val() == '') {
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
                    url: base_url + 'Producto/readProducto',
                    type: 'POST',
                    dataType: 'json',
                })
                .done(function(data) {
                    if (data.code == 200) {
                        console.log("success", data.msj.success);
                        // location.reload();
                        $.each(data.data, function(idx, opt) {
                            $('#productosTable').append('<tr><td>' + opt.id_producto + '</td><td>' + opt.nombre + '</td><td>' + opt.precio + '</td><td>' + opt.stock );
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
        $('#productosTable').on('click', 'tr', function() {
            var fila = $(this);
            var id_producto = fila.find('td:eq(0)').text();
            var nombre = fila.find('td:eq(1)').text();
            var precio = fila.find('td:eq(2)').text();
            var stock = fila.find('td:eq(3)').text();
            

            $('#id_producto').val(id_producto);
            $('#nombre').val(nombre);
            $('#precio').val(precio);
            $('#stock').val(stock);
           
            $('#actualizarbtn').prop('disabled', false);
            $('#eliminarbtn').prop('disabled', false);
            $('#guardarbtn').prop('disabled', true);

        });
    </script> 
    <!-- Creando nuevo producto-->
    <script>
        $(".form-clientes").submit(function() {
            if ($('#precio').val() < 600) {
                Swal.fire('No se puede almacemnar porque el costo es menor a $600');
            }else if($('#stock').val() < 1000 || $('#stock').val() > 100000){
                Swal.fire('No se puede almacemnar porque el stock excede el requerimiento');
            }
            else{
            $.ajax({
                    url: base_url + 'Producto/registro',
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

        }
        return false;

        });
    </script>
    <!-- Actualizando registros-->
     <script>
        $('#actualizarbtn').click(function() {
            //alert('Haz hecho clic en el botón actualizar!'+ identicador );
            var id_producto = $('#id_producto').val();
            console.log(id_producto);

            //
            $.ajax({
                    url: base_url + 'Producto/actualizar',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        id_producto: $('#id_producto').val(),
                        nombre: $('#nombre').val(),
                        precio: $('#precio').val(),
                        stock: $('#stock').val(),
                    }

                })
                .done(function(data) {
                    console.log(data);
                    if (data.code == 200) {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Producto Actualizados con exito',
                            showConfirmButton: false,
                            timer: 1500

                        });
                        location.reload();
                        // location.href=data.msj.redirect
                    } else {
                        console.log("error", data.msj.error + " code=" + data.code);
                        Swal.fire('No se pudieron almacemnar los productos')
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
            var id_producto = $('#id_producto').val();
            console.log(id_producto);
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
                            url: base_url + 'Producto/eliminar',
                            type: 'POST',
                            dataType: 'json',
                            data: {
                                id_producto: $('#id_producto').val()
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