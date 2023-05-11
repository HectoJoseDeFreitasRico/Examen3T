<?php include "conexiondb.php";?>
<!doctype html>
<html lang="en">
  <head>
      <script src="https://kit.fontawesome.com/de042286d7.js" crossorigin="anonymous"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v4.1.1">
    <title>Dashboard Template · Bootstrap</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/dashboard/">
<script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
    <!-- Bootstrap core CSS -->
<link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
    <!-- Custom styles for this template -->
    <link href="dashboard.css" rel="stylesheet">
  </head>
  <body>
    <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="#">Company name</a>
  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-toggle="collapse" data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
  <ul class="navbar-nav px-3">
    <li class="nav-item text-nowrap">
      <a class="nav-link" href="#">Sign out</a>
    </li>
  </ul>
</nav>

<div class="container-fluid">
  <div class="row">
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="sidebar-sticky pt-3">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link active" href="#">
              <span data-feather="home"></span>
              Escritorio <span class="sr-only">(current)</span>
            </a>
          </li>
          <?php
            
            $resultado = mysqli_query($enlace, "

                SHOW TABLES");

                while($fila = $resultado->fetch_assoc()){
                    echo'
                        <li class="nav-item">
                            <a class="nav-link" href="?tabla='.$fila['Tables_in_examenmarcas'].'">
                            <span data-feather="file"></span>
                            '.$fila['Tables_in_examenmarcas'].'
                            </a>
                        </li>';
            }


?>
          
          
        </ul>

        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
          <span>Informes guardados</span>
          <a class="d-flex align-items-center text-muted" href="#" aria-label="Add a new report">
            <span data-feather="plus-circle"></span>
          </a>
        </h6>
        <ul class="nav flex-column mb-2">
          <?php
            
            $resultado = mysqli_query($enlace, "

                SHOW FULL TABLES IN examenmarcas WHERE TABLE_TYPE LIKE 'VIEW'");

                while($fila = $resultado->fetch_assoc()){
                    echo'
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                            <span data-feather="file-text"></span>
                            '.$fila['Tables_in_examenmarcas'].'
                            </a>
                        </li>';
            }


?>
        </ul>
      </div>
    </nav>

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group mr-2">
            <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
            <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
          </div>
          <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
            <span data-feather="calendar"></span>
            This week
          </button>
        </div>
      </div>

      <canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas>

      <h2>Section title</h2>
      <div class="table-responsive">
          <style>.table-responsive{overflow-x: visible !important}</style>
        <table class="table table-striped table-sm">
          <thead>
            <tr>
                <?php
                //mostramos columnas
                $peticion = "SHOW COLUMNS FROM ".$_GET['tabla'].";";
                $resultado = mysqli_query($enlace,$peticion);
                $contador = 0;
                $cabeceras;

                while($fila = $resultado->fetch_assoc()){
                    $cabeceras[$contador] = $fila['Field'];
                    echo'
                        <th>'.$fila['Field'].'</th>';
                    $contador++;
            }


?>
                <th>Ver</th>
                <th>Actualizar</th>
                <th>Eliminar</th>
            </tr>
          </thead>
          <tbody>
            <?php
                $peticion = "SELECT * FROM ".$_GET['tabla'].";";
                $resultado = mysqli_query($enlace,$peticion);
              
                while($fila = $resultado->fetch_array()){
                    echo '<tr>'; // Arranca la fila
                    $contador = 0;
                    for($i = 0;$i<count($fila)/2;$i++){
                        if (isset($fila[$i])) {
                            echo '<td cabecera="'.$cabeceras[$contador].'"identificador='.$fila[0].'>'.$fila[$i].'</td>'; //Dame las columnas de la fila
                            $contador++;
                        } else {
                            echo '<td></td>'; // Si la clave no existe, imprimir una celda vacía
                        }
                    }
                    echo '
                    <td><a href="ver.php?tabla='.$_GET['tabla'].'&id='.$fila[0].'"><i class="fa-solid fa-eye"></i></a></td>
                    <td><a href="actualizar.php?tabla='.$_GET['tabla'].'&id='.$fila[0].'"><i class="fa-solid fa-arrows-rotate"></i></a></td>
                    <td><a href="eliminar.php?tabla='.$_GET['tabla'].'&id='.$fila[0].'"><i class="fa-solid fa-delete-left"></i></a></td>';
                    echo '</tr>'; //Cierra la fila
            }


?>
              
          </tbody>
        </table>
      </div>
        <div id="ajax"></div>
        <div class="modal" tabindex="-1" role="dialog" id="myModal">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>Modal body text goes here.</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary">Save changes</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
        
        <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">aYUDA</button>
        
    </main>
  </div>
</div>
      <!--
Actualizar los datos
-->
      <script>window.jQuery || document.write('<script src="../assets/js/vendor/jquery.slim.min.js"><\/script>')</script><script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.9.0/feather.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
        <script src="dashboard.js"></script>
    <script>
        var tabla = '<?php echo $_GET['tabla']?>'
        $("td").dblclick(function(){
            $(this).attr("contenteditable","true");
        })
        $("td").blur(function(){
            $(this).attr("contenteditable","false");
            console.log("ahora voy a meter esto en la base de datos")
            var valor = $(this).text()
            console.log("el nuevo valor de la celda es "+valor)
            var identificador = $(this).attr("identificador")
            console.log("el valor sobre el que voy a trabajar en la base de datos tiene el id "+identificador)
            var columna = $(this).attr("cabecera")
            console.log("la columna es "+columna)
            console.log("y la tabla es "+tabla)
            $("#ajax").load("ajax.php?valor="+valor+"&identificador="+identificador+"&columna="+columna+"&tabla="+tabla)
            alert("tu registro se metio en la base de datos")
            
        })
        
        
      </script>
    </body>
</html>
        
