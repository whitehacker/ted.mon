<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/bootstrap-arabic.css" />
    <link rel="stylesheet" href="css/font-awesome.css" />
    <script src="js/bootstrap-arabic.js"></script>
    <script src="js/jquery.js"></script>
    <link rel="stylesheet" href="css/forms.css" />
  </head>

  <body>
    <?php include("includes/indexnav.php"); ?>
    <section id="login">
    <div class="container">
      <div class="row">
          <div class="col-xs-12">
            <?php
          if( isset($_SESSION['ERRMSG_ARR']) && is_array($_SESSION['ERRMSG_ARR']) && count($_SESSION['ERRMSG_ARR']) >0 ) {
            echo "<div class='alert alert-danger'>";
            foreach($_SESSION['ERRMSG_ARR'] as $msg) {
              echo "$msg <br/>"; 
            }
            echo "</div><br/>";
          }
          unset($_SESSION['ERRMSG_ARR']);
         
          ?>
              <div class="form-wrap">
                <h1>با استفاده از ایمیل آدرس خویش داخل سیستم شوید!</h1>
                    <form role="form" action="controller/login.php" method="post" id="login-form" autocomplete="off">
                        <div class="form-group">
                            <label for="email" class="sr-only">ایمیلی آدرس</label>
                            <input type="email" name="email" class="form-control" placeholder="ایمیل آدرس شما!">
                        </div>
                        <div class="form-group">
                            <label for="key" class="sr-only">شفر</label>
                            <input type="password" name="pass" class="form-control" placeholder="شفر">
                        </div>
                        <div class="checkbox">
                            <span class="character-checkbox" onclick="showPassword()"></span>
                            <span class="label">شفر را نشان دهید!</span>
                        </div>
                        <input type="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="داخل سیستم شوید!">
                    </form>
                    <!-- <a href="javascript:;" class="forget" data-toggle="modal" data-target=".forget-modal">شفر خویش را فراموش نموده اید؟</a> -->
                    <hr>
              </div>
        </div> <!-- /.col-xs-12 -->
      </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>

<?php include("includes/footer.php"); ?>
<script>
function showPassword() {
    
    var key_attr = $('#key').attr('type');
    
    if(key_attr != 'text') {
        
        $('.checkbox').addClass('show');
        $('#key').attr('type', 'text');
        
    } else {
        
        $('.checkbox').removeClass('show');
        $('#key').attr('type', 'password');
        
    }
    
}
</script>
  
  </body>
  </html>