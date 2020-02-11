<?php $loginId = $this->session->userdata('loginId'); ?> 
<header class="main-header">
    <!-- Logo -->
    <a href="<?php echo base_url() ?>admin" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>TG</b></span>
       
        <span class="logo-lg"><b>Trade</b>Game</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">

                <li class="dropdown user user-menu">
                    <?php $imag = $this->session->userdata('filename'); ?>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <?php if (!empty($imag) && file_exists(FCPATH . $imag)) : ?>
                            <img src="<?php echo base_url(); ?><?php echo $imag; ?>" class="user-image" alt="User Image">
                        <?php else: ?>
                            <img src="<?php echo base_url(); ?>assets/uploads/images/logo-white.png" class="user-image" alt="User Image">
                        <?php endif; ?>
                        <span class="hidden-xs"><?php echo ucfirst($this->session->userdata('name')); ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <?php if (!empty($imag) && file_exists(FCPATH . $imag)) : ?>
                                <img src="<?php echo base_url(); ?><?php echo $imag; ?>" class="img-circle" alt="User Image">
                            <?php else: ?>
                                <img src="<?php echo base_url(); ?>assets/uploads/images/logo-white.png" class="img-circle" alt="User Image">
                            <?php endif; ?>
                            <p>
                                <?php echo ucfirst($this->session->userdata('name')).' '; ?>
                                <small><?php echo $this->session->userdata('email'); ?></small>
                            </p>
                        </li>

                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="<?php echo base_url() ?>admin/edit_profile" class="btn btn-default btn-flat">Profile</a>
                                
                            </div>
                            <div class="pull-right">
                                <a href="<?php echo base_url() ?>admin/login/logout" class="btn btn-default btn-flat">Sign out</a>
                            </div>
                        </li>
                    </ul>
                </li>

            </ul>
        </div>
    </nav>
</header>