<!--Massage-->
<?php echo message_box('success'); ?>
<?php echo message_box('error'); ?>
<!--/ Massage-->

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary box-solid">
                <div class="box-header box-header-background with-border" >
                    <h3 class="box-title "><?php echo $title; ?></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <!-- form start -->
                    <form role="form" class="form-vertical" id="newsForm" enctype="multipart/form-data" action="<?php echo base_url(); ?>admin/news/save_news/<?php
                    if (!empty($news_info->id)) {
                        echo $news_info->id;
                    }
                    ?>" method="post">
                        <div class="row" id="translControl">
                            <div class="col-md-8 col-sm-12 col-xs-12 col-md-offset-2">
                                <div class="box-body">
                                   <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="form-group">

                                            <label for="tilte">Title</label>
                                            <input type="text"  name="title" placeholder="Title"
                                                   value="<?php
                                                   if (!empty($news_info->title)) {
                                                       echo $news_info->title;
                                                   }
                                                   ?>"
                                                   class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="form-group">

                                            <label for="description">Description</label>
                                            <textarea type="text"  name="description" placeholder="Description" value="" class="form-control"><?php
                                                   if (!empty($news_info->description)) {
                                                       echo $news_info->description;
                                                   }
                                                   ?></textarea>
                                        </div>
                                    </div>

                                </div>
                                <!-- /.box-body -->
                                <div class="box-footer">
                                    <button type="submit" class="btn btn-primary" type="submit">Submit</button>
                                </div>
                            </div>
                        </div>
                    
                    </form>
                </div>   
            </div>
            
            <!-- /.box -->
        </div>
        <!--/.col end -->
    </div>
    <!-- /.row -->
</section>
<script src="https://cdn.ckeditor.com/4.5.7/standard/ckeditor.js"></script>
<script type="text/javascript">
    $(function () {
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        CKEDITOR.replace('description');
        config.allowedContent = true;
        //bootstrap WYSIHTML5 - text editor
    });

</script> 



