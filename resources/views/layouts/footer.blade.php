    <footer class="main-footer" style="margin-bottom: -25px;">
        <div class="footer-left">
          <p class="mb-0">Copyright &copy; 2022 <span style="color: #51c0a8;">E-Commerce</span>. All rights reserved.</p>
        </div>
        <div class="footer-right">
        </div>
      </footer>
    </div>
  </div>

    <!-- General JS Scripts -->
    <script src="{{ asset('public/assets/js/app.js') }}"></script>
   <script src="{{ asset('public/bower_components/AdminLTE/plugins/datepicker/bootstrap-datepicker.js') }}" type="text/javascript" ></script>
    <!-- JS Libraies -->
    <script src="{{ asset('public/assets/bundles/izitoast/js/iziToast.min.js') }}"></script>
    <!-- Page Specific JS File -->
    <script src="{{ asset('public/assets/js/page/toastr.js') }}"></script>
    <!-- Template JS File -->
    <script src="{{ asset('public/assets/js/scripts.js') }}"></script>
    <!-- Custom JS File -->
    <script src="{{ asset('public/assets/js/custom.js') }}"></script>

    <script type="text/javascript">
     // for reload every 10 minute
    var time = new Date().getTime();
    $(document.body).bind("mousemove keypress", function(e) {
        time = new Date().getTime();
    });

    function refresh() {
        if(new Date().getTime() - time >= 600000) {
            window.location.reload(true);
        } else {
            setTimeout(refresh, 600000);
        }
    }
    setTimeout(refresh, 600000); //10 minute //600000 == 1min

    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            // model in form submited and validation failed then redirect with by default open model
            var modelName = '#{{ old('model_name') }}';
            if(modelName) {
                $(modelName).modal('show');
            }

            // tab in form submited and validation failed then redirect with by default open tab
            var tabName = '#{{ old('tab_name') }}';
            if(tabName) {
                $('.nav-tabs a[href="' + tabName + '"]').tab('show');
            }
        });
    </script>
    @include('layouts.alert-msg')
    @yield('script')
</body>
</html>