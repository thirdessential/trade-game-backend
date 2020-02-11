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
                    <form role="form" class="form-vertical" id="usersForm" enctype="multipart/form-data" autocomplete="off" action="<?php echo base_url(); ?>admin/users/save_corporate/<?php
                    if (!empty($user_info->id)) {
                        echo $user_info->id;
                    }
                    ?>" method="post">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="box-body">
                                    <input type="hidden" id="usersId" value="<?php echo (!empty($user_info->id)) ? ($user_info->id) : ('') ?>">
                                    <div class="row">
                                        
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label for="name">Name</label>
                                                <input type="text"  name="name" autocomplete="off" placeholder="Name" value="<?php
                                                       if (!empty($user_info->firstName)) {
                                                           echo $user_info->firstName;
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
                                                       if (!empty($user_info->mobile)) {
                                                           echo $user_info->mobile;
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
                                                       if (!empty($user_info->email)) {
                                                           echo $user_info->email;
                                                       }
                                                       ?>"
                                                       class="form-control" autocomplete="off">
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <?php if (empty($user_info->id)) { ?>
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <div class="form-group">
                                                <label for="password">Password</label>
                                                <input type="password" name="password" id="password"  placeholder="Password"
                                                       class="form-control" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <div class="form-group">
                                                <label for="password">Confirm Password</label>
                                                <input type="password" name="confirm_password"  placeholder="Confirm Password"
                                                       class="form-control" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                    <?php } ?>
                                    
                                    

                                    
                                    <div class="row">
                                      
                                         <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="form-group col-md-4">
                                                <?php if (!empty($user_info->image)): ?>
                                                    <img id="blah" src="<?php echo base_url() . $user_info->image ?>" class="" width="100" height="80"/>
                                                <?php else: ?>
                                                    <img id="blah" src="<?php echo base_url() ?>assets/uploads/images/logo-white.png" width="50" height="50" alt="Image">
                                                <?php endif; ?>
                                            </div>
                                        
                                            <div class="form-group col-md-8">
                                                hidden  old_path when update
                                                <input type="hidden" name="old_path" id="old_path" value="<?php
                                                if (!empty($user_info->image)) {
                                                    echo $user_info->image;
                                                }
                                                ?>">
                                                <label for="image">Profile Image </label>
                                                <input type="file" onchange="readURL(this);" name="profile_picture"  accept="image/*">
                                                <p class="help-block">Max file size 2MB.</p>
                                                <em><strong>Note :</strong> Please use transparent PNG image for better resolution. </em>
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
            <?php if (!empty($user_info->id)) { ?>
                <div class="box box-primary box-solid">
                    <div class="box-header box-header-background with-border" >
                        <h3 class="box-title ">Change Password</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">  
                        <!-- form start -->
                        <form role="form" class="form-vertical" id="chngPassValidations" enctype="multipart/form-data" action="<?php echo base_url(); ?>admin/users/changepassword/<?php
                        if (!empty($user_info->id)) {
                            echo $user_info->id;
                        }
                        ?>" method="post">
                            <div class="row" id="translControl">
                                <div class="col-md-6 col-sm-12 col-xs-12 col-md-offset-3">
                                    <div class="box-body">

                                        <div class="form-group">
                                            <label for="offer">Password</label>
                                            <input type="password" name="password" id="password" placeholder="Password"
                                                   class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label for="offer">Confirm Password</label>
                                            <input type="password" name="cpassword" id="cpassword" placeholder="Confirm Password"
                                                   class="form-control">
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

<script type="text/javascript">
    
    $(document).ready(function(){

        $('#generate_new').click(function(){

            var link = $('body').data('baseurl');

            var userId = $('#userId').val();
            var id = $('#usersId').val();

            $.ajax({
                url : link + 'admin/ajax/generate_new_key',
                type : 'post',
                dataType : 'html',
                data:{ id : id },
                success : function(res){
                    $('#userId').val(res);
                    console.log(res);

                }

            });

        });
    });
</script>


