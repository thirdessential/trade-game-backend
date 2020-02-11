<!-- Main content -->
<section class="content">
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
                                <th class="active text-center">User Name</th>
                                <th class="active text-center">Account Holder Name</th>
                                <th class="active text-center">Account Number</th>
                                <th class="active text-center">Bank Name</th>
                                <th class="active text-center">Bank Location</th>
                                <th class="active text-center">IFSC Number</th>
                                <th class="active text-center">Pan Number</th>
                                <th class="active text-center">Status</th>
                                <th class="active text-center">Create At</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1 ?>
                            <?php if (!empty($all_bank)): foreach ($all_bank as $v_bank) : ?>
                                    <tr>
                                        <td class="text-center"><?php echo $i ?></td>
                                        <td class="text-center"> <?php echo $v_bank->name;  ?></td>
                                        <td class="text-center"> <?php echo $v_bank->account_holder_name;  ?></td>
                                        <td class="text-center"> <?php echo $v_bank->account_number ?></td>
                                         <td class="text-center"> <?php echo $v_bank->bank_name ?></td>
                                         <td class="text-center"> <?php echo $v_bank->branch_location ?></td>
                                         <td class="text-center"> <?php echo $v_bank->ifsc_number ?></td>
                                         <td class="text-center"> <?php echo $v_bank->pan_number ?></td>
                                         <td class="text-center"><span class="label label-<?php echo ($v_bank->status == 'Active')?('success'):('warning'); ?>"> <?php echo $v_bank->status ?></span></td>
                                        
                                        <td class="text-center"><?php echo date('j M Y', strtotime($v_bank->created_at)); ?></td>
                                        
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

