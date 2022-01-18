@include('layouts.header')
@include('layouts.sidebar')
<!-- Begin Main Content -->
  <div class="main-content">
    @yield('content')
  </div>
<!-- End Main Content -->
@include('layouts.footer')
