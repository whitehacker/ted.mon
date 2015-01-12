<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/bootstrap-arabic.css" />
    <link rel="stylesheet" href="css/font-awesome.css" />
    <script src="js/bootstrap-arabic.js"></script>
    <script src="js/jquery.js"></script>
    <style>
      /*    --------------------------------------------------
  :: Login Section
  -------------------------------------------------- */
#login {
    padding-top: 50px
}
#login .form-wrap {
    width: 30%;
    margin: 0 auto;
}
#login h1 {
    color: #1fa67b;
    font-size: 18px;
    text-align: center;
    font-weight: bold;
    padding-bottom: 20px;
}
#login .form-group {
    margin-bottom: 25px;
}
#login .checkbox {
    margin-bottom: 20px;
    position: relative;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    -o-user-select: none;
    user-select: none;
}
#login .checkbox.show:before {
    content: '\e013';
    color: #1fa67b;
    font-size: 17px;
    margin: 1px 0 0 3px;
    position: absolute;
    pointer-events: none;
    font-family: 'Glyphicons Halflings';
}
#login .checkbox .character-checkbox {
    width: 25px;
    height: 25px;
    cursor: pointer;
    border-radius: 3px;
    border: 1px solid #ccc;
    vertical-align: middle;
    display: inline-block;
}
#login .checkbox .label {
    color: #6d6d6d;
    font-size: 13px;
    font-weight: normal;
}
#login .btn.btn-custom {
    font-size: 14px;
  margin-bottom: 20px;
}
#login .forget {
    font-size: 13px;
  text-align: center;
  display: block;
}

/*    --------------------------------------------------
  :: Inputs & Buttons
  -------------------------------------------------- */
.form-control {
    color: #212121;
}
.btn-custom {
    color: #fff;
  background-color: #1fa67b;
}
.btn-custom:hover,
.btn-custom:focus {
    color: #fff;
}

/*    --------------------------------------------------
    :: Footer
  -------------------------------------------------- */
#footer {
    color: #6d6d6d;
    font-size: 12px;
    text-align: center;
}
#footer p {
    margin-bottom: 0;
}
#footer a {
    color: inherit;
}
    </style>
  </head>

  <body>
    <section id="login">
    <div class="container">
      <div class="row">
          <div class="col-xs-12">
              <div class="form-wrap">
                <h1>حالا ثبت نام نمایی!</h1>
                    <form role="form" action="javascript:;" method="post" id="login-form" autocomplete="off">
                        <div class="form-group">
                            <label for="email" class="sr-only">اسم مکمل شما!</label>
                            <input type="text" name="email" id="email" class="form-control" placeholder="اسم و تخلص">
                        </div>

                        <div class="form-group">
                            <label for="email" class="sr-only">رتبه علمی</label>
                            <input type="text" name="email" id="email" class="form-control" placeholder="شویالی٫ شوونیار٫ شوونمل٫ شووندوی">
                        </div>

                        <div class="form-group">
                            <label for="email" class="sr-only">نمبر تلیفون</label>
                            <input type="text" name="email" id="email" class="form-control" placeholder="نمبر تلیفون">
                        </div>

                        <div class="form-group">
                            <label for="email" class="sr-only">ایمیلی آدرس</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="ایمیل آدرس شما!">
                        </div>
                        <div class="form-group">
                            <label for="key" class="sr-only">شفر</label>
                            <input type="password" name="key" id="key" class="form-control" placeholder="شفر">
                        </div>
                        <div class="checkbox">
                            <span class="character-checkbox" onclick="showPassword()"></span>
                            <span class="label">شفر را نشان دهید!</span>
                        </div>
                        <input type="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="داخل سیستم شوید!">
                    </form>
                    
                    <hr>
              </div>
        </div> <!-- /.col-xs-12 -->
      </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>



<footer id="footer">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <p>TEMIS &copy;- 2014</p>
                <p>Powered by Teacher Education General Directorate</p>
            </div>
        </div>
    </div>
</footer>
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