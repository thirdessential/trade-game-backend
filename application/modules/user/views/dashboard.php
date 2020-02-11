<!-- Main content -->
<section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-lg-12">
            <div class="callout callout-<?php echo (!empty($self_info->activateId))?('success'):('warning'); ?>">
                <h4>My Current Status :- <b><?php echo (!empty($self_info->activateId))?('Active'):('Inactive'); ?></b></h4>

            </div>
        </div>

        <div class="col-lg-12">
            <div class="callout callout-info">
                <h4>My Referel Id :- <?php echo base_url(); ?>?sponsored_id=<?php echo $this->session->userdata('userId') ?></h4>

            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3><?php echo $direct_active_member; ?></h3>

                    <p>Direct Active Team</p>
                </div>
                <div class="icon">
                    <i class="fa fa-user"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
                <div class="inner">
                    <h3><?php echo $direct_inactive_member; ?></h3>

                    <p>Direct In-active Team</p>
                </div>
                <div class="icon">
                    <i class="fa fa-user"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3>1</h3>

                    <p>My Current Level</p>
                </div>
                <div class="icon">
                    <i class="fa fa-list"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-red">
                <div class="inner">
                    <h3>0</h3>
                    <p>My Re-entry</p>
                </div>
                <div class="icon">
                    <i class="fa fa-list"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-red">
                <div class="inner">
                    <h3><?php echo $total_user; ?></h3>
                    <p>Total Member</p>
                </div>
                <div class="icon">
                    <i class="fa fa-list"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3><?php echo $total_used_pin; ?></h3>
                    <p>Total Used Pin</p>
                </div>
                <div class="icon">
                    <i class="fa fa-list"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
                <div class="inner">
                    <h3><?php echo $total_un_used_pin; ?></h3>
                    <p>Total Un-used Pin</p>
                </div>
                <div class="icon">
                    <i class="fa fa-list"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3><?php echo $total_transfer_pin; ?></h3>
                    <p>Total Transfer Pin</p>
                </div>
                <div class="icon">
                    <i class="fa fa-list"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="co-md-12 col-sm-12 col-lg-12 col-xs-12">
            <div class="box box-primary box-solid">

                <div class="box-header box-header-background with-border">
                    <h3 class="box-title"> Company Single Leg Status</h3>

                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table no-margin">
                            <thead>
                                <tr>
                                    <th>Level</th>
                                    <th>Product Purchase</th>
                                    <th>Direct Required</th>
                                    <th>Re-Entry</th>
                                    <th>Single Leg Income</th>
                                    <th>Sponser</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i= 1;
                                if(!empty($all_level)){
                                    foreach ($all_level as $value) { ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $value->product_purchase; ?> <?php echo ($i > 1)?('+'):(''); ?></td>
                                        <td><?php echo $value->direct_required; ?></td>
                                        <td><?php echo (!empty($value->re_entry))?($value->re_entry):('-'); ?></td>
                                        <td><?php echo (!empty($value->single_leg_income))?($value->single_leg_income):('-'); ?></td>
                                        <td><?php echo (!empty($value->sponser_income))?($value->sponser_income):('-'); ?></td>
                                        <td>
                                           <span class="label label-<?php echo  ($self_info->user_level >= $i)?('success'):('warning') ;?>"><?php echo  ($self_info->user_level >= $i)?('Confirm'):('Pending') ;?> </span>
                                            
                                            </td>
                                        
                                    </tr> 
                                <?php $i++; }

                                }
                                 ?>
                                
                                
                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.box-body -->
                <!-- <div class="box-footer clearfix">
                    <a href="javascript:void(0)" class="btn btn-sm btn-info btn-flat pull-left">Place New Order</a>
                    <a href="javascript:void(0)" class="btn btn-sm btn-default btn-flat pull-right">View All Orders</a>
                </div> -->
                <!-- /.box-footer -->
            </div>
        </div>

    </div>

    <div class="row">
        <div class="co-md-8 col-sm-8 col-lg-8 col-xs-8">
            <div class="box box-success box-solid">
                <div class="box-header box-header-background with-border">
                    <h3 class="box-title">My Profile</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Sponsor Id</label>
                            <div class="col-sm-10">
                                <input class="form-control" id="inputEmail3" placeholder="Sponsor Id" readonly="" value="<?php echo $this->session->userdata('parent_userId') ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">My Id</label>
                            <div class="col-sm-10">
                                <input class="form-control" id="inputEmail3" placeholder="My Id" readonly="" value="<?php echo $this->session->userdata('userId') ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Name</label>
                            <div class="col-sm-10">
                                <input class="form-control" id="inputEmail3" placeholder="Name" readonly="" value="<?php echo $this->session->userdata('name') ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Mobile</label>
                            <div class="col-sm-10">
                                <input class="form-control" id="inputEmail3" placeholder="Mobile" readonly="" value="<?php echo $this->session->userdata('contact_number') ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                            <div class="col-sm-10">
                                <input class="form-control" id="inputEmail3" placeholder="Email" readonly="" value="<?php echo $this->session->userdata('email') ?>">
                            </div>
                        </div>
                        
                    </div>
                    
                </form>
            </div>
        </div>
        <div class="co-md-4 col-sm-8 col-lg-4 col-xs-4">
            <div class="box box-warning box-solid">
                <div class="box-header box-header-background with-border">
                    <h3 class="box-title">Direct Members</h3>

                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <ul class="products-list product-list-in-box">
                    <?php
                        $i= 1;
                        if(!empty($all_memeber)){
                            foreach ($all_memeber as $value) { ?>
                        <li class="item">
                            <div class="product-img">
                                <img src="<?php echo base_url() ?>assets/uploads/images/logo-white.png" alt="Product Image">
                            </div>
                            <div class="product-info">
                                <a href="javascript:void(0)" class="product-title"><?php echo $value->name ?><br> [<?php echo $value->userId ?>]
                                    <span class="label label-<?php echo ($value->activateId != '')?('success'):('warning') ?> pull-right"><?php echo ($value->activateId != '')?('Active'):('Inactive') ?></span></a>
                                <span class="product-description">
                                    <?php echo $value->address ?>
                                </span>
                            </div>
                        </li>
                    <?php }

                        }
                     ?>
                        
                    </ul>
                </div>
                <!-- /.box-body -->
                <div class="box-footer text-center">
                    <a href="javascript:void(0)" class="uppercase">View All Members</a>
                </div>
                <!-- /.box-footer -->
            </div>
        </div>

    </div>
    <div class="row">
        <div class="co-md-12 col-sm-12 col-lg-12 col-xs-12">
            <div class="box box-primary box-solid">

                <div class="box-header box-header-background with-border">
                    <h3 class="box-title"> Company Single Leg Status</h3>

                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="innerAll">
                        <div class="tab-content ">
                            <div class="tab-pane active" id="Div1">
                                <div style="width:100%; text-align:justify; line-height:20px; background-color:#FFFFFF; border:solid 0px #4B4F4D; 
                                     border-radius:12px; padding:10px; font-size:10pt; color:#000000; ">
                                    <?php
                                        $i= 1;
                                        if(!empty($all_news)){
                                            foreach ($all_news as $value) { ?>

                                             <p><b style="color:#000099; font-size:12pt;"><i class="icon-paperclip"></i>&nbsp;<?php echo $value->title ?></b><br>
                                            <?php echo $value->description; ?>
                                    </p>
                                    <hr>

                                    <?php 
                                        $i++;
                                        }
                                    }
                                    ?>
                                    
                                </div>
                            </div>
                        </div>
                    </div>  
                </div>
                <!-- /.box-body -->
                <!-- <div class="box-footer clearfix">
                    <a href="javascript:void(0)" class="btn btn-sm btn-info btn-flat pull-left">Place New Order</a>
                    <a href="javascript:void(0)" class="btn btn-sm btn-default btn-flat pull-right">View All Orders</a>
                </div> -->
                <!-- /.box-footer -->
            </div>
        </div>

    </div>

</section>
<!-- /.content -->