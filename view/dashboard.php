<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/style.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/css/select2.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/js/all.min.js"></script>
    <script src="<?php echo BASE_URL; ?>assets/js/jquery.min.js"></script>
    <script src="<?php echo BASE_URL; ?>assets/js/select2.min.js"></script>
    <script src="<?php echo BASE_URL; ?>assets/js/jquery.mask.min.js"></script>
    <script src="<?php echo BASE_URL; ?>assets/js/bootstrap.min.js"></script>
    <title>FlipFlop</title>
</head>

<body>
    <div class="container-fluid">
        <div class="sidebar col-md-2">
            <div class="sidebar-sticky d-flex flex-column align-items-center">
                
                <div class="avatar mt-2"></div>
                <h3 class="text-white mt-2"><?php echo $dados['nome']; ?></h3>
                <div class="white-bar mt-2"></div>
                <div class="menu-opt p-1 mt-2 w-100">
                    <a role="button" class="btn link text-decoration-none bg-transparent" href="<?php echo BASE_URL; ?>cadastrarVenda" data-toggle="collapse">
                            <i class="material-icons mr-1">home</i>Home
                        </a>
                    </div>
                    <div class="menu-opt p-1 mt-2 w-100">
                        <a class="btn  link text-decoration-none bg-transparent " href="#collapseVendas" data-toggle="collapse">
                            <i class="fa link fa-shopping-cart mr-2 "></i>Vendas
                        </a>
                        <div id="collapseVendas" class="collapse">
                            <div class="sub-menu-opt">
                            <a href="" class="link text-decoration-none p-1 sub-menu-opt">
                                <i class="fas fa-plus mr-2 "></i>Vendas
                            </a>
                            
                        </div>
                        <div class="sub-menu-opt"> 
                            <a href="" class="link text-decoration-none  p-1 sub-menu-opt mt-2">
                                <i class="fas fa-plus mr-2 "></i>Vendas
                            </a></div>
                        </div>
                    </div>
                </div>
        </div>
        <div class="offset-2 col-md-10">
            <?php $this->loadView($viewName, $params); ?>
        </div>
    </div>
    <script src="<?php echo BASE_URL; ?>assets/js/maskEalerts.js"></script>
    

</body>

</html>