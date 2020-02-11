<title>GFL</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8" />
    <meta name="keywords" content="" />
    <script>
        addEventListener("load", function () {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>
    <!-- Custom Theme files -->
    <link href="<?php echo base_url(); ?>assets/admin/css/bootstrap.css" type="text/css" rel="stylesheet" media="all">
    <link href="<?php echo base_url(); ?>assets/admin/css/style.css" type="text/css" rel="stylesheet" media="all">
    <!-- font-awesome icons -->
    <link href="<?php echo base_url(); ?>assets/admin/css/fontawesome-all.min.css" rel="stylesheet">
    <!-- //Custom Theme files -->
    <!-- online-fonts -->
    <link href="//fonts.googleapis.com/css?family=Ubuntu:300,300i,400,400i,500,500i,700,700i" rel="stylesheet">
    <!-- //online-fonts -->
    <style type="text/css">
        label.error{
            color: red;
        }
    </style>
</head>

<body data-baseurl="<?php echo base_url(); ?>">
<div class="jumbotron text-center">
  <h1 class="display-3">Thank You!</h1>
  <p class="lead"><strong>Please keep your id and Paasword</strong> </p><br>
  	<b>User Id :</b> <span><?php echo (!empty($userId))?($userId):('') ?></span><br><br>
  	<b>Password :</b> <span><?php echo (!empty($password))?($password):('') ?></span><br><br>
        
    <p class='alert alert-info'>Login details are also send in your email id and sms. </p>
  <hr>
  
  <p class="lead">
    <a class="btn btn-primary btn-sm" href="<?php echo  base_url() ?>" role="button">Continue to homepage</a>
  </p>
</div>

</body>
</html>