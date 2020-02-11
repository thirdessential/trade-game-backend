<?php $this->load->view('admin/components/header'); ?>
<body class="hold-transition skin-blue sidebar-mini" data-baseurl="<?php echo base_url(); ?>">
    <div class="wrapper">

        <?php $this->load->view('admin/components/user_profile'); ?>

        <!-- Left side column. contains the logo and sidebar -->
        <aside class="main-sidebar">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">
                <!-- Sidebar user panel -->
                <?php $this->load->view('admin/components/navigation'); ?>

            </section>  
            <!-- /.sidebar -->
        </aside>

        <div class="content-wrapper">
            <section class="content-header">
                <h1>
                    <?php echo $title; ?>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active"><?php echo $title; ?></li>
                </ol>
            </section>
            <div class="container-fluid">
                <?php echo $subview ?>
            </div>

            <br />

        </div><!-- /.right-side -->

        <?php $this->load->view('admin/_layout_modal'); ?>
        <?php $this->load->view('admin/_layout_modal_small'); ?>
        <?php $this->load->view('admin/components/footer'); ?>
