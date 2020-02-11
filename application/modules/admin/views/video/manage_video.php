<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary box-solid">
                <div class="box-header box-header-background with-border">
                    <h3 class="box-title"><?php echo $title ?></h3>
                    <div class="box-tools pull-right">
                        <a href="<?php echo base_url(); ?>admin/video/edit_video" class="btn btn-warning">Add New</a>
                    </div>
                </div>
                <!-- /.box-header -->
                 <ul class="nav nav-tabs">
				    <li class="active"><a data-toggle="tab" href="#home">All</a></li>
				    <li><a data-toggle="tab" href="#tv">TV Show</a></li>
				    <li><a data-toggle="tab" href="#featured">Featured</a></li>
				    <li><a data-toggle="tab" href="#movies">Movies</a></li>
				 </ul>

                <div class="box-body table-responsive">
                	<div class="tab-content">
                		<div id="home" class="tab-pane fade in active">
		                    <table  class="table table-bordered table-striped exampletable">
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
		                            <?php if (!empty($all_video)): foreach ($all_video as $v_user) : 
                           
		                            	?>
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
		                                            <?php echo btn_edit('admin/video/edit_video/' . $v_user->id); ?>
		                                           <a class="btn btn-danger btn-xs" onclick="deleteData('admin/video/delete_video/<?php echo $v_user->id; ?>')"><i class="fa fa-trash-o"></i></a>
		                                         <!--  <?php echo btn_view('admin/users/manage_users/'.$user_type.'/' . $v_user->id); ?> -->
		                                          
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
		                <div id="tv" class="tab-pane fade">
		                    <table  class="table table-bordered table-striped exampletable">
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
		                            <?php if (!empty($all_video)): foreach ($all_video as $v_user) : 
                                        if($v_user->cat_id == 2){
		                            	?>
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
		                                            <?php echo btn_edit('admin/video/edit_video/' . $v_user->id); ?>
		                                          <a class="btn btn-danger btn-xs" onclick="deleteData('admin/video/delete_video/<?php echo $v_user->id; ?>')"><i class="fa fa-trash-o"></i></a>
		                                         <!--  <?php echo btn_view('admin/users/manage_users/'.$user_type.'/' . $v_user->id); ?> -->
		                                          
		                                        </td>
		                                    </tr>
		                                    <?php $i++; } ?>
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
		                <div id="featured" class="tab-pane fade ">
		                    <table  class="table table-bordered table-striped exampletable">
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
		                            <?php if (!empty($all_video)): foreach ($all_video as $v_user) : 
		                            	if($v_user->cat_id == 3){
		                            	?>
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
		                                            <?php echo btn_edit('admin/video/edit_video/' . $v_user->id); ?>
		                                           <a class="btn btn-danger btn-xs" onclick="deleteData('admin/video/delete_video/<?php echo $v_user->id; ?>')"><i class="fa fa-trash-o"></i></a>
		                                         <!--  <?php echo btn_view('admin/users/manage_users/'.$user_type.'/' . $v_user->id); ?> -->
		                                          
		                                        </td>
		                                    </tr>
		                                    <?php $i++; } ?>
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
		                <div id="movies" class="tab-pane fade  ">
		                    <table  class="table table-bordered table-striped exampletable">
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
		                            <?php if (!empty($all_video)): foreach ($all_video as $v_user) : 
		                            	if($v_user->cat_id == 1){
		                            	?>
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
		                                            <?php echo btn_edit('admin/video/edit_video/' . $v_user->id); ?>
		                                          
		                                          <a class="btn btn-danger btn-xs" onclick="deleteData('admin/video/delete_video/<?php echo $v_user->id; ?>')"><i class="fa fa-trash-o"></i></a>
		                                         <!--  <?php echo btn_view('admin/users/manage_users/'.$user_type.'/' . $v_user->id); ?> -->
		                                          
		                                        </td>
		                                    </tr>
		                                    <?php $i++; } ?>
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
              		</div>
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

