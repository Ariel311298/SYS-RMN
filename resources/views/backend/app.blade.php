<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title')</title>
  <link rel="icon" href="{!! asset('backend/dist/img/logo_institucion_educativa.png') !!}"/>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{asset('backend/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{asset('backend/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('backend/dist/css/adminlte.min.css')}}">  
  <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('backend/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('backend/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('backend/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="{{asset('backend/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">
  <!-- Toastr -->
  <link rel="stylesheet" href="{{asset('backend/plugins/toastr/toastr.min.css')}}">

  <style>
            .table-header-rotated {
            border-collapse: collapse;
            font-family: Cambria;

            .csstransforms & td {
                width: 30px;
            }

            .no-csstransforms & th {
                padding: 5px 10px;
            }

            td {
                text-align: center;
                padding: 10px 5px;
                font-size: 8;
                border: 1px solid black;
            }
 
            .csstransforms & th.rotate {
                height: 140px;
                white-space: nowrap;
                > div {
                    transform: 
                    translate(25px, 51px)
                    rotate(315deg);
                    width: 30px;
                }
        
                > div > span {
                    border-bottom: 1px solid black;
                    padding: 5px 10px;
                }
            }
        }
  </style>
</head>

<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">

  <!-- Navbar -->
  @include('backend.navbar')
  <!-- /.navbar -->
    
  <!-- Main Sidebar Container -->
  @include('backend.sidebar')  

  @yield('content')  
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <strong> 2023 &copy; Copyright by Unidad Educativa Enrique Malo Andrade.</strong>

    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.0.0
    </div>
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="{{asset('backend/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap -->
<script src="{{asset('backend/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{asset('backend/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>

<!-- AdminLTE App -->
<script src="{{asset('backend/dist/js/adminlte.js')}}"></script>
<!-- JavaScript -->
<script src="{{asset('js/app.js')}}"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="{{asset('backend/plugins/jquery-mousewheel/jquery.mousewheel.js')}}"></script>
<script src="{{asset('backend/plugins/raphael/raphael.min.js')}}"></script>
<script src="{{asset('backend/plugins/jquery-mapael/jquery.mapael.min.js')}}"></script>
<script src="{{asset('backend/plugins/jquery-mapael/maps/usa_states.min.js')}}"></script>
<!-- ChartJS -->
<script src="{{asset('backend/plugins/chart.js/Chart.min.js')}}"></script>
<!-- jsGrid -->
<script src="{{asset('backend/plugins/jsgrid/jsgrid.min.js')}}"></script>
<!-- bs-custom-file-input -->
<script src="{{asset('backend/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>

<!-- JavaScript -->
<script src="{{asset('js/app.js')}}"></script>

<!-- Script para borrar datos con Modal-->
<script>
  $('#delete-personal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); 
    var pers_id = button.data('pers_id');
    var modal = $(this);
    modal.find('.modal-body #pers_id').val(pers_id);
  });

  $('#delete-alumno').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); 
    var alum_id = button.data('alum_id');
    var modal = $(this);
    modal.find('.modal-body #alum_id').val(alum_id);
  });

  $('#delete-user').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); 
    var id = button.data('id');
    var modal = $(this);
    modal.find('.modal-body #id').val(id);
  });

  $('#delete-periodo').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); 
    var per_id = button.data('per_id');
    var modal = $(this);
    modal.find('.modal-body #per_id').val(per_id);
  });

  $('#delete-curso').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); 
    var cur_id = button.data('cur_id');
    var modal = $(this);
    modal.find('.modal-body #cur_id').val(cur_id);
  });

  $('#delete-area').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); 
    var area_id = button.data('area_id');
    var modal = $(this);
    modal.find('.modal-body #area_id').val(area_id);
  });

  $('#delete-asignatura').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); 
    var asig_id = button.data('asig_id');
    var modal = $(this);
    modal.find('.modal-body #asig_id').val(asig_id);
  });

  $('#delete-oferta').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); 
    var ofer_id = button.data('ofer_id');
    var modal = $(this);
    modal.find('.modal-body #ofer_id').val(ofer_id);
  });

  $('#delete-padreapoderado').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); 
    var pad_id = button.data('pad_id');
    var modal = $(this);
    modal.find('.modal-body #pad_id').val(pad_id);
  });

  $('#delete-matricula').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); 
    var mat_id = button.data('mat_id');
    var modal = $(this);
    modal.find('.modal-body #mat_id').val(mat_id);
  });

  $('#delete-malla').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); 
    var mal_id = button.data('mal_id');
    var modal = $(this);
    modal.find('.modal-body #mal_id').val(mal_id);
  });

  $('#delete-tutor').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); 
    var tutproy_id = button.data('tutproy_id');
    var modal = $(this);
    modal.find('.modal-body #tutproy_id').val(tutproy_id);
  });

  $('#delete-calasignacion').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); 
    var cal_id = button.data('cal_id');
    var modal = $(this);
    modal.find('.modal-body #cal_id').val(cal_id);
  });

  $('#delete-comasignacion').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); 
    var cond_id = button.data('cond_id');
    var modal = $(this);
    modal.find('.modal-body #cond_id').val(cond_id);
  });

  $('#delete-proyasignacion').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); 
    var proy_id = button.data('proy_id');
    var modal = $(this);
    modal.find('.modal-body #proy_id').val(proy_id);
  });

  $('#val-calificacion').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); 
    var mal_id = button.data('mal_id');
    var modal = $(this);
    modal.find('.modal-body #mal_id').val(mal_id);
  });

  $('#val-calificacion2').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); 
    var mal_id = button.data('mal_id');
    var modal = $(this);
    modal.find('.modal-body #mal_id').val(mal_id);
  });

  $('#val-calificacion3').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); 
    var mal_id = button.data('mal_id');
    var modal = $(this);
    modal.find('.modal-body #mal_id').val(mal_id);
  });

  $('#val-calificacion4').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); 
    var mal_id = button.data('mal_id');
    var modal = $(this);
    modal.find('.modal-body #mal_id').val(mal_id);
  });

  $('#val-calificacion5').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); 
    var mal_id = button.data('mal_id');
    var modal = $(this);
    modal.find('.modal-body #mal_id').val(mal_id);
  });

  $('#val-calificacion6').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); 
    var mal_id = button.data('mal_id');
    var modal = $(this);
    modal.find('.modal-body #mal_id').val(mal_id);
  });

  $('#val-calificacion7').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); 
    var mal_id = button.data('mal_id');
    var modal = $(this);
    modal.find('.modal-body #mal_id').val(mal_id);
  });

  $('#val-calificacion8').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); 
    var mal_id = button.data('mal_id');
    var modal = $(this);
    modal.find('.modal-body #mal_id').val(mal_id);
  });

  $('#val-comp-calificacion').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); 
    var ofer_id = button.data('ofer_id');
    var modal = $(this);
    modal.find('.modal-body #ofer_id').val(ofer_id);
  });

  $('#val-comp-calificacion2').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); 
    var ofer_id = button.data('ofer_id');
    var modal = $(this);
    modal.find('.modal-body #ofer_id').val(ofer_id);
  });
  
  $('#val-comp-calificacion3').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); 
    var ofer_id = button.data('ofer_id');
    var modal = $(this);
    modal.find('.modal-body #ofer_id').val(ofer_id);
  });

  $('#val-calif-proy-escolar').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); 
    var tutproy_id = button.data('tutproy_id');
    var modal = $(this);
    modal.find('.modal-body #tutproy_id').val(tutproy_id);
  });

  $('#val-calif-proy-escolar2').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); 
    var tutproy_id = button.data('tutproy_id');
    var modal = $(this);
    modal.find('.modal-body #tutproy_id').val(tutproy_id);
  });

  $('#val-calif-proy-escolar3').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); 
    var tutproy_id = button.data('tutproy_id');
    var modal = $(this);
    modal.find('.modal-body #tutproy_id').val(tutproy_id);
  });

  $('#val-calif-proy-escolar4').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); 
    var tutproy_id = button.data('tutproy_id');
    var modal = $(this);
    modal.find('.modal-body #tutproy_id').val(tutproy_id);
  });

  $('#val-calif-proy-escolar5').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); 
    var tutproy_id = button.data('tutproy_id');
    var modal = $(this);
    modal.find('.modal-body #tutproy_id').val(tutproy_id);
  });

  $('#val-calif-proy-escolar6').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); 
    var tutproy_id = button.data('tutproy_id');
    var modal = $(this);
    modal.find('.modal-body #tutproy_id').val(tutproy_id);
  });

  $('#val-calif-proy-escolar7').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); 
    var tutproy_id = button.data('tutproy_id');
    var modal = $(this);
    modal.find('.modal-body #tutproy_id').val(tutproy_id);
  });

  $('#val-calificacion-excel').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); 
    var mal_id = button.data('mal_id');
    var modal = $(this);
    modal.find('.modal-body #mal_id').val(mal_id);
  });

  $('#val-calificacion-excel2').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); 
    var mal_id = button.data('mal_id');
    var modal = $(this);
    modal.find('.modal-body #mal_id').val(mal_id);
  });

  $('#val-calificacion-excel3').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); 
    var mal_id = button.data('mal_id');
    var modal = $(this);
    modal.find('.modal-body #mal_id').val(mal_id);
  });

  $('#val-calificacion-excel4').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); 
    var mal_id = button.data('mal_id');
    var modal = $(this);
    modal.find('.modal-body #mal_id').val(mal_id);
  });

  $('#val-calificacion-excel5').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); 
    var mal_id = button.data('mal_id');
    var modal = $(this);
    modal.find('.modal-body #mal_id').val(mal_id);
  });
</script>

<!-- DataTables & Plugins -->
<script src="{{asset('backend/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('backend/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('backend/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('backend/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('backend/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('backend/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('backend/plugins/jszip/jszip.min.js')}}"></script>
<script src="{{asset('backend/plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{asset('backend/plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{asset('backend/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('backend/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset('backend/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
<script src="{{asset('backend/dist/js/pages/dashboard2.js')}}"></script>
<!-- SweetAlert2 -->
<script src="{{asset('backend/plugins/sweetalert2/sweetalert2.min.js')}}"></script>
<!-- Toastr -->
<script src="{{asset('backend/plugins/toastr/toastr.min.js')}}"></script>
@yield('js')  
<!-- AdminLTE for demo purposes -->
<!-- <script src="{{asset('backend/dist/js/demo.js')}}"></script> -->
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
</body>
</html>