
<div class="user-panel">
    <div class="pull-left image">
        <?php $imag = $this->session->userdata('filename'); ?>
        <?php if (!empty($imag)&& file_exists(FCPATH . $imag)) : ?>
            <img src="<?php echo base_url(); ?><?php echo $imag; ?>" class="img-circle" alt="Admin Image">
        <?php else: ?>
            <img src="<?php echo base_url(); ?>assets/uploads/images/logo-white.png" class="img-circle" alt="Admin Image">
        <?php endif; ?>
    </div>
    <div class="pull-left info">
        <p><?php echo ucfirst($this->session->userdata('name')); ?></p>
        <a href="#"><i class="fa fa-circle text-success"></i>Online</a>
    </div>
</div>


<ul class="sidebar-menu" data-widget="tree">
    <li class="header">MAIN NAVIGATION</li>
    <li class="<?php echo (in_array($this->router->fetch_method(), array('dashboard'))) ? ('active') : (''); ?>"><a href="<?php echo base_url() . 'admin/dashboard'; ?>"><i class="fa fa-dashboard"></i><span>Dashboard</span></a></li>
    <li class="<?php echo (in_array($this->router->fetch_method(), array('manage_users','add_edit_users'))) ? ('active') : (''); ?>"><a href="<?php echo base_url() . 'admin/users/manage_users'; ?>"><i class="fa fa-users"></i><span>All Users List</span></a>
    </li>

     <li class="<?php echo (in_array($this->router->fetch_method(), array('manage_course','add_edit_course'))) ? ('active') : (''); ?>"><a href="<?php echo base_url() . 'admin/course/manage_course'; ?>"><i class="fa fa-book"></i><span>All Course List</span></a>
    </li>
    <li class="<?php echo (in_array($this->router->fetch_method(), array('manage_membership','add_edit_membership'))) ? ('active') : (''); ?>"><a href="<?php echo base_url() . 'admin/membership/manage_membership'; ?>"><i class="fa fa-address-card"></i><span>All Membership List</span></a>
    </li>
    
   
   
   
</ul>