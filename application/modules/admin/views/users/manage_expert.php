<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary box-solid">
                <div class="box-header box-header-background with-border">
                    <h3 class="box-title"><?php echo $title ?></h3>
                    <div class="box-tools pull-right">
                        <a href="<?php echo base_url(); ?>admin/users/edit_expert" class="btn btn-warning">Add New</a>
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
                              <!-- <th class="active text-center">Status</th> -->

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
                                            <?php echo $v_user->id;  ?>
                                        </td>
                                        <td class="text-center"> <?php echo $v_user->firstName;  ?></td>
                                        <td class="text-center"> <?php echo $v_user->email ?></td>
                                         <td class="text-center"> <?php echo $v_user->mobile ?></td>
                                       
                                        <td class="text-center"><?php echo dateTimeFormat($v_user->created_at); ?></td>
                                        <td>
                                            <?php echo btn_edit('admin/users/edit_expert/' . $v_user->id); ?>
                                             <a class="btn btn-info btn-xs" href="<?php echo base_url(); ?>admin/show/show_by_user/<?php echo $v_user->id; ?>"><i class="fa fa-picture-o"></i></a>
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

