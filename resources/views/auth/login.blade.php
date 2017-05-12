<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>YLAs System | Login</title>

    <link href="{{asset('/')}}assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{asset('/')}}assets/dist/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="{{asset('/')}}assets/dist/css/bootstrap-datepicker.min.css" rel="stylesheet">
    <link href="{{asset('/')}}assets/dist/css/plugins/jasny/jasny-bootstrap.min.css" rel="stylesheet">
    <link href="{{asset('/')}}assets/dist/css/plugins/dataTables/datatables.min.css" rel="stylesheet">
    <link href="{{asset('/')}}assets/dist/css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="{{asset('/')}}assets/dist/css/plugins/select2/select2.min.css" rel="stylesheet">
    <link href="{{asset('/')}}assets/dist/css/plugins/switchery/switchery.css" rel="stylesheet">
    <link href="{{asset('/')}}assets/dist/css/plugins/clockpicker/clockpicker.css" rel="stylesheet">
    <link href="{{asset('/')}}assets/dist/css/plugins/footable/footable.core.css" rel="stylesheet">
    <link href="{{asset('/')}}assets/dist/css/animate.css" rel="stylesheet">
    <link href="{{asset('/')}}assets/dist/css/style.css" rel="stylesheet">
    <link href="{{asset('/')}}assets/dist/css/style.min.css" rel="stylesheet">

</head>

<body class="gray-bg login">
<div class="login-overly">
    <div class=" text-center loginscreen animated fadeInDown">
        <div>
            <div>
                <img src="{{asset('/')}}assets/dist/img/Logo.png">
            </div>
            <h1>Have to a good day</h1>
            <div class="middle-box">
                @if(Session::has('success'))
                    <p class="text-success">{!! Session::get('success') !!}</p>
                @endif
                @if(Session::has('failure'))
                    <p class="text-danger">{!! Session::get('failure') !!}</p>
                @endif
                <form class="m-t" role="form" method="post"">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" >
                    <div class="form-group">
                        <input type="email" name="user_email" class="form-control" placeholder="email" required="">
                    </div>
                    <div class="form-group">
                        <input type="password" name="user_password" class="form-control" placeholder="Password" required="">
                    </div>
                    <button type="submit" class="btn btn-primary block full-width m-b">Login</button>
                    <a href="#"><small>Forgot password?</small></a>
                </form>
            </div>
        </div>
    </div>
</div>
    <!-- Mainly scripts -->
    <script src="{{asset('/')}}assets/dist/js/jquery-2.1.1.js"></script>
    <script src="{{asset('/')}}assets/dist/js/jquery-ui-1.10.4.min.js"></script>
    <script src="{{asset('/')}}assets/dist/js/bootstrap.min.js"></script>
    <script src="{{asset('/')}}assets/dist/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="{{asset('/')}}assets/dist/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="{{asset('/')}}assets/dist/js/inspinia.js"></script>
    <script src="{{asset('/')}}assets/dist/js/plugins/pace/pace.min.js"></script>
    <script src="{{asset('/')}}assets/dist/js/bootstrap-datepicker.min.js"></script>
    <script src="{{asset('/')}}assets/dist/js/plugins/dataTables/datatables.min.js"></script>
    <script src="{{asset('/')}}assets/dist/js/plugins/jasny/jasny-bootstrap.min.js"></script>
    <script src="{{asset('/')}}assets/dist/js/plugins/switchery/switchery.js"></script>
    <script src="{{asset('/')}}assets/dist/js/plugins/iCheck/icheck.min.js"></script>
    <script src="{{asset('/')}}assets/dist/js/plugins/select2/select2.full.min.js"></script>
    <script src="{{asset('/')}}assets/dist/js/plugins/clockpicker/clockpicker.js"></script>
    <script src="{{asset('/')}}assets/dist/js/plugins/footable/footable.all.min.js"></script>
    <script src="{{asset('/')}}assets/dist/js/plugins/validate/jquery.validate.min.js"></script>
    <script src="{{asset('/')}}assets/dist/js/scripts.min.js"></script>
    <script>
        $(document).ready(function() {

            $('.footable').footable();

        });
    </script>

</body>

</html>