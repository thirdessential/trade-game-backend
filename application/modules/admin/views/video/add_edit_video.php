<!--Massage-->

<?php echo message_box('success'); ?>

<?php echo message_box('error'); ?>

<!--/ Massage-->


<style type="text/css">
  .optionhide{
     display: none;
  }
</style>
<script src="http://malsup.github.com/jquery.form.js"></script> 
 <script> 
        $(document).ready(function() { 


         var progressbar     = $('.progress-bar');


            $(".upload-image").click(function(){
              $(".form-horizontal").ajaxForm(
    {
      target: '.preview',
      beforeSend: function() {
      $(".progress").css("display","block");
      progressbar.width('0%');
      progressbar.text('0%');
                    },
        uploadProgress: function (event, position, total, percentComplete) {
            progressbar.width(percentComplete + '%');
            progressbar.text(percentComplete + '%');
         },
    })
    .submit();
            });


        }); 
    </script>

<script type="text/javascript">
  function getCatId(id){
    jQuery(".optionhide").hide();
    jQuery(".defaultoption").hide();
    var catClass="catClass_"+id;
    jQuery("."+catClass).show();
 }

 <?php 
 if (!empty($video_info->cat_id)) {
  ?>

    jQuery(".optionhide").hide();
    jQuery(".defaultoption").hide();
    var catClass="catClass_<?php echo $video_info->cat_id; ?>";
    jQuery("."+catClass).show();
    <?php
 }
 ?>
 function getCatSubCat(values,cat,subCat){
 	document.getElementById('catId').value=cat;
 	document.getElementById('subCatId').value=subCat;
 }
 
