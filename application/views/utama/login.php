<div class="login-box">
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="<?php echo base_url('index2.html')?>" class="h1"><b>My</b>Payroll</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Sign in to start your session</p>
      <form id="form_first">
        <div class="input-group mb-3">
          <input type="text" name="username" class="form-control" placeholder="Username" required="required">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="Password" required="required">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember" name="remember">
              <label for="remember"> Remember Me</label>
            </div>
          </div>
          <div class="col-4">
            <!-- <button type="submit" class="btn btn-primary btn-block">Sign In</button> -->
            <button type="button" onclick="do_auth()" id="action_btn" class="btn btn-primary btn-block "><i class="fas fa-sign-in-alt"></i> Login</button>
          </div>
        </div>
      </form>

      <div class="social-auth-links text-center mt-2 mb-3">
        <!-- <a href="#" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
        </a> -->
        <!-- <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google mr-2"></i> Sign in using Google
        </a> -->
      </div>
      <p class="mb-1">
        <a href="forgot-password.html">I forgot my password</a>
      </p>
      <p class="mb-0">
        <a href="register.html" class="text-center">Register a new membership</a>
      </p>
    </div>
  </div>
  <script src="<?php echo base_url('asset/plugins/jquery/jquery.min.js')?>"></script>
  <script src="https://accounts.google.com/gsi/client" async defer></script>
  <script type="text/javascript">
    $(document).ready(function () {
      // form_key('form_first','action_btn');
      // $("#alert-danger").fadeTo(5000, 300).slideUp(300, function(){
      //   $("#alert-danger").slideUp(300);
      // }); 
    });
    function do_auth() {
      submitAjax("<?php echo base_url('auth/do_login')?>",null,'form_first',null,null,'auth');
    }
  </script>