{{-- mauskan di script.blade.php --}}

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset ('assets/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{ asset ('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')  }}"></script>
  
    <!-- Core plugin JavaScript-->
    <script src="{{ asset ('assets/vendor/jquery-easing/jquery.easing.min.js')  }}"></script>
  
    <!-- Custom scripts for all pages-->
    <script src="{{ asset ('assets/js/sb-admin-2.min.js')  }}"></script>
  
    <!-- Page level plugins -->
    <script src="{{ asset ('assets/vendor/datatables/jquery.dataTables.min.js ')}}"></script>
    <script src="{{ asset ('assets/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{ asset ('assets/vendor/chart.js/Chart.min.js') }}"></script>
    
    <!-- Page level custom scripts -->
    <script src="{{ asset ('assets/js/demo/datatables-demo.js')  }}"></script>
    <script src="{{ asset ('assets/js/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset ('assets/js/demo/chart-pie-demo.js') }}"></script>
    <script src="{{ asset ('assets/js/demo/chart-bar-demo.js') }}"></script>
  
  <!-- Custom styles for this template-->
  <link href="{{ asset ('assets/css/sb-admin-2.min.css') }}" rel="stylesheet">
  <link href="{{ asset ('assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

@push('scripts')
  