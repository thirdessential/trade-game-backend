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
                    <form role="form" class="form-vertical" id="activateIdForm" enctype="multipart/form-data" action="<?php echo base_url(); ?>user/userPanel/saveActivateId/" method="post">
                        <div class="row" id="translControl">
                            <div class="col-md-8 col-sm-12 col-xs-12 col-md-offset-2">
                                <div class="box-body">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <label for="userId">Type</label>
                                        <div class="form-group">
                                            <label>Activate ID &nbsp;
                                              <input type="radio" name="r3" class="flat-red" checked>
                                            </label> &nbsp; &nbsp; &nbsp;
                                        </div>
                                    </div>

                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <label for="userId">User Id</label>
                                        <div class="form-group">
                                            <input type="text"  name="userId" id="userId" placeholder="User Id" value="" class="form-control" autocomplete ="off">
                                            
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="name">User Name</label>
                                            <input type="text"  id="userName" autocomplete="off" placeholder="User Name" value=""  class="form-control" readonly="readonly">
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <label for="pin_value">Pin</label>
                                        <div class="form-group">
                                           
                                            <select name="pin_value" id="pin_value" class="form-control">
                                                <option value="">Select a pin</option>
                                                <?php if(!empty($un_used_pin)):
                                                   
                                                    foreach($un_used_pin as $v_pin): ?>

                                                    <option value="<?php echo $v_pin->pin_value;  ?>"><?php echo $v_pin->pin_value;  ?></option>

                                                <?php   endforeach;
                                                endif ?>
                                            </select>
                                            
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
</section>

<script type="text/javascript">
   $(document).ready(function(){

    $('#userId').keyup(function(){
        var userId = $(this).val();

        var link = $('body').data('baseurl');
            $.ajax({
                url: link + 'user/ajax/get_user_activated_id',
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
      //Red color scheme for iCheck
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-green'
    });
});
</script>