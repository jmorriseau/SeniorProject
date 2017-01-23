
<?php session_destroy();?>
<div id="login-page">
  <div id="login-container">
    <form action="index.php" method="post">
      <div class="login-form-row">
        <label for="login-email" class="fa fa-envelope-o login-label"></label>
                                                                <!--name= when taken out breaks -->
        <input placeholder="Email" type="text" id="login-email" name="login-email"/>
      </div>
      <div class="login-form-row">
        <label for="login-password" class="fa fa-lock login-label"></label>
        <input placeholder="Password" type="password" id="login-password" name="login-password" />
      </div>
      <div class="login-btn-container">
        <!--button class="btn-login" role="button" onclick="validateLogin('home')">Login</button-->
          <input type="submit" value="submit" text="Login" class="btn-login" role="button"/>
      </div>
    </form>
  </div>
</div>
