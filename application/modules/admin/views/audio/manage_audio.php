<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary box-solid">
                <div class="box-header box-header-background with-border">
                    <h3 class="box-title"><?php echo $title ?></h3>
                    <div class="box-tools pull-right">
                        <a href="<?php echo base_url(); ?>admin/audio/edit_audio" class="btn btn-warning">Add New</a>
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
                                <th class="active text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1 ?>
                            <?php if (!empty($all_video)): foreach ($all_video as $v_user) : ?>
                                    <tr>
                                        <td class="text-center"><?php echo $i ?></td>
                                       <td class="text-center"> <?php echo $v_user->title;  ?></td>
                                        <td class="text-center"> <?php echo $v_user->details ?></td>
                                        <?php if($v_user->profile_image){
                                            ?>
                                            <td class="text-center"> <img src='<?php echo base_url(); ?><?php echo $v_user->profile_image ?>' style='width:100px'></td>
                                            <?php
                                        }else{
                                            ?>
                                            <td class="text-center"> <img src='<?php echo base_url(); ?>assets/uploads/users/No_Image_Available1.png' style='width:100px'></td>
                                            <?php
                                        } ?>
                                        
                                       
                                        <td>
                                            <?php echo btn_edit('admin/audio/edit_audio/' . $v_user->id); ?>
                                          
                                           <a class="btn btn-danger btn-xs" onclick="deleteData('admin/audio/delete_audio/<?php echo $v_user->id; ?>')"><i class="fa fa-trash-o"></i></a>
                                        
                                          
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

