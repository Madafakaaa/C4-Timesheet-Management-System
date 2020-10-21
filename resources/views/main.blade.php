<!-- HTML Header Content -->
@include('components.html_header')
<!-- HTML Body Content -->
<body class="font-opensans">
<!-- Page Loader -->
<div class="page-loader-wrapper">
  <div class="loader">
  </div>
</div>
<!-- Main Content -->
<div id="main_content">
  <!-- Sidebar Content -->
  @include('components.sidebar')
  <!-- User Info Content -->
  @include('components.user_info')
  <!-- Left Sidebar Content Content -->
  @include('components.left_sidebar')
  <div class="page">
    <!-- Top Navigator Content -->
    @include('components.top_nav')
    <!-- Main Body Content -->
    @section('body')
    @show
    <!-- Footer Content -->
    <!--
    <div class="section-body" style="position:fixed; bottom:0; width:100%;">
      <footer class="footer">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-6 col-sm-12">
              Copyright © 2019 <a href="javascript:void(0)"> CS46-4</a>.
            </div>
          </div>
        </div>
      </footer>
    </div>
    -->
  </div>
</div>
<!-- Java Script Content -->
@include('components.scripts')
</body>
</html>
<!-- Temp Script -->
@section('script')
@show
