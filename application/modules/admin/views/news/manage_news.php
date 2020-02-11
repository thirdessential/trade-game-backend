<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary box-solid">
                <div class="box-header box-header-background with-border">
                    <h3 class="box-title"><?php echo $title ?></h3>
                    <div class="box-tools pull-right">
                        <a href="<?php echo base_url(); ?>admin/news/add_edit_news" class="btn btn-warning">Add New</a>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive">
                    <table id="dataTables-example" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="active text-center">Id</th>
                                <th class="active text-center">Title</th>
                                <th class="active text-center">Description</th>
                                <th class="active text-center">Status</th>
                                <th class="active text-center">Create At</th>
                                <th class="active text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1 ?>
                            <?php if (!empty($all_news)): foreach ($all_news as $v_news) : ?>
                                    <tr>
                                        <td class="text-center"><?php echo $i ?></td>
                                        <td class="text-center"> <?php echo $v_news->title ?></td>
                                        <td class="text-center"> <?php echo substr($v_news->description, 0, 50) ?></td>
                                        <td class="text-center"><a href="javascript:void(0)"  id="changeStatus-news-<?php echo $v_news->status ?>-<?php echo $v_news->id; ?>" class="btn btn-xs <?php echo ($v_news->status == 'Active') ? ('btn-success') : ('btn-danger'); ?>"> <?php echo ($v_news->status == 'Active') ? ('<i class="fa fa-thumbs-up"> Active</i>') : ('<i class="fa fa-thumbs-down"> Inactive</i>'); ?></a></td>
                                        <td class="text-center"><?php echo dateTimeFormat($v_news->created_at); ?></td>
                                        <td><?php //echo btn_list('admin/user/manage_user_address/' . $v_news->id);        ?>

                                            <?php echo btn_edit('admin/news/add_edit_news/' . $v_news->id); ?>
                                            <?php echo btn_delete('admin/news/delete_news/' . $v_news->id); ?>
                                          
                                        </td>
                                    </tr>
                                    <?php $i++; ?>
                                    <?php
                                endforeach;
                                ?><!--get all news if not this empty-->
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

