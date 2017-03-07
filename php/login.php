
<?php session_destroy();?>
<div id="login-page">
  <div id="login-container">
    <form action="index.php" method="post">
      <div class="login-form-row">
        <label for="login-email" class="fa fa-envelope-o login-label"></label>
                                                                    <!--name= when taken out breaks -->
        <input required placeholder="Email" type="text" id="login-email" name="login-email"/>
         <div class="requirements">
       Must be a valid email address.
     </div>
      </div>
      <div class="login-form-row">
        <label for="login-password" class="fa fa-lock login-label"></label>
        <input required placeholder="Password" type="password" id="login-password" name="login-password" />
         <div class="requirements">
       Your password must be at least 6 characters as well as contain at least one uppercase,
      one lowercase, and one number.
     </div>
      <div class="login-btn-container">
          <input type="submit" value="Log in" text="Login" class="btn-login" role="button"/>
      </div>
    </form>
  </div>
</div>
