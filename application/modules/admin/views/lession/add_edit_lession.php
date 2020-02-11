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
  
                    <form role="form" class="form-vertical" id="newsForm" enctype="multipart/form-data" action="<?php echo base_url(); ?>admin/lession/<?php 
                    if(!empty($lession_info->id)){
                          echo "update_lession/".$lession_info->id; }
                        else{ echo "save_lession/".$cid; }
                    ?>" method="post">

                        <div class="row" id="translControl">

                            <div class="col-md-8 col-sm-12 col-xs-12 col-md-offset-2">

                                <div class="box-body">

                                   <div class="col-md-12 col-sm-12 col-xs-12">

                                        <div class="form-group">



                                            <label for="tilte">Title</label>

                                            <input type="text"  name="title" placeholder="Title"

                                                   value="<?php
                                                   if (!empty($lession_info->title)) {
                                                       echo $lession_info->title;
                                                   }
                                                   ?>"

                                                   class="form-control">

                                        </div>

                                    </div>
                                    
                                    <div class="col-md-12 col-sm-12 col-xs-12">

                                        <div class="form-group">



                                            <label for="tilte">Video Upload</label>
                                             <input type="hidden" name="courserID" value="<?php
                                                   if (!empty($lession_info->courseId)) {
                                                       echo $lession_info->courseId;
                                                   }
                                                   ?>">
                                            <input type="hidden" name="old_video" value="<?php
                                                   if (!empty($lession_info->youtubeVideoLink)) {
                                                       echo $lession_info->youtubeVideoLink;
                                                   }
                                                   ?>">
                                            <input type="file"  name="youtubeVideoLink" placeholder="Youtube Link"

                                                  class="form-control">

                                        </div>

                                    </div>

                                    <div class="col-md-12 col-sm-12 col-xs-12">

                                        <div class="form-group">



                                            <label for="tilte">Downlaod File Upload</label>
 <input type="hidden" name="old_file_down" value="<?php
                                                   if (!empty($lession_info->downloadFile)) {
                                                       echo $lession_info->downloadFile;
                                                   }
                                                   ?>">
                                            <input type="file"  name="downloadFile" placeholder="Downlaod File Link"

                                                  class="form-control">

                                        </div>

                                    </div>
                                    
                                    
                                    
                                    <div class="col-md-12 col-sm-12 col-xs-12">

                                        <div class="form-group">



                                            <label for="description">Description</label>

                                            <textarea type="text"  name="description" placeholder="Description" value="" class="form-control">
                                                <?php
                                                   if (!empty($lession_info->details)) {
                                                       echo $lession_info->details;
                                                   }
                                                   ?>
                                            </textarea>

                                        </div>

                                    </div>
                                    
                                 
                                    <div class="row">
                                      
                                         <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="form-group col-md-4">
                                                <?php if (!empty($lession_info->image)): ?>
                                                    <img id="blah" src="<?php echo base_url() . $lession_info->image ?>" class="" width="100" height="80"/>
                                                <?php else: ?>
                                                    <img id="blah" src="<?php echo base_url() ?>assets/uploads/images/logo-white.png" width="50" height="50" alt="Image">
                                                <?php endif; ?>
                                            </div>
                                        
                                            <div class="form-group col-md-8">
                                                hidden  old_path when update
                                                <input type="hidden" name="old_path" id="old_path" value="<?php
                                                if (!empty($lession_info->image)) {
                                                    echo $lession_info->image;
                                                }
                                                ?>">
                                                <label for="image">Lession Image </label>
                                                <input type="file" onchange="readURL(this);" name="profile_picture"  accept="image/*">
                                                <p class="help-block">Max file size 2MB.</p>
                                                <em><strong>Note :</strong> Please use transparent PNG image for better resolution. </em>
                                            </div> 
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







