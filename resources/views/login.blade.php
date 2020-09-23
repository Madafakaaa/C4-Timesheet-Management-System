<!-- HTML Header Content -->
@include('components.html_header')
<body class="font-opensans">
  <div class="auth">
    <div class="auth_right">
      <div class="carousel slide" data-ride="carousel" data-interval="3000">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="/assets/images/slider1.svg" class="img-fluid" alt="login page" />
            <div class="px-4 mt-4">
              <h4>Fully Responsive</h4>
              <p>We are using Bootstrap 4, the world’s most popular framework for building responsive, mobile-first sites.</p>
            </div>
          </div>
          <div class="carousel-item">
            <img src="/assets/images/slider2.svg" class="img-fluid" alt="login page" />
            <div class="px-4 mt-4">
              <h4>Moving working online</h4>
              <p>We provide a way to connect you and your colleagues in an easy way!</p>
            </div>
          </div>
          <div class="carousel-item">
            <img src="/assets/images/slider3.svg" class="img-fluid" alt="login page" />
            <div class="px-4 mt-4">
              <h4>Online Timesheet Arrangement and Approvement</h4>
              <p>We manages your timesheets for you!</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="auth_left">
      <div class="card py-4">
        <form action="/login" method="post">
          @csrf
          <div class="text-center mb-3">
            <a class="header-brand" href="#"><i class="fa fa-dashboard brand-logo"></i></a>
          </div>
          <div class="card-body">
            <div class="card-title">Login to your account</div>
            <div class="form-group">
              <label class="form-label">User Account</label>
              <input type="text" class="form-control" name="user_id" placeholder="Enter user account..." required>
            </div>
            <div class="form-group">
              <label class="form-label">Password<a href="#" class="float-right small">I forgot password</a></label>
              <input type="password" class="form-control" name="user_password"  placeholder="Enter Password..." required>
            </div>
            <div class="form-footer">
              <input type="submit" class="btn btn-primary btn-block" value="Sign in">
            </div>
          </div>
          <div class="text-center text-muted">
              Dont have account yet? <a href="#">Sign up</a>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- Java Script Content -->
  @include('components.scripts')
</body>
</html>
