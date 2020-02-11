<div class="user-panel">
    <div class="pull-left image">
        <?php $imag = $this->session->userdata('profile_picture'); ?>
        <?php if (!empty($imag)&& file_exists(FCPATH . $imag)) : ?>
            <img src="<?php echo base_url(); ?><?php echo $imag; ?>" class="img-circle" alt="User Image">
        <?php else: ?>
            <img src="<?php echo base_url(); ?>assets/uploads/images/logo-white.png" class="img-circle" alt="User Image">
        <?php endif; ?>
    </div>
    <div class="pull-left info">
        <p><?php echo ucfirst($this->session->userdata('name')); ?></p>
        <a href="#"><i class="fa fa-circle text-success"></i><?php echo $this->session->userdata('userId'); ?></a>
    </div>
</div>


<ul class="sidebar-menu" data-widget="tree">
    <li class="header">MAIN NAVIGATION</li>
    <li class="<?php echo (in_array($this->router->fetch_method(), array('dashboard'))) ? ('active') : (''); ?>"><a href="<?php echo base_url() . 'user/dashboard'; ?>"><i class="fa fa-dashboard"></i><span>Dashboard</span></a></li>

    <li class="<?php echo (in_array($this->router->fetch_method(), array('welcome_leter'))) ? ('active') : (''); ?>"><a href="<?php echo base_url() . 'user/userPanel/welcome_leter'; ?>"><i class="fa fa-users"></i><span>Welcome Later</span></a></li>

    <li class="<?php echo (in_array($this->router->fetch_method(), array('edit_profile'))) ? ('active') : (''); ?>"><a href="<?php echo base_url() . 'user/edit_profile'; ?>"><i class="fa fa-users"></i><span>My Profile</span></a></li>

    <li class="<?php echo (in_array($this->router->fetch_method(), array('add_edit_bank'))) ? ('active') : (''); ?>"><a href="<?php echo base_url() . 'user/bank/add_edit_bank'; ?>"><i class="fa fa-list"></i><span>Bank Account</span></a></li>

    <li class="<?php echo (in_array($this->router->fetch_method(), array('myDirectAccount'))) ? ('active') : (''); ?>"><a href="<?php echo base_url() . 'user/userPanel/myDirectMember'; ?>"><i class="fa fa-list"></i><span>My Direct Member</span></a></li>

    <li class="<?php echo (in_array($this->router->fetch_method(), array('activateId'))) ? ('active') : (''); ?>"><a href="<?php echo base_url() . 'user/userPanel/activateId'; ?>"><i class="fa fa-list"></i><span>Activate Id</span></a></li>
    
    <li class="<?php echo (in_array($this->router->fetch_method(), array('unUsedPin'))) ? ('active') : (''); ?>"><a href="<?php echo base_url() . 'user/userPanel/unUsedPin'; ?>"><i class="fa fa-list"></i><span>Un-Used Pin</span></a></li>

    <li class="<?php echo (in_array($this->router->fetch_method(), array('usedPin'))) ? ('active') : (''); ?>"><a href="<?php echo base_url() . 'user/userPanel/usedPin'; ?>"><i class="fa fa-list"></i><span>Used Pin</span></a></li>

    <li class="<?php echo (in_array($this->router->fetch_method(), array('transferPin'))) ? ('active') : (''); ?>"><a href="<?php echo base_url() . 'user/userPanel/transferPin'; ?>"><i class="fa fa-list"></i><span>Transfer Pin</span></a></li>

    <li class="<?php echo (in_array($this->router->fetch_method(), array('transferPinDetail'))) ? ('active') : (''); ?>"><a href="<?php echo base_url() . 'user/userPanel/transferPinDetail'; ?>"><i class="fa fa-list"></i><span>Transfer Pin Detail</span></a></li>

    <li class="<?php echo (in_array($this->router->fetch_method(), array('orderPaymentList'))) ? ('active') : (''); ?>"><a href="<?php echo base_url() . 'user/userPanel/orderPaymentList'; ?>"><i class="fa fa-list"></i><span>Payment Detail</span></a></li>

    <li class="<?php echo (in_array($this->router->fetch_method(), array('userReEntry'))) ? ('active') : (''); ?>"><a href="<?php echo base_url() . 'user/userPanel/userReEntry'; ?>"><i class="fa fa-list"></i><span>User Re-Entry</span></a></li>
   
   <li class=""><a href="javascript:void(0)"><i class="fa fa-list"></i><span>Payout Receive Detail</span></a></li>

</ul>