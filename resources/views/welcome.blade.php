<!DOCTYPE html>
<html>
    <head>
        <title>Welcome, Sir</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                display: table;
                font-weight: 100;
                font-family: 'Lato';
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 96px;
            }
        </style>
        <!-- Bootstrap 3.3.5 -->
        <link href="{{ asset("/bower_components/AdminLTE/bootstrap/css/bootstrap.min.css") }}" rel="stylesheet" type="text/css" >
    </head>
    <body>
        <div class="container">
            <div class="content">
                <div class="title">LineArk Studio</div>
                <a href="login"><button class="btn btn-primary"> Start Your Ideas</button></a>
            </div>
        </div>
    </body>
</html>
