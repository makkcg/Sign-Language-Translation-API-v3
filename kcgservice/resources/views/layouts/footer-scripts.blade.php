   
   <script src="{{URL::asset('assets/plugins/jQuery/jQuery-2.1.4.min.js')}}"></script>
    <!-- jQuery UI 1.11.4 -->
     <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.4 -->
    <script src="{{URL::asset('assets/bootstrap/js/bootstrap.min.js')}}"></script>
    <!-- Morris.js charts -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js'"></script>
    <script src="{{URL::asset('assets/plugins/morris/morris.min.js')}}"></script>
    <!-- Sparkline -->
    <script src="{{URL::asset('assets/plugins/sparkline/jquery.sparkline.min.js')}}"></script>
    <!-- jvectormap -->
    <script src="{{URL::asset('assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{URL::asset('assets/plugins/knob/jquery.knob.js')}}"></script>
    <!-- daterangepicker -->
    
    <script src="{{URL::asset('assets/plugins/daterangepicker/daterangepicker.js')}}"></script>
    <!-- datepicker -->
    <script src="{{URL::asset('assets/plugins/datepicker/bootstrap-datepicker.js')}}"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="{{URL::asset('assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>
    <!-- Slimscroll -->
    <script src="{{URL::asset('assets/plugins/slimScroll/jquery.slimscroll.min.js')}}"></script>
    <!-- FastClick -->
    <script src="{{URL::asset('assets/plugins/fastclick/fastclick.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{URL::asset('assets/dist/js/app.min.js')}}"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{URL::asset('assets/dist/js/pages/dashboard.js')}}"></script>
    <!-- AdminLTE for demo purposes -->

    
    @yield('scripts')