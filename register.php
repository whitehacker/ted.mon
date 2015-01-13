<?php
session_start();
include("controller/pin_auth.php");
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
    <div class="container">
      <div class="row">
          <div class="col-xs-12">
            
              <div class="form-wrap">
                <?php
          if( isset($_SESSION['ERRMSG_ARR']) && is_array($_SESSION['ERRMSG_ARR']) && count($_SESSION['ERRMSG_ARR']) >0 ) {
            echo "<div class='alert alert-danger'>";
            foreach($_SESSION['ERRMSG_ARR'] as $msg) {
              echo "$msg <br/>"; 
            }
            echo "</div><br/>";
          }
          unset($_SESSION['ERRMSG_ARR']);
          
          if(isset($_SESSION['user_pin_need'])){
            echo "<div class='alert alert-danger'>" . $_SESSION['user_pin_need'] . "</div><br/>";
            }
            unset($_SESSION['user_pin_need']);
          ?>
                <h1>حالا ثبت نام نمایی!</h1>
                    <form role="form" action="controller/member_reg.php" method="post" id="login-form" autocomplete="off">
                        <div class="form-group">
                            <label for="email" class="sr-only">اسم مکمل شما!</label>
                            <input type="text" name="full_name" id="email" class="form-control" placeholder="اسم و تخلص">
                        </div>

                        <div class="form-group">
                            <label for="email" class="sr-only">رتبه علمی</label>
                            <input type="text" name="ac_degree" id="email" class="form-control" placeholder="شویالی٫ شوونیار٫ شوونمل٫ شووندوی">
                        </div>

                        <div class="form-group">
                            <label for="email" class="sr-only">نمبر تلیفون</label>
                            <input type="text" name="phone" id="email" class="form-control" placeholder="نمبر تلیفون">
                        </div>

                        <div class="form-group">
                            <label for="email" class="sr-only">ایمیلی آدرس</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="ایمیل آدرس شما!">
                        </div>
                        <div class="form-group">
                            <label for="key" class="sr-only">شفر</label>
                            <input type="password" name="pass" id="key" class="form-control" placeholder="شفر">
                        </div>
                        <div class="checkbox">
                            <span class="character-checkbox" onclick="showPassword()"></span>
                            <span class="label">شفر را نشان دهید!</span>
                        </div>
                        <input type="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="معلومات را ثبت نمایید!">
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