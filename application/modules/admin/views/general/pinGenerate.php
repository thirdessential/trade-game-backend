<!-- Main content -->
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
                    <form role="form" class="form-vertical" id="pinGeneratForm" enctype="multipart/form-data" action="<?php echo base_url(); ?>admin/general/save_pin/<?php
                    if (!empty($pin_info->id)) {
                        echo $pin_info->id;
                    }
                    ?>" method="post">
                    <input type="hidden" name="pin_id" id="pin_id"  value="<?php echo (!empty($pin_info->id))?($pin_info->id):('') ?>">
                        <div class="row" id="translControl">
                            <div class="col-md-8 col-sm-12 col-xs-12 col-md-offset-2">
                                <div class="box-body">
                                   
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label for="quantity">Quantity</label>
                                                <input type="text"  name="quantity" autocomplete="off" placeholder="Quantity" value="" max='100'
                                                       class="form-control">
                                            </div>
                                        </div>
                                   <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="tilte">User</label>
                                            <select id="userId" class="form-control" name="userId">
                                                <option value="">Select a user</option>
                                            <?php if(!empty($all_member)){
                                                foreach ($all_member as $value) {  ?>
                                                  <option value="<?php echo $value->id ?>"><?php echo $value->name ?> (<?php echo $value->userId ?>)</option> 
                                             <?php   }
                                            } ?>
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
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary box-solid">
                <div class="box-header box-header-background with-border">
                    <h3 class="box-title"><?php echo $title ?></h3>
                    
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive">
                    <table id="dataTables-example" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="active text-center">Sr.no</th>
                                <th class="active text-center">Send User Name</th>
                                <th class="active text-center">Pin Value</th>
                                <th class="active text-center">Transfer User Name</th>
                                <th class="active text-center">Activate User Name</th>
                                <th class="active text-center">Created On</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1 ?>
                            <?php if (!empty($all_pin)): foreach ($all_pin as $v_pin) : ?>
                                    <tr>
                                        <td class="text-center"><?php echo $i ?></td>
                                        <td class="text-center"> <?php echo $v_pin->send_user_name;  ?></td>
                                        <td class="text-center"> <?php echo $v_pin->pin_value;  ?></td>
                                        <td class="text-center"> <?php echo (!empty($v_pin->transfer_user_name))?($v_pin->transfer_user_name):('N/A'); ?></td>
                                         <td class="text-center"> <?php echo (!empty($v_pin->activate_user_name))?($v_pin->activate_user_name):('N/A'); ?></td>
                                         <td class="text-center"><?php echo date('j M Y', strtotime($v_pin->created_at)); ?></td>
                                        
                                    </tr>
                                    <?php $i++; ?>
                                    <?php
                                endforeach;
                                ?><!--get all parents if not this empty-->
                            <?php else : ?> <!--get error message if this empty-->
                            <td colspan="10">
                                <strong>No Record Found</strong>
                            </td><!--/ get error message if this empty-->
                        <?php endif; ?>
                        </tbody>

                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
<!-- /.content -->

<script type="text/javascript">
    
    $(document).ready(function(){

        $('#generate_new').click(function(){

            var link = $('body').data('baseurl');

            var id = $('#pin_id').val();

            $.ajax({
                url : link + 'admin/ajax/generate_pin_value',
                type : 'post',
                dataType : 'html',
                data:{ id : id },
                success : function(res){
                    $('#pin_value').val(res);
                    
                }

            });

        });
    });
</script>