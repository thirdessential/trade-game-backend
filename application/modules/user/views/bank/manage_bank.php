<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary box-solid">
                <div class="box-header box-header-background with-border">
                    <h3 class="box-title"><?php echo $title ?></h3>
                    <div class="box-tools pull-right">
                        <a href="<?php echo base_url(); ?>user/bank/add_edit_bank" class="btn btn-warning">Add New</a>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive">
                    <table id="dataTables-example" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="active text-center">Sr.no</th>
                                <th class="active text-center">Account Holder Name</th>
                                <th class="active text-center">Account Number</th>
                                <th class="active text-center">Bank Name</th>
                                <th class="active text-center">Bank Location</th>
                                <th class="active text-center">IFSC Number</th>
                                <th class="active text-center">Pan Number</th>
                                <th class="active text-center">Status</th>
                                <th class="active text-center">Create At</th>
                                <th class="active text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1 ?>
                            <?php if (!empty($all_bank)): foreach ($all_bank as $v_bank) : ?>
                                    <tr>
                                        <td class="text-center"><?php echo $i ?></td>
                                        <td class="text-center"> <?php echo $v_bank->account_holder_name;  ?></td>
                                        <td class="text-center"> <?php echo $v_bank->account_number ?></td>
                                         <td class="text-center"> <?php echo $v_bank->bank_name ?></td>
                                         <td class="text-center"> <?php echo $v_bank->branch_location ?></td>
                                         <td class="text-center"> <?php echo $v_bank->ifsc_number ?></td>
                                         <td class="text-center"> <?php echo $v_bank->pan_number ?></td>
                                        <td class="text-center"><a href="javascript:void(0)"  id="changeStatus-bank_account-<?php echo $v_bank->status ?>-<?php echo $v_bank->id; ?>" class="btn btn-xs <?php echo ($v_bank->status == 'Active') ? ('btn-success') : ('btn-danger'); ?>"> <?php echo ($v_bank->status == 'Active') ? ('<i class="fa fa-thumbs-up"> Active</i>') : ('<i class="fa fa-thumbs-down"> Inactive</i>'); ?></a></td>
                                        <td class="text-center"><?php echo date('j M Y g:i A', strtotime($v_bank->created_at)); ?></td>
                                        <td>
                                            <?php echo btn_edit('user/bank/add_edit_bank/' . $v_bank->id); ?>
                                            <?php echo btn_delete('user/bank/delete_bank/' . $v_bank->id); ?>
                                            
                                        </td>
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

