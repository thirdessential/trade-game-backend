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
                    <form role="form" class="form-vertical" id="profileFormValidations" enctype="multipart/form-data" action="<?php echo base_url(); ?>admin/save_profile/<?php
                    if (!empty($profile_info->id)) {
                        echo $profile_info->id;
                    }
                    ?>" method="post">

                        <div class="row" id="translControl">
                        <input type="hidden" value="<?php echo $profile_info->id ?>" id="adminId">
                            <div class="col-md-6 col-sm-12 col-xs-12 col-md-offset-3">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="offer">Name*</label>
                                        <input type="text"  name="name" placeholder="Name"
                                               value="<?php
                                               if (!empty($profile_info->firstName)) {
                                                   echo $profile_info->firstName;
                                               }
                                               ?>"
                                               class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label for="offer">Contact Number*</label>
                                        <input type="text" name="contact_number" id="contact_number" placeholder="Contact Number"
                                               value="<?php
                                               if (!empty($profile_info->mobile)) {
                                                   echo $profile_info->mobile;
                                               }
                                               ?>"
                                               class="form-control" maxlength=12>
                                    </div>
                                    <div class="form-group">
                                        <label for="offer">Email*</label>
                                        <input type="text" name="email" id="email" autocomplete="off" placeholder="Email Id"
                                               value="<?php
                                               if (!empty($profile_info->email)) {
                                                   echo $profile_info->email;
                                               }
                                               ?>"
                                               class="form-control" >
                                    </div> 
                                   
                                    <div class="form-group">
                                        <label for="address">Address*</label>
                                        <textarea  name="address" placeholder="Address"class="form-control"><?php
                                            if (!empty($profile_info->address)) {
                                                echo $profile_info->address;
                                            }
                                            ?>
                                        </textarea>  
                                    </div>

                                    <div class="form-group col-md-4">
                                        <?php if (!empty($profile_info->image)): ?>
                                            <img id="blah" src="<?php echo base_url() . $profile_info->image ?>" class="" width="100" height="80"/>
                                        <?php else: ?>
                                            <img id="blah" src="<?php echo base_url() ?>assets/uploads/images/placeholder.png" width="50" height="50" alt="Image">
                                        <?php endif; ?>
                                    </div>

                                    <div class="form-group col-md-8">
                                        <!-- hidden  old_path when update  -->
                                        <input type="hidden" name="old_path" id="old_path" value="<?php
                                        if (!empty($profile_info->image)) {
                                            echo $profile_info->image;
                                        }
                                        ?>">
                                        <label for="image"> Image</label>
                                        <input type="file" onchange="readURL(this);" name="admin_images" >
                                        <p class="help-block"><?php echo $this->lang->line('max_file_size') ?></p>
                                        <em><strong>Note :</strong> Please use transparent PNG image for better resolution. </em>
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