</script>
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

                    <form role="form" class="form-vertical" id="newsForm" enctype="multipart/form-data" action="<?php echo base_url(); ?>admin/video/save_video/<?php

                    if (!empty($video_info->id)) {

                        echo $video_info->id;

                    }

                    ?>" method="post">

                        <div class="row" id="translControl">

                            <div class="col-md-8 col-sm-12 col-xs-12 col-md-offset-2">

                                <div class="box-body">
                                    <div class="row">
                                   <div class="col-md-12 col-sm-12 col-xs-12">

                                        <div class="form-group">



                                            <label for="tilte">Title</label>

                                            <input type="text"  name="title" placeholder="Title"

                                                   value="<?php

                                                   if (!empty($video_info->title)) {

                                                       echo $video_info->title;

                                                   } 

                                                   ?>"

                                                   class="form-control">

                                        </div>

                                    </div>
                                </div>
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-xs-6">

                                            <div class="form-group">
                                               <label for="tilte">Type</label>
                                               <select class="form-control" name="type" required="">
                                                 <?php
                                         if (!empty($video_info->type_id)) {
                                          
                                      ?>
                                       <?php if (!empty($all_type)): foreach ($all_type as $v_type) : 
                                        if ($v_type->id==$video_info->type_id) {
                                          ?>
                                           <option value="<?php echo $v_type->id;  ?>"><?php echo $v_type->title;  ?></option>
                                           <?php
                                        }

                                       endforeach; ?> 
                                      <?php endif; ?>
                                    <?php }  ?>
                                                    <?php if (!empty($all_type)): foreach ($all_type as $v_type) : ?>
                                                    <option value="<?php echo $v_type->id;  ?>"><?php echo $v_type->title;  ?></option>
                                                      <?php  endforeach; ?> 
                                                      <?php endif; ?>
                                                </select>

                                             </div>

                                      </div>
                                       <div class="col-md-6 col-sm-6 col-xs-6">

                                            <div class="form-group">
                                               <label for="tilte">Album</label>
                                               <select class="form-control" name="album" required="" onchange="getCatSubCat(this.value,this.options[this.selectedIndex].getAttribute('attrCat'),this.options[this.selectedIndex].getAttribute('dataSubCat'))">
                                                 <?php
                                                 if (!empty($video_info->album_id)) {

                                                   ?>
                                                   <?php if (!empty($all_album)): foreach ($all_album as $v_albm) :
                                                      if ($video_info->album_id==$v_albm->id) {
                                                        ?>
                                                         <option value="<?php echo $v_albm->id;  ?>" attrCat="<?php echo $v_albm->cat_id;  ?>" dataSubCat="<?php echo $v_albm->sub_cat_id;  ?>"><?php echo $v_albm->title;  ?></option>
                                                        <?php
                                                      }
                                                    ?>
                                                   
                                                      <?php  endforeach; ?> 
                                                      <?php endif;  

                                                   } 

                                                   ?>
                                                    <?php if (!empty($all_album)): foreach ($all_album as $v_albm) : ?>
                                                    <option value="<?php echo $v_albm->id;  ?>" attrCat="<?php echo $v_albm->cat_id;  ?>" dataSubCat="<?php echo $v_albm->sub_cat_id;  ?>"><?php echo $v_albm->title;  ?></option>
                                                      <?php  endforeach; ?> 
                                                      <?php endif; ?>
                                                </select>

                                             </div>

                                             </div>
                                           </div>
                                           <div class="row">
                                      <input type="hidden" id="catId" value="<?php

                                                   if (!empty($video_info->title)) {

                                                       echo $video_info->cat_id;

                                                   } 

                                                   ?>" name="category">
                                      <input type="hidden" id="subCatId" value="<?php

                                                   if (!empty($video_info->title)) {

                                                       echo $video_info->sub_cat_id;

                                                   } 

                                                   ?>" name="subCat">
                                    
                                       
                                     

                                      </div>
                                    
                                     <div class="col-md-12 col-sm-12 col-xs-12">

                                        <div class="form-group">



                                            <label for="description">Description</label>

                                            <textarea type="text"  name="description" placeholder="Description"  class="form-control"><?php
                                            if (!empty($video_info->details)) {
                                             echo $video_info->details; } ?></textarea>

                                        </div>

                                    </div>
                                    <div class="col-md-12 col-sm-12 col-xs-12">

                                        <div class="form-group">



                                            <label for="about">About</label>

                                            <textarea type="text"  name="about" placeholder="About" value="" class="form-control"><?php if (!empty($video_info->about_video)) {
                                              echo $video_info->about_video; } ?></textarea>

                                        </div>

                                    </div>
                                    <div class="row">
                                      
                                         <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="form-group col-md-4">
                                                <?php if (!empty($video_info->profile_image)): ?>
                                                    <img id="blah" src="<?php echo base_url() . $video_info->profile_image ?>" class="" width="100" height="80"/>
                                                <?php else: ?>
                                                    <img id="blah" src="<?php echo base_url() ?>assets/uploads/images/logo-white.png" width="50" height="50" alt="Image">
                                                <?php endif; ?>
                                            </div>
                                        
                                            <div class="form-group col-md-8">
                                                hidden  old_path when update
                                                <input type="hidden" name="old_path" id="old_path" value="<?php
                                                if (!empty($video_info->profile_image)) {
                                                    echo $video_info->profile_image;
                                                }
                                                ?>">
                                                <label for="image">Cover Image </label>
                                                <input type="file" onchange="readURL(this);" name="profile_picture"  accept="image/*">
                                                <p class="help-block">Max file size 2MB.</p>
                                                <em><strong>Note :</strong> Please use transparent PNG image for better resolution. </em>
                                            </div> 
                                        </div> 
                                    </div>
                                    
                                    <div class="row">
                                       <hr>
                                         <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="form-group col-md-12">
                                                <label for="image">Video </label>
                                                <input type="file" name="video" placeholder="Please fill video file "  >
                                            </div>
                                        
                                            
                                        </div> 
                                    </div>
                                 


                                </div>

                                <!-- /.box-body -->

                                <div class="box-footer">

                                    <button type="submit"  class="btn btn-primary upload-image" type="submit">Submit</button>

                                </div>
                                <div class="preview"></div>
                                 <div class="progress" style="display:none">
                                  <div class="progress-bar" role="progressbar" aria-valuenow="0"
                                  aria-valuemin="0" aria-valuemax="100" style="width:0%">
                                    0%
                                  </div>
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







