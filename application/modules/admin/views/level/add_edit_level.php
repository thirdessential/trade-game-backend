<!--Massage-->
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>
<!--/ Massage-->

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary box-solid">
                <div class="box-header box-header-background with-border" >
                    <h3 class="box-title "><?php echo $title; ?></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <!-- form start -->
                    <form role="form" class="form-vertical" id="levelForm" enctype="multipart/form-data" action="<?php echo base_url(); ?>admin/level/save_level/<?php
                    if (!empty($level_info->id)) {
                        echo $level_info->id;
                    }
                    ?>" method="post">
                        <div class="row" id="translControl">
                            <div class="col-md-6 col-sm-12 col-xs-12 col-md-offset-3">
                                <div class="box-body">
                                   <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="team_size">Product Purchase</label>
                                            <input type="text"  name="product_purchase" placeholder="Product Purchase"
                                                   value="<?php if (!empty($level_info->product_purchase)) { echo $level_info->product_purchase;
                                                   }
                                                   ?>" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="team_size">Direct Required</label>
                                            <input type="text"  name="direct_required" placeholder="Direct Required"
                                                   value="<?php if (!empty($level_info->direct_required)) { echo $level_info->direct_required;
                                                   }
                                                   ?>" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="re_entry">Direct Required</label>
                                            <input type="text"  name="re_entry" placeholder="Re Entry"
                                                   value="<?php if (!empty($level_info->re_entry)) { echo $level_info->re_entry;
                                                   }
                                                   ?>" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="single_leg_income">Single Leg Income</label>
                                            <input type="text"  name="single_leg_income" placeholder="Single Leg Income" value="<?php if (!empty($level_info->single_leg_income)) { echo $level_info->single_leg_income; } ?>" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="sponser_income">Sponser Income</label>
                                            <input type="text"  name="sponser_income" placeholder="Sponser Income" value="<?php if (!empty($level_info->sponser_income)) { echo $level_info->sponser_income;
                                                   } ?>" class="form-control">
                                        </div>
                                    </div>

                                </div>
                                <!-- /.box-body -->
                                <div class="box-footer">
                                    <button type="submit" class="btn btn-primary" type="submit">Submit</button>
                                </div>
                            </div>
                        </div>
                    
                    </form>
                </div>   
            </div>
            
            <!-- /.box -->
        </div>
        <!--/.col end -->
    </div>
    <!-- /.row -->
</section>




