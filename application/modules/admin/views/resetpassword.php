<?php $this->load->view('admin/components/header'); ?>
<body class="login-page">

    <?php
    $error = $this->session->userdata('error');
    if (!empty($error)) {
        ?>
        <div class="alert alert-danger"><?php
            echo $error;
            ?></div>
    <?php }$this->session->unset_userdata('error'); ?>

    <div class="login-box">
        <div class="login-logo animated fadeInDown" data-animation="fadeInDown">
            <!-- <a href="<?php echo base_url() . 'admin'; ?>" class="logo"><img src="<?php echo base_url() . 'assets/uploads/images/logo.png' ?>" height="150" class="img-responsive" style="display:inline-block" alt="Logo" /></a> -->

            <a href="<?php echo base_url() . 'user'; ?>" class="logo">Golden Future Life</a>
        </div><!-- /.login-logo -->
        <div class="login-box-body  animated fadeInUp" data-animation="fadeInUp">
            <!-- <p class="login-box-msg">Sign in to start your session</p> -->
            <form role="form" id="resetPaswordFormValidation" method="post" action="<?php echo base_url() ?>admin/login/resetpassword">
                <?php echo validation_errors(); ?>
                <?php echo $this->session->flashdata('error'); ?>

                        <p class="text-center text-success"><strong ><?php 
                echo get_cookie('message'); 
                delete_cookie('message'); 
                ?> </strong></p>
                
                <!--
                <div class="form-group has-feedback">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    <input type="text" name="email" class="form-control" placeholder="Email" />
                    
                </div>
                -->
                <div class="form-group has-feedback">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    <input type="password" name="password" id="passwordValidation" class="form-control" placeholder="New Password"/>
                    
                </div>
                <div class="form-group has-feedback">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    <input type="password" name="cpassword" class="form-control" placeholder="Confirm Password"/>
                    
                </div>
                <div class="form-group has-feedback">
                    <span class="glyphicon glyphicon-barcode form-control-feedback"></span>
                    <input type="text" name="generateotp" class="form-control" value="" placeholder="Verification code"/>
                    
                </div>

                <div class="form-group has-feedback">
                    <input type="submit" class="btn bg-green btn-block btn-flat" value="Submit">
                </div>
                <div class="row">

                    <div class="col-xs-12">

                    </div><!-- /.col -->
                </div>
            </form>
            <a href="<?php echo base_url() ?>admin/login" class="btn bg-blue btn-block btn-flat">Login </a><br> 
        </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

<script src="<?php echo base_url(); ?>assets/admin/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/admin/js/moment.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/js/select2.full.min.js"></script> 
<!-- All Form Validation Js-->
<script src="<?php echo base_url(); ?>assets/admin/js/jquery.validate.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/js/additional-methods.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/js/form-validation.js"></script> 

<!--<script src="<?php echo base_url(); ?>assets/admin/js/footer-resource.js" type="text/javascript"></script>-->
</body>
</html>