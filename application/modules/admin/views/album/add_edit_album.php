<!--Massage-->

<?php echo message_box('success'); ?>

<?php echo message_box('error'); ?>

<!--/ Massage-->
<style type="text/css">
  .optionhide{
     display: none;
  }
</style>
<script type="text/javascript">
  function getCatId(id){
    jQuery(".optionhide").hide();
    jQuery(".defaultoption").hide();
    var catClass="catClass_"+id;
    jQuery("."+catClass).show();
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

                    <form role="form" class="form-vertical" id="newsForm" enctype="multipart/form-data" action="<?php echo base_url(); ?>admin/album/save_album/<?php

                    if (!empty($news_info->id)) {

                        echo $news_info->id;

                    }

                    ?>" method="post">

                        <div class="row" id="translControl">

                            <div class="col-md-8 col-sm-12 col-xs-12 col-md-offset-2">

                                <div class="box-body">
                                        <div class="row">
                                      <div class="col-md-6 col-sm-6 col-xs-6">

                                            <div class="form-group">
                                               <label for="tilte">Category</label>
                                              
                                                <select class="form-control" onchange="getCatId(this.value)" name="category" required="">
                                                   <?php
                                                 if (!empty($news_info->cat_id)) {

                                                   ?>
                                                   <?php if (!empty($all_category)): foreach ($all_category as $v_cat) : 
                                                       if ($v_cat->id==$news_info->cat_id) {
                                                         ?>

                                                    <option value="<?php echo $v_cat->id;  ?>"><?php echo $v_cat->title;  ?></option>
                                                      <?php
                                                       }
                                                     endforeach; ?> 
                                                      <?php endif; ?>

                                                
                                                   <?php    

                                                   } 
                                                   ?>
                                                    <?php if (!empty($all_category)): foreach ($all_category as $v_cat) : ?>
                                                    <option value="<?php echo $v_cat->id;  ?>"><?php echo $v_cat->title;  ?></option>
                                                      <?php  endforeach; ?> 
                                                      <?php endif; ?>
                                                </select>
                                             </div>

                                      </div>
                                    
                                        <div class="col-md-6 col-sm-6 col-xs-6">
                                              <div class="form-group">
                                               <label for="tilte">Sub Category</label>
                                               <select class="form-control" name="subCat" required="">
                                                <?php
                                                 if (!empty($news_info->sub_cat_id)) {

                                                   ?>
                                                   <?php if (!empty($all_subCat)): foreach ($all_subCat as $v_scat) : 
                                                    if ($v_scat->id==$news_info->sub_cat_id) {
                                                     
                                                    ?>
                                                    <option value="<?php echo $v_scat->id;  ?>"><?php echo $v_scat->title;  ?></option>
                                                      <?php }  endforeach; ?> 
                                                      <?php endif; ?>
                                                   <?php    

                                                   } 
                                                   ?>
                                                    <?php if (!empty($all_subCat)):
                                                        if (empty($news_info->cat_id)) {
                                                     ?>
                                                    <option value="1" class='defaultoption'>Select</option>
                                                      <?php }
                                                      
                                                     foreach ($all_subCat as $v_scat) : ?>
                                                    <option value="<?php echo $v_scat->id;  ?>" class='optionhide catClass_<?php echo $v_scat->category_id;  ?> '><?php echo $v_scat->title;  ?></option>
                                                      <?php  endforeach; ?> 
                                                      <?php endif; ?>
                                                </select>

                                             </div>

                                      </div>
                                     

                                      </div>
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

                                                   if (!empty($news_info->details)) {

                                                       echo $news_info->details;

                                                   }

                                                   ?></textarea>

                                        </div>

                                    </div>
                                    <div class="row">
                                      
                                         <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="form-group col-md-4">
                                                <?php if (!empty($user_info->image)): ?>
                                                    <img id="blah" src="<?php echo base_url() . $user_info->image ?>" class="" width="100" height="80"/>
                                                <?php else: ?>
                                                    <img id="blah" src="<?php echo base_url() ?>assets/uploads/images/logo-white.png" width="50" height="50" alt="Image">
                                                <?php endif; ?>
                                            </div>
                                        
                                            <div class="form-group col-md-8">
                                                hidden  old_path when update
                                                <input type="hidden" name="old_path" id="old_path" value="<?php
                                                if (!empty($user_info->image)) {
                                                    echo $user_info->image;
                                                }
                                                ?>">
                                                <label for="image">Album Image </label>
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







