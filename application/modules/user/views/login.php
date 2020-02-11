<!--Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->

<!DOCTYPE html>
<html lang="zxx">

<head>
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
    <!-- banner -->
    <div class="banner" id="home">
        <!-- header -->
        <header>
            <nav class="navbar navbar-expand-lg navbar-light bg-gradient-secondary pt-3">
                <h1>
                    <a class="navbar-brand text-white" href="<?php echo base_url(); ?>">
                        <img src="<?php echo base_url(); ?>assets/uploads/images/logo.PNG">
                    </a>
                </h1>
                <button class="navbar-toggler ml-md-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-lg-auto text-center">
                        <li class="nav-item active  mr-3 mt-lg-0 mt-3">
                            <a class="nav-link" href="<?php echo base_url(); ?>">Home
                                <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <li class="nav-item  mr-3 mt-lg-0 mt-3">
                            <a class="nav-link scroll" href="#">About Us</a>
                        </li>
                        
                       
                        <li class="nav-item mr-3 mt-lg-0 mt-3">
                            <a class="nav-link scroll" href="#">Plan</a>
                        </li>
                         <li class="nav-item mr-3 mt-lg-0 mt-3">
                            <a class="nav-link scroll" href="#">Franchise</a>
                        </li>
 
                        <li class="nav-item">
                            <button type="button" class="btn  ml-lg-2 w3ls-btn" data-toggle="modal" aria-pressed="false" data-target="#registerModal" id="btnRegister">
                                Register
                            </button>
                        </li>
                        <li>
                            <button type="button" class="btn  ml-lg-2 w3ls-btn" data-toggle="modal" aria-pressed="false" data-target="#exampleModal" >
                                Login
                            </button>
                        </li>
                    </ul>
                </div>

            </nav>
        </header>
        <!-- //header -->
        <div class="container">
            <!-- banner-text -->
            <div class="banner-text">
                <div class="slider-info">
                    <h3>connect digital content with the real world</h3>
                    <a class="btn btn-primary mt-lg-5 mt-3 agile-link-bnr scroll" href="" role="button">View More</a>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Login</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form role="form" id="ValidationLogin" method="post" action="<?php echo base_url() ?>user/login">
                <p class="text-danger">
                    <?php echo validation_errors(); ?>
                    <?php echo $this->session->flashdata('error'); ?>
                    <?php
                    echo get_cookie('message');
                    delete_cookie('message');
                    ?>
                </p>
                <input type="hidden" name="user_type" value="User">
                <div class="form-group has-feedback">
                    <label for="recipient-name" class="col-form-label">User Id</label>
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    <input type="text" name="email" class="form-control" placeholder="User Id" />

                </div>
                <div class="form-group has-feedback">
                    <label for="recipient-name" class="col-form-label">Password</label>
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    <input type="password" name="password" class="form-control" placeholder="Password" />

                </div>
                <div class="form-group has-feedback">
                    <input type="submit" class=" btn bg-green btn-block btn-flat" value="Login">
                </div>
                <div class="row">

                    <div class="col-xs-12">

                    </div><!-- /.col -->
                </div>
            </form>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Register</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
            <form role="form" id="validationRegistration" method="post" action="<?php echo base_url() ?>user/login/registration">
                <p class="text-danger">
                    <?php echo validation_errors(); ?>
                    <?php echo $this->session->flashdata('error'); ?>
                    <?php
                    echo get_cookie('message');
                    delete_cookie('message');
                    ?>
                </p>
                <input type="hidden" name="user_type" value="User">

                <div class="form-group has-feedback">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    <input type="text" name="sponsored_id" id="userId" value="<?php echo !empty($_GET['sponsored_id'])?($_GET['sponsored_id']):(''); ?>" class="form-control" placeholder="Sponsored Id" />
                </div>

                <div class="form-group has-feedback">
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    <input type="text" name="sponsored_name"  id="userName" class="form-control" placeholder="Sponsored Name" readonly="readonly" />
                </div>

                <div class="form-group has-feedback">
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    <input type="text" name="full_name"  class="form-control" placeholder="Full Name" />
                </div>

                <div class="form-group has-feedback">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    <input type="text" name="contact_number" id="contact_number" class="form-control" placeholder="Mobile Number" />
                </div>

                <div class="form-group has-feedback">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    <input type="text" name="email" id="email" class="form-control" placeholder="Emil Id" />
                </div>

                <div class="form-group has-feedback">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    <input type="password" name="password" class="form-control" placeholder="Password" />

                </div>

                <div class="form-group has-feedback">
                    <span class="glyphicon glyphicon-phone form-control-feedback"></span>
                    <input type="text" name="tez_number"  class="form-control" placeholder="Tez Number" />
                </div>

                <div class="form-group has-feedback">
                    <span class="glyphicon glyphicon-phone form-control-feedback"></span>
                    <input type="text" name="payPhone"  class="form-control" placeholder="Pay Phone" />
                </div>

                <div class="form-group has-feedback">
                    <input type="submit" class="btn bg-green btn-block btn-flat" value="Submit">
                </div>
                <div class="row">

                    <div class="col-xs-12">

                    </div><!-- /.col -->
                </div>
            </form>
                </div>
            </div>
        </div>
    </div>
    <!-- //login -->
    <!-- //footer -->
    <!-- js -->
    <script src="<?php echo base_url(); ?>assets/admin/jss/jquery-2.2.3.min.js"></script>
    <!-- //js -->
    
    <!-- Bootstrap core JavaScript
================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="<?php echo base_url(); ?>assets/admin/jss/bootstrap.js"></script>
    <script src="<?php echo base_url(); ?>assets/admin/js/jquery.validate.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/js/additional-methods.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/js/user-form-validation.js"></script> 


<script type="text/javascript">
    $(document).ready(function(){



    $('body').on('keyup', '#userId',function(){
        var userId = $(this).val();

        var link = $('body').data('baseurl');
            $.ajax({
                url: link + 'user/ajax/get_sponsor_name',
                type: 'post',
                dataType: 'html',
                data: {
                    userId: userId, tbl :'users'
                },
                success: function (msg)
                {
                    if(msg == 0){
                       
                    $('#userName').val('');
                    }else{
                    $('#userName').val(msg);

                    }
                }

            });
    });



    $(window).on('load',function(){
        var userId = $('#userId').val();

        var link = $('body').data('baseurl');
            $.ajax({
                url: link + 'user/ajax/get_sponsor_name',
                type: 'post',
                dataType: 'html',
                data: {
                    userId: userId, tbl :'users'
                },
                success: function (msg)
                {
                    if(msg == 0){
                       
                    $('#userName').val('');
                    }else{
                    $('#userName').val(msg);

                    }
                }

            });
    });

    var registration = '<?php echo $_GET['sponsored_id'] ?>';

    if(registration != ''){

        $('body').find('#btnRegister').trigger('click');
    }
 
});
</script>

</script>
</body>

</html>