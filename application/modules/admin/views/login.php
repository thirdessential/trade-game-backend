<?php $this->load->view('admin/components/header'); ?>
<body class="login-page">
   <?php
    $error = $this->session->userdata('msg');
    if (!empty($error)) {
        ?>
        <div class="alert alert-danger"><?php
            echo $error;
            ?></div>
    <?php }$this->session->unset_userdata('msg'); ?>

    <div class="login-box">
        <div class="login-logo animated fadeInDown" data-animation="fadeInDown">
            <!-- <a href="<?php echo base_url() . 'admin'; ?>" class="logo"><img src="<?php echo base_url() . 'assets/uploads/images/logo.png' ?>" height="150" class="img-responsive" style="display:inline-block" alt="Logo" /></a> -->

            <a href="<?php echo base_url() . 'user'; ?>" class="logo">Trade Game</a>
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body  animated fadeInUp" data-animation="fadeInUp">
            <!-- <p class="login-box-msg">Sign in to start your session</p> -->
            <form role="form" id="ValidationLogin" method="post" action="<?php echo base_url() ?>admin/login">
                <p class="text-danger">
                    <?php echo validation_errors(); ?>
                    <?php echo $this->session->flashdata('error'); ?>
                    <?php
                    echo get_cookie('message');
                    delete_cookie('message');
                    ?>
                </p>
                <input type="hidden" name="user_type" value="Admin">

                <div class="form-group has-feedback">
                    
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    <input type="text" name="email" class="form-control" placeholder="Emil Id" />

                </div>
                <div class="form-group has-feedback">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    <input type="password" name="password" class="form-control" placeholder="Password" />

                </div>
                <div class="form-group has-feedback">
                    <input type="submit" class="<?php echo $this->session->userdata('checker'); ?> btn bg-green btn-block btn-flat" value="Login">
                </div>
                <div class="row">

                    <div class="col-xs-12">

                    </div><!-- /.col -->
                </div>
            </form>
            <!--<div class="form-group has-feedback">
                <a href="<?php echo base_url() ?>admin/login/forgot"class="btn bg-blue btn-block btn-flat" >Forgot Password</a><br> 
            </div>-->

        </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->
</body>
<script src="<?php echo base_url(); ?>assets/admin/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/admin/js/moment.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/js/select2.full.min.js"></script> 
<!-- All Form Validation Js-->
<script src="<?php echo base_url(); ?>assets/admin/js/jquery.validate.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/js/additional-methods.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/js/form-validation.js"></script> 

<!--<script src="<?php echo base_url(); ?>assets/admin/js/footer-resource.js" type="text/javascript"></script>-->
</html>