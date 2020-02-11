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
                                <th class="active text-center">UserId</th>
                                <th class="active text-center">Name</th>
                                <th class="active text-center">Email</th>
                                <th class="active text-center">Contact</th>
                                <th class="active text-center">Address</th>
                                <th class="active text-center">Activate Pin</th>
                                <th class="active text-center">Date of join</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1 ?>
                            <?php if (!empty($all_member)): foreach ($all_member as $v_user) : ?>
                                    <tr>
                                        <td class="text-center"><?php echo $i ?></td>
                                        <td class="text-center">
                                            <?php echo $v_user->userId;  ?>
                                        </td>
                                        <td class="text-center"> <?php echo $v_user->name;  ?></td>
                                        <td class="text-center"> <?php echo $v_user->email ?></td>
                                        <td class="text-center"> <?php echo $v_user->contact_number ?></td>
                                        <td class="text-center"> <?php echo $v_user->address ?></td>
                                        <td class="text-center"> <?php echo (!empty($v_user->activateId))?($v_user->activateId):('Not Generate') ?></td>
                                        <td class="text-center"><?php echo date('j M Y', strtotime($v_user->created_at)); ?></td>
                                        
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

