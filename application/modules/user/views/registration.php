<?php $this->load->view('user/components/header'); ?>
<body class="login-page" data-baseurl="<?php echo base_url(); ?>">
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

            <a href="<?php echo base_url() . 'user'; ?>" class="logo">Golden Future Life</a>
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body animated fadeInUp" data-animation="fadeInUp">
            <!-- <p class="login-box-msg">Sign in to start your session</p> -->
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
                    <input type="text" name="sponsored_id" id="userId" class="form-control" placeholder="Sponsored Id" />
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
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    <input type="text" name="tez_number"  class="form-control" placeholder="Tez Number" />
                </div>
                <div class="form-group has-feedback">
                    <input type="submit" class="btn bg-green btn-block btn-flat" value="Submit">
                </div>
                <div class="row">

                    <div class="col-xs-12">

                    </div><!-- /.col -->
                </div>
            </form>
           

        </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->
</body>
<script src="<?php echo base_url(); ?>assets/admin/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/admin/js/moment.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/js/select2.full.min.js"></script> 
<!-- All Form Validation Js-->
<script src="<?php echo base_url(); ?>assets/admin/js/jquery.validate.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/js/additional-methods.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/js/user-form-validation.js"></script> 
<script type="text/javascript">
 
$(document).ready(function(){

    $('#userId').keyup(function(){
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
 
});
</script>

<!--<script src="<?php echo base_url(); ?>assets/admin/js/footer-resource.js" type="text/javascript"></script>-->
</html>