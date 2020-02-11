<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary box-solid">
                <div class="box-header box-header-background with-border">
                    <h3 class="box-title"><?php echo $title ?></h3>
                    <div class="box-tools pull-right">
                        <a href="<?php echo base_url(); ?>admin/level/add_edit_level" class="btn btn-warning">Add New</a>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive">
                    <table id="dataTables-example" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="active text-center">Id</th>
                                <th class="active text-center">Product Purchase</th>
                                <th class="active text-center">Direct Required</th>
                                <th class="active text-center">Re-entry</th>
                                <th class="active text-center">Single Leg Income</th>
                                <th class="active text-center">Sponser Income</th>
                                <!-- <th class="active text-center">Action</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1 ?>
                            <?php if (!empty($all_level)): foreach ($all_level as $v_level) : ?>
                                    <tr>
                                        <td class="text-center"><?php echo $i ?></td>
                                        <td class="text-center"> <?php echo $v_level->product_purchase ?></td>
                                        <td class="text-center"> <?php echo $v_level->direct_required ?></td>
                                        <td class="text-center"> <?php echo $v_level->re_entry ?></td>
                                        <td class="text-center"> <?php echo $v_level->single_leg_income ?></td>
                                        <td class="text-center"> <?php echo $v_level->sponser_income ?></td>
                                        <!-- <td class="text-center"><a href="javascript:void(0)"  id="changeStatus-level-<?php echo $v_level->status ?>-<?php echo $v_level->id; ?>" class="btn btn-xs <?php echo ($v_level->status == 'Active') ? ('btn-success') : ('btn-danger'); ?>"> <?php echo ($v_level->status == 'Active') ? ('<i class="fa fa-thumbs-up"> Active</i>') : ('<i class="fa fa-thumbs-down"> Inactive</i>'); ?></a></td>
                                        <td class="text-center"><?php echo dateTimeFormat($v_level->created_at); ?></td> -->
                                       <!--  <td>

                                            <?php echo btn_edit('admin/level/add_edit_level/' . $v_level->id); ?>
                                            <?php echo btn_delete('admin/level/delete_level/' . $v_level->id); ?>
                                          
                                        </td> -->
                                    </tr>
                                    <?php $i++; ?>
                                    <?php
                                endforeach;
                                ?><!--get all level if not this empty-->
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

