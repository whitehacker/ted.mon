<?php
session_start();
?>
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
     
    <div class="container text-center">
      <div class="row">
          <div class="col-xs-12">
              <?php
          if( isset($_SESSION['ERRMSG_ARR']) && is_array($_SESSION['ERRMSG_ARR']) && count($_SESSION['ERRMSG_ARR']) >0 ) {
            echo "<div class='text-error'>";
            foreach($_SESSION['ERRMSG_ARR'] as $msg) {
              echo "<span class='alert alert-danger'>$msg</span><br/>"; 
            }
            echo "</div><br/>";
          }
          unset($_SESSION['ERRMSG_ARR']);
          
          if(isset($_SESSION['user_pin_need'])){
            echo "<div class='alert alert-danger'>" . $_SESSION['user_pin_need'] . "</div><br/>";
            }
            unset($_SESSION['user_pin_need']);
          ?>
              <div class="form-wrap">
                  

                <h1>برای راجستر نمودن خویش به سیستم شما باید کود را داخل نمایید!</h1>
                    <form role="form" action="controller/pin_exec.php" method="post" id="login-form" autocomplete="off">
                        
                        <div class="form-group">
                            <label for="key" class="sr-only">شفر</label>
                            <input type="password" name="pin" class="form-control" placeholder="شفر">
                        </div>
                       
                        <input type="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="داخل صفحه ثبت نام شوید!">
                    </form>
                    
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