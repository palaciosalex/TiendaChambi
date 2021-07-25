<?php
    class formulario{
        protected function encabezadoShowInit($titulo){
            ?>
                <!DOCTYPE html>
                <html lang="es">
                <head>
                    <meta charset="UTF-8">
                    <meta http-equiv="X-UA-Compatible" content="IE=edge">
                    <!-- ICONO ALIANZA CAMPEON -->
                    <link rel="icon" href="https://upload.wikimedia.org/wikipedia/commons/thumb/1/16/Alianza_Lima.svg/1200px-Alianza_Lima.svg.png">
                    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
                    <!-- BOOTSTRAP -->
                    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
                    rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
                     crossorigin="anonymous">
                     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
                     <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
                    <!-- GOOGLE FONTS-->
                    <link rel="preconnect" href="https://fonts.googleapis.com">
                    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
                    <link href="https://fonts.googleapis.com/css2?family=Didact+Gothic&display=swap" rel="stylesheet">
                    <!-- ESTILOS CSS MIO-->
                    <link href="./styles/generales.css" type="text/css" rel="stylesheet" />
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title> <?php echo ucwords(strtolower($titulo)); ?></title>
                </head>
                <body style="font-family: 'Didact Gothic', sans-serif;">
                <table class="ADSLogin">
                    <tr>
                        <td><img src="./imagenes/banner.jpg" alt="" width="840" height="200"></td>
                    </tr>
                </table>
                <hr>
            <?php
        }
        protected function encabezadoShow($titulo){
            ?>
                <!DOCTYPE html>
                <html lang="es">
                <head>
                    <meta charset="UTF-8">
                    <meta http-equiv="X-UA-Compatible" content="IE=edge">
                    <!-- ICONO ALIANZA CAMPEON -->
                    <link rel="icon" href="https://upload.wikimedia.org/wikipedia/commons/thumb/1/16/Alianza_Lima.svg/1200px-Alianza_Lima.svg.png">
                    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
                    <!-- BOOTSTRAP -->
                    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
                    rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
                     crossorigin="anonymous">
                     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
                     <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
                    <!-- GOOGLE FONTS-->
                    <link rel="preconnect" href="https://fonts.googleapis.com">
                    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
                    <link href="https://fonts.googleapis.com/css2?family=Didact+Gothic&display=swap" rel="stylesheet">
                    <!-- ESTILOS CSS MIO-->
                    <link href="../styles/generales.css" type="text/css" rel="stylesheet" />
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title> <?php echo ucwords(strtolower($titulo)); ?></title> 
                </head>
                <body style="font-family: 'Didact Gothic', sans-serif;">
                <table class="ADSLogin">
                    <tr>
                        <td><img src="../imagenes/banner.jpg" alt="" width="840" height="200"></td>
                    </tr>
                </table>
                <hr>
            <?php
        }

        protected function encabezadoShowSimple($titulo){
            ?>
                <!DOCTYPE html>
                <html lang="es">
                <head>
                    <meta charset="UTF-8">
                    <meta http-equiv="X-UA-Compatible" content="IE=edge">
                    <!-- ICONO ALIANZA CAMPEON -->
                    <link rel="icon" href="https://upload.wikimedia.org/wikipedia/commons/thumb/1/16/Alianza_Lima.svg/1200px-Alianza_Lima.svg.png">
                    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
                    <!-- BOOTSTRAP -->
                    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
                    rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
                    crossorigin="anonymous">
                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
                    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
                    <!-- GOOGLE FONTS-->
                    <link rel="preconnect" href="https://fonts.googleapis.com">
                    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
                    <link href="https://fonts.googleapis.com/css2?family=Didact+Gothic&display=swap" rel="stylesheet">
                    <!-- ESTILOS CSS MIO-->
                    <link href="../styles/generales.css" type="text/css" rel="stylesheet" />
                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.17/dist/sweetalert2.all.min.js"></script>
                    <link rel="stylesheet"  href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title> <?php echo ucwords(strtolower($titulo)); ?></title> 
                </head>
                <body style="font-family: 'Didact Gothic', sans-serif;">
                    <h1 class="titulo-encabezado-simple"><?php echo ucwords(strtolower($titulo)); ?></h1>
                <hr>
            <?php
        }

        protected function piePaginaShow(){
            ?>
            <p></p>
            <p></p>
            <marquee behavior="" direction="">TIENDA CHAMBI 2021</marquee>
            <!--
                <p></p>
                <p></p>
                <div style="box-sizing: border-box;margin: 0; padding: 0;">
            <footer>
                <div class="LPfooter-content">
                    <h3>TIENDA CHAMBI</h3>
                    <p>LLEVATE LAS MEJORES BEBIDAS AL POR MAYOR A UN PRECIO MUY BAJO - CALIDAD ASEGURADA</p>
                    <ul class="LPsocials">
                        <li><a href="https://www.facebook.com/" target="_blank"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="https://www.instagram.com/" target="_blank"><i class="fa fa-instagram"></i></a></li>
                    </ul>
                </div>
                <div class="LPfooter-bottom">
                    <p>copyrigth &copy;2021 diseñado por <span> ADS TACZA</span></p>
                </div>
            </footer>
        </div>
        -->
                </body>
                </html>
            <?php
        }
    }
?>