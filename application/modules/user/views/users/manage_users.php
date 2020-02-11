<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary box-solid">
                <div class="box-header box-header-background with-border">
                    <h3 class="box-title"><?php echo $title ?></h3>
                    <div class="box-tools pull-right">
                        <a href="<?php echo base_url(); ?>admin/users/edit_users" class="btn btn-warning">Add New</a>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive">
                    <table id="dataTables-example" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="active text-center">Id</th>
                                <th class="active text-center">UserId</th>
                                <th class="active text-center">Name</th>
                                <th class="active text-center">Emial</th>
                                 <th class="active text-center">Contact</th>
                                <th class="active text-center">Status</th>
                                <th class="active text-center">Create At</th>
                                <th class="active text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1 ?>
                            <?php if (!empty($all_users)): foreach ($all_users as $v_user) : ?>
                                    <tr>
                                        <td class="text-center"><?php echo $i ?></td>
                                        <td class="text-center">
                                            <?php echo $v_user->userId;  ?>
                                        </td>
                                        <td class="text-center"> <?php echo $v_user->name;  ?></td>
                                        <td class="text-center"> <?php echo $v_user->email ?></td>
                                         <td class="text-center"> <?php echo $v_user->contact_number ?></td>
                                        <td class="text-center"><a href="javascript:void(0)"  id="changeStatus-users-<?php echo $v_user->status ?>-<?php echo $v_user->id; ?>" class="btn btn-xs <?php echo ($v_user->status == 'Active') ? ('btn-success') : ('btn-danger'); ?>"> <?php echo ($v_user->status == 'Active') ? ('<i class="fa fa-thumbs-up"> Active</i>') : ('<i class="fa fa-thumbs-down"> Inactive</i>'); ?></a></td>
                                        <td class="text-center"><?php echo date('j M Y g:i A', strtotime($v_user->created_at)); ?></td>
                                        <td><?php //echo btn_list('admin/user/manage_user_address/' . $v_user->id);        ?>

                                            <?php echo btn_edit('admin/users/edit_users/' . $v_user->id); ?>
                                            <?php echo btn_delete('admin/users/delete_users/' . $v_user->id); ?>
                                            <?php echo btn_view('admin/users/manage_users/' . $v_user->id); ?>
                                          
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

