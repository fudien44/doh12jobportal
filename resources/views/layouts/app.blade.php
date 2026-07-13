<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="{{ asset('public/img/ro12.png') }}">
  <title>DOH XII JOB PORTAL</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{ asset('public/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('public/dist/css/doh.min.css') }}">
  <link rel="stylesheet" href="{{ asset('public/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{ asset('public/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{ asset('public/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{ asset('public/plugins/summernote/summernote-bs4.min.css')}}">
  <link rel="stylesheet" href="{{ asset('public/plugins/select2/css/select.min.css')}}">
  <link rel="stylesheet" href="{{ asset('public/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
  <link href="{{ asset('public/dist/css/jquery.toast.min.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('public/plugins/daterangepicker/daterangepicker.css')}}">
  <link rel="stylesheet" href="{{ asset('public/plugins/daterangepicker/daterangepicker.css')}}">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="{{ asset('public/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="{{ asset('public/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css')}}">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{ asset('public/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
  <!-- Bootstrap4 Duallistbox -->
  <link rel="stylesheet" href="{{ asset('public/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css')}}">
  <!-- BS Stepper -->
  <link rel="stylesheet" href="{{ asset('public/plugins/bs-stepper/css/bs-stepper.min.css')}}">
  <!-- dropzonejs -->
  <link rel="stylesheet" href="{{ asset('public/plugins/dropzone/min/dropzone.min.css')}}">
  @yield('css')
  @include('css.app')
</head>
<body class="sidebar-collapse layout-top-nav layout-navbar-fixed layout-footer-fixed count-particles">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand-md navbar-light navbar-green">
    <div class="container-fluid">
      <a href="{{asset('/')}}" class="navbar-brand">
        <h4 class="brand-text text-warning font-weight-bold mt-2">DOH XII JOB PORTAL</h4>
      </a>

      <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          @if(Auth::user() && (Auth::user()->level == 0))
          <li class="nav-item">
            <a href="{{asset('/')}}" class="nav-link text-white font-weight-light"><b>JOB OPPORTUNITIES</b></a>
          </li>
          @endif
          @if(Auth::user() && (Auth::user()->level == 0))
          <li class="nav-item">
            <a href="{{asset('/jobs/apply')}}" class="nav-link text-white font-weight-light"><b>MY APPLICATIONS</b></a>
          </li>
          @endif
          @if(Auth::user() && Auth::user()->level == 2)
          <li class="nav-item">
            <a href="{{asset('/job-posting')}}" class="nav-link text-white font-weight-light"><b>JOB POST</b></a>
          </li>
          <li class="nav-item">
            <a href="{{asset('/applicants')}}" class="nav-link text-white font-weight-light"><b>APPLICANTS</b></a>
          </li>
          @endif
        </ul>
      </div>

      <!-- Right navbar links -->
      <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
        <!-- Messages Dropdown Menu -->
        @guest
        <li class="nav-item dropdown">
          <a class="nav-link text-warning" href="{{ route('login') }}">
            <i class="fas fa-sign-in-alt"></i> LOGIN
          </a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link text-warning" href="{{ route('register') }}">
            <i class="fas fa-user-alt"></i> REGISTER
          </a>
        </li>
        @else
        <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                {{ Auth::user()->fname }} <span class="caret"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right user-dd animated flipInY">
              @if(Auth::user()->level == 2)
              <a class="dropdown-item" href="{{ url('users') }}"><i class="fas fa-user-circle"></i> Users</a>
              @endif
              @if(Auth::user()->level == 0)
              <a class="dropdown-item" href="{{ url('my-profile') }}"><i class="fas fa-user-circle"></i> My Profile</a>
              @endif
                <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt"></i> {{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
          </div>
        </li>
        @endguest
      </ul>
    </div>
  </nav>
  <!-- /.navbar -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <div class="loading"></div>
    @yield('content')
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      Created By: DOH XII ICT-UNIT -ajbb
    </div>
    <!-- Default to the left -->
    <img src="{{ asset('public/img/doh.png') }}" class="brand-image img-circle" width="32">&nbsp;<img src="{{ asset('public/img/ro12.png') }}" class="brand-image img-circle" width="32">&nbsp;<strong>Copyright &copy; 2024</strong>DOH XII JOB PORTAL All rights reserved.
  </footer>
</div>
<div class="modal fade" id="modal-profile" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Profile</h4>
      </div>
      <div class="modal-body">
        <p>Please Finish your Profile&hellip;</p>
      </div>
      <div class="modal-footer">
        <a class="btn btn-primary" href="{{ url('my-profile') }}">Go to Profile</a>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{ asset('public/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('public/plugins/jquery.form.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('public/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- App -->
<script src="{{ asset('public/dist/js/adminlte.min.js')}}"></script>
<!-- DataTables  & Plugins -->
<script src="{{ asset('public/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('public/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{ asset('public/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{ asset('public/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{ asset('public/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{ asset('public/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{ asset('public/plugins/jszip.min.js')}}"></script>
<script src="{{ asset('public/plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{ asset('public/plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{ asset('public/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{ asset('public/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{ asset('public/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
<!-- Summernote -->
<script src="{{ asset('public/plugins/summernote/summernote-bs4.min.js')}}"></script>
<!-- Select2 -->
<script src="{{ asset('public/plugins/select2/js/select2.full.min.js')}}"></script>
<script src="{{ asset('public/dist/js/jquery.toast.min.js') }}"></script>
<!-- Bootstrap4 Duallistbox -->
<script src="{{ asset('public/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js')}}"></script>
<!-- InputMask -->
<script src="{{ asset('public/plugins/moment/moment.min.js')}}"></script>
<script src="{{ asset('public/plugins/inputmask/jquery.inputmask.min.js')}}"></script>
<script src="{{ asset('public/plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('public/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<!-- Bootstrap Switch -->
<script src="{{ asset('public/plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}"></script>
<!-- BS-Stepper -->
<script src="{{ asset('public/plugins/bs-stepper/js/bs-stepper.min.js')}}"></script>
<!-- dropzonejs -->
<script src="{{ asset('public/plugins/dropzone/min/dropzone.min.js')}}"></script>
<script src="{{ asset('public/js/particles.js')}}"></script>
<script src="{{ asset('public/js/js/app.js')}}"></script>
<script src="{{ asset('public/js/js/lib/stats.js')}}"></script>
<script src="{{ asset('public/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
<script src="{{ asset('public/js/js/jquery.lazy.min.js')}}"></script>

@yield('js')
@include('scripts.app')
</body>
</html>
