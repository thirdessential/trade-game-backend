<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary box-solid">
                <div class="box-header box-header-background with-border">
                    <h3 class="box-title"><?php echo $title ?></h3>
                    <div class="box-tools pull-right">
                        <a href="<?php echo base_url(); ?>admin/membership/edit_membership" class="btn btn-warning">Add New</a>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive">
                    <table id="dataTables-example" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="active text-center">No.</th>
                                <th class="active text-center">Title</th>
                                <th class="active text-center">Details</th>
                                <th class="active text-center">Image</th>
                                <th class="active text-center">Price</th>
                                <th class="active text-center">Days</th>
                                <th class="active text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1 ?>
                            <?php if (!empty($all_membership)): foreach ($all_membership as $v_user) : ?>
                                    <tr>
                                        <td class="text-center"><?php echo $i ?></td>
                                       <td class="text-center"> <?php echo $v_user->title;  ?></td>
                                        <td class="text-center"> <?php echo $v_user->details ?></td>
                                        <?php if($v_user->image){
                                            ?>
                                            <td class="text-center"> <img src='<?php echo base_url(); ?><?php echo $v_user->image ?>' style='width:100px'></td>
                                            <?php
                                        }else{
                                            ?>

                                            <td class="text-center"> <img src='<?php echo base_url(); ?>assets/uploads/users/No_Image_Available1.png' style='width:100px'></td>
                                            <?php
                                        } ?>
                                        
                                        <td class="text-center"> $<?php echo number_format($v_user->price,2) ?></td>
                                        <td class="text-center"> <?php echo $v_user->limitDays ?></td>
                                        <td>
                                            <?php echo btn_edit('admin/membership/edit_membership/' . $v_user->id); ?>
                                           <a class="btn btn-danger btn-xs" onclick="deleteData('admin/membership/delete_membership/<?php echo $v_user->id; ?>')"><i class="fa fa-trash-o"></i></a>
                                         <!--  <?php echo btn_view('admin/users/manage_users/'.$user_type.'/' . $v_user->id); ?> -->
                                          
                                        </td>
                                    </tr>
                                    <?php $i++; ?>
                                    <?php
                                endforeach;
                                ?><!--get all parents if not this empty-->
                            <?php else : ?> <!--get error message if this empty-->
                            <td colspan="8">
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

