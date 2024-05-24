<?= view('commons/head'); ?>
<?= view('commons/header'); ?>

<body>
    <div><!-- contenedor principal-->
        <div class="container">
            <div class="row">
                <div class="col">
                    
                </div>
                <div class="col-10">
                    <div class="contenedorCards"> <!--contenedor de las tarjetas -->
                        <!--card1 --> 
                        <div class="card" style="width: 18rem;">
                                <img src="<?= base_url() ?>/public/img/cliente.png" class="imagen"  alt="..." width="150">
                            <div class="card-body">
                                <h5 class="card-title  text-center">Clientes</h5>
                                <p class="card-text">CRUD de Clientes</p>
                                <a href="<?= base_url() ?>clientes" class="btn btn-danger imagen">ir a clientes</a>
                            </div>
                        </div>
                        <!--card2 -->
                        <div class="card" style="width: 18rem;">
                        <br>
                            <img src="<?= base_url() ?>/public/img/producto.png" class="imagen" alt="..." width="100">
                            <br>
                            <div class="card-body">
                                <h5 class="card-title  text-center">Productos</h5>
                                <p class="card-text">CRUD de Productos</p>
                                <a href="<?= base_url() ?>productos" class="btn btn-success imagen">ir a productos</a>
                            </div>
                        </div>
                        <!--card3 -->
                        <div class="card" style="width: 18rem;">
                        <br>
                            <img src="<?= base_url() ?>/public/img/factura.png" class="imagen" alt="..." width="100">
                            <br>
                            <div class="card-body">
                                <h5 class="card-title text-center">Facturas</h5>
                                <p class="card-text">CRUD de facturas</p>
                                <a href="<?= base_url() ?>facturas" class="btn btn-primary imagen">ir a facturas</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    
                </div>
            </div>
        </div>

    </div>

    <?= view('commons/footer'); ?>