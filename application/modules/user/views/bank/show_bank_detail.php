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
                    
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="box-body">
                                    
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <div class="form-group">
                                                <label for="account_holder_name">Account Holder Name</label>
                                                <input type="text"  name="account_holder_name" autocomplete="off" placeholder="Account Holder Name" value="<?php
                                                       if (!empty($bank_info->account_holder_name)) {
                                                           echo $bank_info->account_holder_name;
                                                       }
                                                       ?>"
                                                       class="form-control" disabled="disabled" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <div class="form-group">
                                                <label for="name">Account Number</label>
                                                <input type="text"  name="account_number" id="account_number" autocomplete="off" placeholder="Account Number" value="<?php
                                                       if (!empty($bank_info->account_number)) {
                                                           echo $bank_info->account_number;
                                                       }
                                                       ?>"
                                                       class="form-control" disabled="disabled" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <div class="form-group">
                                                <label for="bank_name">Bank Name</label>
                                                <input type="text" name="bank_name"  id="bank_name" placeholder="Bank Name"
                                                       value="<?php
                                                       if (!empty($bank_info->bank_name)) {
                                                           echo $bank_info->bank_name;
                                                       }
                                                       ?>"
                                                       class="form-control" maxlength=12 autocomplete="off" disabled="disabled" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <div class="form-group">
                                                <label for="branch_location">Branch Location </label>
                                                <input type="text" name="branch_location" id="branch_location" placeholder="Branch Location"
                                                       value="<?php
                                                       if (!empty($bank_info->branch_location)) {
                                                           echo $bank_info->branch_location;
                                                       }
                                                       ?>"
                                                       class="form-control" autocomplete="off" disabled="disabled" readonly>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <div class="form-group">
                                                <label for="ifsc_number">IFSC Number </label>
                                                <input type="text" name="ifsc_number" id="ifsc_number" placeholder="IFSC Number"
                                                       value="<?php
                                                       if (!empty($bank_info->ifsc_number)) {
                                                           echo $bank_info->ifsc_number;
                                                       }
                                                       ?>"
                                                       class="form-control" autocomplete="off" disabled="disabled" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <div class="form-group">
                                                <label for="pan_number">PAN Number </label>
                                                <input type="text" name="pan_number" id="pan_number" placeholder="PAN Number"
                                                       value="<?php
                                                       if (!empty($bank_info->pan_number)) {
                                                           echo $bank_info->pan_number;
                                                       }
                                                       ?>"
                                                       class="form-control" autocomplete="off" disabled="disabled" readonly>
                                            </div>
                                        </div>
                                    </div>
                                   
                                </div>
                                
                            </div>
                        </div>
                </div>   
            </div>
           
            <!-- /.box -->
        </div>
        <!--/.col end -->
    </div>
    <!-- /.row -->
</section>
