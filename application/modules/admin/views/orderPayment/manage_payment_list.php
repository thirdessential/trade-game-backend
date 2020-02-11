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
                                <th class="active text-center">Pay-tm</th>
                                <th class="active text-center">Tej</th>
                                <th class="active text-center">Total Amount</th>
                                <th class="active text-center">Admin Commission</th>
                                <th class="active text-center">TDS</th>
                                <th class="active text-center">Ren Entry Amount</th>
                                <th class="active text-center">Remaining Amount</th>
                                <th class="active text-center">Payment Type</th>
                                <th class="active text-center">Payment Status</th>
                                <th class="active text-center">Created On</th>
                                <th class="active text-center">Actions</th>
                                
                            </tr>
                        </thead> 
                        <tbody>
                            <?php $i = 1 ?>
                            <?php if (!empty($all_payment)): foreach ($all_payment as $v_payment) : ?>
                                    <tr>
                                        <td class="text-center"><?php echo $i ?></td>
                                        <td class="text-center"> <?php echo $v_payment->name;?> [<?php echo $v_payment->userId; ?>] </td>
                                         <td class="text-center"> <?php echo $v_payment->paytm_no ?></td>
                                         <td class="text-center"> <?php echo $v_payment->tej_no ?></td>
                                         <td class="text-center"> <?php echo $v_payment->total_amount ?></td>
                                        <td class="text-center"> <?php echo $v_payment->admin_commission ?></td>
                                         <td class="text-center"> <?php echo $v_payment->tds ?></td>
                                         <td class="text-center"> <?php echo $v_payment->re_entry_amount ?></td>
                                        <td class="text-center"> <?php echo $v_payment->remaining_amount;  ?></td>
                                         <td class="text-center"> <?php echo $v_payment->payment_type ?></td>
                                         <td class="text-center"><span class="label label-<?php echo ($v_payment->payment_status == 'Done')?('success'):('warning'); ?>"> <?php echo $v_payment->payment_status ?></span></td>
                                        
                                        <td class="text-center"><?php echo date('j M Y', strtotime($v_payment->created_at)); ?></td>

                                        <td>
                                           <?php  if($v_payment->payment_status == 'Done'):  ?>
                                            Already Transfer
                                        <?php else: ?>
                                            <?php echo btn_view_modal('admin/orderPayment/set_payment_status/' . $v_payment->id); ?>
                                        <?php endif; ?>    
                                          
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

