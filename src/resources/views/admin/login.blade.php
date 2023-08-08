<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Ela Admin - HTML5 Admin Template</title>
    <meta name="description" content="Ela Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="public/appcart/iroad/images/icons/favicon.ico" type="image/x-icon" /> 
    <!-- <link rel="apple-touch-icon" href="https://i.imgur.com/QRAUqs9.png">
    <link rel="shortcut icon" href="https://i.imgur.com/QRAUqs9.png"> -->

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.min.css">
    <link rel="stylesheet" href="{{asset('public/appcart/iroad/css/cs-skin-elastic.css')}}">
    <link rel="stylesheet" href="{{asset('public/appcart/iroad/css/style.css')}}">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

        <style>
            .error {
                color:"red" !important;
            }
            .login-form label {
                color: "red" !important;
                /* text-transform: uppercase; */
            }
            
        </style>
    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->
</head>
<body class="bg-dark">

    <div class="sufee-login d-flex align-content-center flex-wrap" id="login-background">
        <div class="container">
            <div class="login-content">
                <div class="login-logo">
                    <a href="index.html">
                        <img class="align-content" src="{{asset('public/appcart/iroad/images/company-logo.png')}}" alt="">
                    </a>
                </div>
                <div class="login-form">
                    <form id="login_form" >
                        @csrf 
                        <div class="form-group">
                            <label>USERNAME</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <label>PASSWORD</label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                        </div>
                        <!-- <div class="checkbox">
                            <label>
                                <input type="checkbox"> Remember Me
                            </label>
                            <label class="pull-right">
                                <a href="#">Forgotten Password?</a>
                            </label>
                        </div> -->
                        <div class="w-100 text-center"><span class="login-err"></span></div>
                        <button type="submit" class="btn btn-success btn-flat m-b-30 m-t-30">Sign in</button>
                        <!-- <div class="social-login-content">
                            <div class="social-button">
                                <button type="button" class="btn social facebook btn-flat btn-addon mb-3"><i class="ti-facebook"></i>Sign in with facebook</button>
                                <button type="button" class="btn social twitter btn-flat btn-addon mt-2"><i class="ti-twitter"></i>Sign in with twitter</button>
                            </div>
                        </div> -->
                        <!-- <div class="register-link m-t-15 text-center">
                            <p>Don't have account ? <a href="#"> Sign Up Here</a></p>
                        </div> -->
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
    <!-- <script src="../public/public/appcart/iroad/js/main.js"></script> -->
    <script src="{{asset('public/appcart/iroad/js/jquery.validate.js')}}"></script> 

    <script>
        var base_url='{{ url(\Request::route()->getPrefix()) }}';
             
         $("#login_form").validate({
                rules: {
                    username: {
                        required: true
                    },
                    password: {
                        required: true
                    }                  
            },
            messages: {
                    username: {
                        required: "Please Enter Username"
                    },
                    password: {
                        required: "Please Enter Password"
                    }                   
            },        
            submitHandler: function (form, message) {
             
                    redUrl = base_url+'/login'; 
                    

                $.ajax({
                    url: redUrl,
                    type: 'post',
                    data: new FormData(form),
                    dataType: 'json',
                    contentType: false, // The content type used when sending data to the server.
                    cache: false, // To unable request pages to be cached
                    processData: false, // To send DOMDocument or non processed data file it is set to false
                    success: function (res) {

                        if (res.status) {

                            $(".login-err").css("color", "#28a745");
                            $(".login-err").html(res.msg);
                            setTimeout(function () {
                               location.reload();
                            }, 500);

                        } else {
                            // fp1.close();
                            $(".login-err").css("color", "red");
                            $(".login-err").html(res.msg);
                           
                            setTimeout(function () {
                                // location.reload(); 
                            }, 3000);
                        }

                    },
                    error: function (xhr, textStatus, errorThrown) {
                        // console.log(xhr.responseJSON);
                        // if(xhr.status==419)
                        // {
                        //     $(".login-err").css("color", "red");
                        //     $(".login-err").html("Server error ! refresh page.");
                        // }   
                        // $(".btn-register").prop('disabled',false);
                        // $(".spinner-border").prop('hidden',true);

                        // setTimeout(function () {
                        //         location.reload(); 
                        //     }, 2000);
                    }
                });

            }
        }); 
 </script>

</body>
</html>
