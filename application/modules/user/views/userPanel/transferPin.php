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
                    <form role="form" class="form-vertical" id="transferForm" enctype="multipart/form-data" autocomplete="off" action="<?php echo base_url(); ?>user/userPanel/save_transfer_pin" method="post">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <div class="form-group">
                                                <label for="account_holder_name">Transfer User Id</label>
                                                <input type="text"  name="userId" id="userId" autocomplete="off" placeholder="User Id" value=""  class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                            <div class="form-group">
                                                <label for="name">User Name</label>
                                                <input type="text"  id="userName" autocomplete="off" placeholder="User Name" value=""  class="form-control" readonly="readonly">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <label for="userId">Transfer Pin</label>
                                            <div class="form-group">
                                                <?php if($un_used_transfer_pin){
                                                    foreach ($un_used_transfer_pin as  $value) { ?>
                                                    
                                                    <label> <?php echo $value->pin_value ?> &nbsp;
                                                        <input type="checkbox" class="flat-red"  value="<?php echo $value->id; ?>" name="pinId[]" id="pinId">
                                                    </label> &nbsp; &nbsp; &nbsp;


                                                <?php   }

                                                }else{  ?>
                                                   <h3> No Record Found</h3>
                                              <?php  } ?>
                                                
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
           
            <!-- /.box -->
        </div>
        <!--/.col end -->
    </div>
    <!-- /.row -->
</section>
<script type="text/javascript"> 
$(document).ready(function(){

    $('#userId').keyup(function(){
        var userId = $(this).val();

        var link = $('body').data('baseurl');
            $.ajax({
                url: link + 'user/ajax/get_user_id_name',
                type: 'post',
                dataType: 'html',
                data: {
                    userId: userId, tbl :'users'
                },
                success: function (msg)
                {
                    if(msg == 0){
                       
                    $('#userName').val('');
                    }else{
                    $('#userName').val(msg);

                    }
                }

            });
    });
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-green'
    });
});
</script>