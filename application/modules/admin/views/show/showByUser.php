<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary box-solid">
                <div class="box-header box-header-background with-border">
                    <h3 class="box-title"><?php echo $title ?></h3>
                    <div class="box-tools pull-right">
                        <!-- <a href="<?php echo base_url(); ?>admin/type/edit_type" class="btn btn-warning">Add New</a> -->
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
                                <th class="active text-center">View</th>
                                <th class="active text-center">Downlaod</th>
                                <th class="active text-center">Comment</th>
                                <th class="active text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1 ?>
                            <?php if (!empty($all_show)): foreach ($all_show as $v_show) : ?>
                                    <tr>
                                        <td class="text-center"><?php echo $i ?></td>
                                        <td class="text-center"> <?php echo $v_show->title;  ?></td>
                                        <td class="text-center"> <?php echo $v_show->details ?></td>
                                        <td class="text-center"> <?php echo $v_show->totalView ?></td>
                                        <td class="text-center"> <?php echo $v_show->totalDownlaod ?></td>
                                        <td class="text-center"> <?php echo $v_show->totalComment ?></td>
                                       
                                        <td>
                                           <a class="btn btn-danger btn-xs" href="<?php echo base_url(); ?>admin/show/show_single/<?php echo $v_show->id; ?>"><i class="fa fa-eye"></i></a>
                                           <a class="btn btn-danger btn-xs" onclick="deleteData('admin/show/delete_show/<?php echo $v_show->id; ?>')"><i class="fa fa-trash-o"></i></a>
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

