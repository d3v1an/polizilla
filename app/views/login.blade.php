<!DOCTYPE html>
<html class="bg-black">
    <head>
        <meta charset="UTF-8">
        <title>GA Polizilla | Log in</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        {{ HTML::style('css/bootstrap.min.css') }}
        <!-- font Awesome -->
        {{ HTML::style('css/font-awesome.min.css') }}
        <!-- Theme style -->
        {{ HTML::style('css/AdminLTE.css') }}

        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-title" content="GA Polizilla">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

        <script type="text/javascript">var base_path="{{ URL::to("/") }}";</script>
    </head>
    <body class="bg-black">

        <div class="form-box" id="login-box">
            <div class="header">Iniciar sesión</div>
            <form action="{{ URL::to('/') }}" method="post">
                <div class="body bg-gray">
                    <div class="form-group">
                        <input type="text" name="user" id="user" class="form-control" placeholder="Usuario"/>
                    </div>
                    <div class="form-group">
                        <input type="password" name="pass" id="pass" class="form-control" placeholder="Password"/>
                    </div>          
                    <div class="form-group">
                        <input type="checkbox" name="remember_me" id="remember_me" /> Recordarme
                    </div>
                </div>
                <div class="footer">                                                               
                    <button type="submit" class="btn bg-olive btn-block btn-login">Iniciar</button>  
                </div>
            </form>

        </div>


        <!-- jQuery 2.0.2 -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <!-- Bootstrap -->    
        {{ HTML::script('js/bootstrap.min.js') }}
        {{ HTML::script('js/common.js') }}
        {{ HTML::script('js/login.js') }}    

    </body>
</html>