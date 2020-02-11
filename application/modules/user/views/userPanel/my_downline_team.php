<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary box-solid">
                <div class="box-header box-header-background with-border">
                    <h3 class="box-title"><?php echo $title ?></h3>
                    
                </div>
                <!-- /.box-header -->
                <form role="form" class="form-vertical" id="usersForm" enctype="multipart/form-data" autocomplete="off" action="<?php echo base_url(); ?>user/userPanel/myTeam" method="post">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="box-body">
                                    <div class="row">

                                        <div class="col-md-4 col-sm-4 col-xs-4">
                                            <div class="form-group">
                                                <label for="name">Status</label>
                                                <select id="status" class="form-control" name="status">
                                                	<option value="">Select a status</option>
                                                	<option value="Active" <?php echo ($status =='Active')?('selected'):(''); ?>>Active</option>
                                                	<option value="Inactive" <?php echo ($status =='Inactive')?('selected'):(''); ?>>Inactive</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-4 col-xs-4">
                                            <div class="form-group">
                                                <label for="name">Level</label>
                                                <select id="level" class="form-control" name="level">
                                                	<option value="">Select a Level</option>
                                                	<?php for($i = 1; $i <= 20; $i++){ ?>
                                                		<option value="<?php echo $i ?>" <?php echo ($level ==$i)?('selected'):('') ?>><?php echo $i ?></option>
                                                	<?php } ?>
                                                	
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-4 col-sm-4 col-xs-4" style="margin-top: 25px">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary" name="submit" value="submit">Submit</button>
                                                <a href="<?php echo base_url() ?>user/userPanel/myTeam" class="btn btn-danger" >Reset</a>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </form>

                <div class="box-body table-responsive">
                    <table id="dataTables-example" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="active text-center">Sr.no</th>
                                <th class="active text-center">UserId</th>
                                <th class="active text-center">Name</th>
                                <th class="active text-center">Address</th>
                                <th class="active text-center">Kit</th>
                                <th class="active text-center">Level</th>
                                <th class="active text-center">Sponsor</th>
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
                                        <td class="text-center"> <?php echo $v_user->address ?></td>
                                        <td class="text-center"> Registration Pin</td>
                                        <td class="text-center"> 1 </td>
                                        <td class="text-center"> <?php echo $this->session->userdata('userId'); ?></td>
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

