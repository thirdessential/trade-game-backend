<!--Massage-->
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>
<!--/ Massage-->


<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary box-solid">
                <div class="box-header box-header-background with-border">
                    <h3 class="box-title "><?php echo $title ?></h3>
                </div>

                <!-- /.box-header -->
                <div class="box-body">
                    <!-- form start -->
                    <form role="form" class="form-vertical" id="profileFormValidations" enctype="multipart/form-data" action="<?php echo base_url(); ?>user/save_profile/<?php
                    if (!empty($profile_info->id)) {
                        echo $profile_info->id;
                    }
                    ?>" method="post">

                        <div class="row" id="translControl">
                        <input type="hidden" value="<?php echo $profile_info->id ?>" id="adminId">
                            <div class="col-md-12 col-sm-12 col-xs-12 ">
                                <div class="box-body">
                                     <div class="row">

                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                                <label for="userId">UserId</label>
                                            <div class="form-group input-group-sm">
                                                <input type="text"  placeholder="userId" value="<?php
                                                       if (!empty($profile_info->userId)) {
                                                           echo $profile_info->userId;
                                                       }
                                                       ?>"
                                                       class="form-control" autocomplete ="off" readonly>
                                                
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <div class="form-group">
                                                <label for="name">Name</label>
                                                <input type="text"  name="name" autocomplete="off" placeholder="Name" value="<?php
                                                       if (!empty($profile_info->name)) {
                                                           echo $profile_info->name;
                                                       }
                                                       ?>"
                                                       class="form-control">
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <div class="form-group">
                                                <label for="contact_number">Contact Number</label>
                                                <input type="text" name="contact_number"  id="contact_number" placeholder="Contact Number"
                                                       value="<?php
                                                       if (!empty($profile_info->contact_number)) {
                                                           echo $profile_info->contact_number;
                                                       }
                                                       ?>"
                                                       class="form-control" maxlength=12 autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <div class="form-group">
                                                <label for="email_id">Email </label>
                                                <input type="text" name="email" id="email" placeholder="Email"
                                                       value="<?php
                                                       if (!empty($profile_info->email)) {
                                                           echo $profile_info->email;
                                                       }
                                                       ?>"
                                                       class="form-control" autocomplete="off">
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <div class="form-group">
                                                <label for="address">Address </label>
                                                <input type="text" name="address" id="address" placeholder="Address"
                                                       value="<?php
                                                       if (!empty($profile_info->address)) {
                                                           echo $profile_info->address;
                                                       }
                                                       ?>"
                                                       class="form-control" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <div class="form-group">
                                                <label for="place_of_living">Place of Living </label>
                                                <input type="text" name="place_of_living" id="place_of_living" placeholder="Place Of Living"
                                                       value="<?php
                                                       if (!empty($profile_info->place_of_living)) {
                                                           echo $profile_info->place_of_living;
                                                       }
                                                       ?>"
                                                       class="form-control" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <div class="form-group">
                                                <label for="email_id">nominee_name </label>
                                                <input type="text" name="nominee_name" id="nominee_name" placeholder="Nominee"
                                                       value="<?php
                                                       if (!empty($profile_info->nominee_name)) {
                                                           echo $profile_info->nominee_name;
                                                       }
                                                       ?>"
                                                       class="form-control" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <div class="form-group">
                                                <label for="nominee_relation">Nominee Relation</label>
                                                <input type="text" name="nominee_relation" id="nominee_relation" placeholder="Nominee Relation"
                                                       value="<?php
                                                       if (!empty($profile_info->nominee_relation)) {
                                                           echo $profile_info->nominee_relation;
                                                       }
                                                       ?>"
                                                       class="form-control" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <div class="form-group">
                                                <label for="paytm_no">Paytm Number </label>
                                                <input type="text" name="paytm_no" id="paytm_no" placeholder="Paytm Number"
                                                       value="<?php
                                                       if (!empty($profile_info->paytm_no)) {
                                                           echo $profile_info->paytm_no;
                                                       }
                                                       ?>"
                                                       class="form-control" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <div class="form-group">
                                                <label for="tej_no">Tej Number</label>
                                                <input type="text" name="tej_no" id="tej_no" placeholder="Tej Number"
                                                       value="<?php
                                                       if (!empty($profile_info->tej_no)) {
                                                           echo $profile_info->tej_no;
                                                       }
                                                       ?>"
                                                       class="form-control" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                      <div class="col-md-6 col-sm-6 col-xs-6">
                                            <div class="form-group">
                                                <label for="payphone">Pay Phone</label>
                                                <input type="text" name="payphone" id="payphone" placeholder="Pay Phone"
                                                       value="<?php
                                                       if (!empty($profile_info->payphone)) {
                                                           echo $profile_info->payphone;
                                                       }
                                                       ?>"
                                                       class="form-control" autocomplete="off">
                                            </div>
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


            <?php if (!empty($profile_info->id)) { ?>
                <div class="box box-primary box-solid">
                    <div class="box-header box-header-background with-border">
                        <h3 class="box-title ">Change Password</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <!-- form start -->
                        <form role="form" class="form-vertical" id="changePasswordValidations" enctype="multipart/form-data" action="<?php echo base_url(); ?>admin/change_password/<?php
                        if (!empty($profile_info->id)) {
                            echo $profile_info->id;
                        }
                        ?>" method="post">
                            <div class="row" id="translControl">
                                <div class="col-md-6 col-sm-12 col-xs-12 col-md-offset-3">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="offer"> Old Password *</label>
                                            <input type="password" name="old_password" id="password" placeholder="Old Password"
                                                   class="form-control" maxlength=20>
                                        </div>
                                        <div class="form-group">
                                            <label for="offer"> New Password *</label>
                                            <input type="password" name="new_password" id="passwordvalidation" placeholder="New Password"
                                                   class="form-control" maxlength=20>
                                        </div>

                                        <div class="form-group">
                                            <label for="offer">Confirm Password*</label>
                                            <input type="password" name="c_password" id="cpasswordvalidation"  placeholder="Confirm Password"
                                                   class="form-control" maxlength=20>
                                        </div>



                                    </div>
                                    <!-- /.box-body -->
                                    <div class="box-footer">
                                        <button type="submit" class="btn btn-primary" type="submit">Change Password</button>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>   
                </div>
            <?php } ?>
            <!-- /.box -->
        </div>
        <!--/.col end -->
    </div>
    <!-- /.row -->
</section>




