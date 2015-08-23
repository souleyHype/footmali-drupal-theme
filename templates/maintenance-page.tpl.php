<html>
<head>
    <style>
        @import url(http://fonts.googleapis.com/css?family=Montserrat);
        @import url(http://fonts.googleapis.com/css?family=Droid+Sans);

        html {
            font-family: 'Open Sans', sans-serif;
            background: url('/sites/all/themes/footmali/images/bg-top.png') no-repeat center fixed;
            background-size: cover;
        }

        #content {
            font-family: 'Montserrat', sans-serif;
            font-weight: 100;
            font-size: 51px;
            color: #2c2c2c;
            position: absolute;
            top: 45%;
            left: 50%;
            margin-right: -50%;
            transform: translate(-50%, -50%);
            -webkit-transform: translate(-50%, -50%);
            -moz-transform: translate(-50%, -50%);
            border: 1px solid;
            background-color: #FFFFFF;
        }

        #main-info {
            font-family: 'Montserrat', sans-serif;
            font-size: 16px;
            font-weight: 100;
            color: #fff;
            position: absolute;
            top: 45%;
            left: 50%;
            margin-right: -50%;
            margin-top: 94px;
            transform: translate(-50%, -50%);
            -webkit-transform: translate(-50%, -50%);
            -moz-transform: translate(-50%, -50%);
        }

        #logo{
            max-width: 300px;
        }
    </style>
</head>
<body>
    <center>
        <img id="logo" src="<?php echo $logo; ?>" alt="Footmali" />
    </center>
    <center>
        <div id="content">
            <p>MAINTENANCE</p>
            <h3 id="main-info">Footmali is currently under maintenance. We should be back shortly. Thank you for your patience.</b></h3>
        </div>
    </center>
</body>
</html>