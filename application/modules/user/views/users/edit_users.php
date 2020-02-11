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
                    <form role="form" class="form-vertical" id="usersForm" enctype="multipart/form-data" autocomplete="off" action="<?php echo base_url(); ?>admin/users/save_users/<?php
                    if (!empty($user_info->id)) {
                        echo $user_info->id;
                    }
                    ?>" method="post">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="box-body">
                                    <input type="hidden" id="usersId" value="<?php echo (!empty($user_info->id)) ? ($user_info->id) : ('') ?>">
                                    <div class="row">

                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                                <label for="userId">UserId</label>
                                            <div class="input-group input-group-sm">
                                                <input type="text"  name="userId" id="userId" placeholder="userId" value="<?php
                                                       if (!empty($user_info->userId)) {
                                                           echo $user_info->userId;
                                                       }else{
                                                        echo 'DK'.rand(11111, 999999);
                                                       }
                                                       ?>"
                                                       class="form-control" autocomplete ="off" readonly>
                                                <span class="input-group-btn">
                                                  <button type="button" id="generate_new" class="btn btn-info btn-flat">Generate!</button>
                                                </span>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <div class="form-group">
                                                <label for="name">Name</label>
                                                <input type="text"  name="name" autocomplete="off" placeholder="Name" value="<?php
                                                       if (!empty($user_info->name)) {
                                                           echo $user_info->name;
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
                                                       if (!empty($user_info->contact_number)) {
                                                           echo $user_info->contact_number;
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
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <div class="form-group">
                                                <label for="address">Address </label>
                                                <input type="text" name="address" id="address" placeholder="Address"
                                                       value="<?php
                                                       if (!empty($user_info->address)) {
                                                           echo $user_info->address;
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
                                                       if (!empty($user_info->place_of_living)) {
                                                           echo $user_info->place_of_living;
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
                                                       if (!empty($user_info->nominee_name)) {
                                                           echo $user_info->nominee_name;
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
                                                       if (!empty($user_info->nominee_relation)) {
                                                           echo $user_info->nominee_relation;
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
                                                       if (!empty($user_info->paytm_no)) {
                                                           echo $user_info->paytm_no;
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
                                                       if (!empty($user_info->tej_no)) {
                                                           echo $user_info->tej_no;
                                                       }
                                                       ?>"
                                                       class="form-control" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <div class="form-group col-md-4">
                                                <?php if (!empty($user_info->profile_picture)): ?>
                                                    <img id="blah" src="<?php echo base_url() . $user_info->profile_picture ?>" class="" width="100" height="80"/>
                                                <?php else: ?>
                                                    <img id="blah" src="<?php echo base_url() ?>assets/uploads/images/placeholder.png" width="50" height="50" alt="Image">
                                                <?php endif; ?>
                                            </div>

                                            <div class="form-group col-md-8">
                                                <!-- hidden  old_path when update  -->
                                                <input type="hidden" name="old_path" id="old_path" value="<?php
                                                if (!empty($user_info->profile_picture)) {
                                                    echo $user_info->profile_picture;
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


