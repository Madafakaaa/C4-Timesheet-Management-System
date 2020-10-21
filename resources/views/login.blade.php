<!-- HTML Header Content -->
@include('components.html_header')
<body class="font-opensans">
  <div class="auth">
    <div class="auth_right" style="height:100%; width:100%;">
      <div class="carousel slide" data-ride="carousel" data-interval="3000"  style="height:100%; width:100%;">
        <div class="carousel-inner"  style="height:100%; width:100%;">
          <div class="carousel-item active"  style="height:100%; width:100%;">
            <img src="/assets/images/background/bg-1.jpg" style="height:100%; width:100%;"/>
          </div>
          <div class="carousel-item"  style="height:100%; width:100%;">
            <img src="/assets/images/background/bg-2.jpg" style="height:100%; width:100%;"/>
          </div>
          <div class="carousel-item"  style="height:100%; width:100%;">
            <img src="/assets/images/background/bg-3.jpg" style="height:100%; width:100%;"/>
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
