<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary box-solid">
                <div class="box-header box-header-background with-border">
                    <h3 class="box-title"><?php echo $title ?></h3>
                    <div class="box-tools pull-right">
                        <a href="<?php echo base_url(); ?>admin/course/edit_quiz/<?php echo $course_id; ?>" class="btn btn-warning">Add New</a>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive">
                    <table id="dataTables-example" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="active text-center">No.</th>
                                <th class="active text-center">Title</th>
                                <th class="active text-center">Answer</th>
                                <th class="active text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1 ?>
                            <?php if (!empty($all_course)): foreach ($all_course as $course) : ?>
                                    <tr>
                                        <td class="text-center"><?php echo $i ?></td>
                                       <td class="text-center"> <?php echo ucfirst($course->title);  ?></td>
                                        <td class="text-center">
                                             <ul class="list-group">
                                                  <li class="list-group-item <?php if($course->currectAns === 'A'){ echo "list-group-item-success";} ?>"><span class="badge" style="float: left">A </span><?php echo ucfirst($course->ans1);  ?></li>
                                                  <li class="list-group-item <?php if($course->currectAns === 'B'){ echo "list-group-item-success";} ?>"><span class="badge" style="float: left">B </span> <?php echo ucfirst($course->ans2);  ?></li>
                                                  <li class="list-group-item <?php if($course->currectAns === 'C'){ echo "list-group-item-success";} ?>"><span class="badge" style="float: left">C </span><?php echo ucfirst($course->ans3);  ?></li>
                                                  <li class="list-group-item <?php if($course->currectAns === 'D'){ echo "list-group-item-success";} ?>"><span class="badge" style="float: left">D </span><?php echo ucfirst($course->ans4);  ?></li>
                                             </ul>
                                         </td>
                                        <td>
                                            
                                           <a class="btn btn-danger btn-xs" onclick="deleteData('admin/course/delete_quiz/<?php echo $course->id; ?>')"><i class="fa fa-trash-o"></i></a>
                                           
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

