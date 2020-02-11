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

                    <form role="form" class="form-vertical" id="newsForm" enctype="multipart/form-data" action="<?php echo base_url(); ?>admin/audio/save_audio/<?php

                    if (!empty($audio_info->id)) {

                        echo $audio_info->id;

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

                                                   if (!empty($audio_info->title)) {

                                                       echo $audio_info->title;

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
                                               <select class="form-control" name="type_id" required="">
                                      <?php
                                         if (!empty($audio_info->type_id)) {
                                          
                                      ?>
                                       <?php if (!empty($all_type)): foreach ($all_type as $v_type) : 
                                        if ($v_type->id==$audio_info->type_id) {
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
                                               <label for="tilte">Category</label>
                                              
                                                <select class="form-control" name="cat_id" required="">
                                                  <?php
                                                 if (!empty($audio_info->cat_id)) {

                                                   ?>
                                                   <?php if (!empty($all_category)): foreach ($all_category as $v_cat) : 
                                                       if ($v_cat->id==$audio_info->cat_id) {
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
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-xs-6">

                                            <div class="form-group">
                                               <label for="tilte">Sub Category</label>
                                               <select class="form-control" name="sub_cat_id" required="">
                                                 <?php
                                                 if (!empty($audio_info->sub_cat_id)) {

                                                   ?>
                                                   <?php if (!empty($all_subCat)): foreach ($all_subCat as $v_scat) : 
                                                    if ($v_scat->id==$audio_info->sub_cat_id) {
                                                     
                                                    ?>
                                                    <option value="<?php echo $v_scat->id;  ?>"><?php echo $v_scat->title;  ?></option>
                                                      <?php }  endforeach; ?> 
                                                      <?php endif; ?>
                                                   <?php    

                                                   } 
                                                   ?>
                                                    <?php if (!empty($all_subCat)): foreach ($all_subCat as $v_scat) : ?>
                                                    <option value="<?php echo $v_scat->id;  ?>"><?php echo $v_scat->title;  ?></option>
                                                      <?php  endforeach; ?> 
                                                      <?php endif; ?>
                                                </select>

                                             </div>

                                      </div>
                                      <div class="col-md-6 col-sm-6 col-xs-6">

                                            <div class="form-group">
                                               <label for="tilte">Album</label>
                                               <select class="form-control" name="album_id" required="">
                                                 <?php
                                                 if (!empty($audio_info->album_id)) {

                                                   ?>
                                                   <?php if (!empty($all_album)): foreach ($all_album as $v_albm) :
                                                      if ($audio_info->album_id==$v_albm->id) {
                                                        ?>
                                                         <option value="<?php echo $v_albm->id;  ?>"><?php echo $v_albm->title;  ?></option>
                                                        <?php
                                                      }
                                                    ?>
                                                   
                                                      <?php  endforeach; ?> 
                                                      <?php endif;  

                                                   } 
                                                   ?>
                                                    <?php if (!empty($all_album)): foreach ($all_album as $v_albm) : ?>
                                                    <option value="<?php echo $v_albm->id;  ?>"><?php echo $v_albm->title;  ?></option>
                                                      <?php  endforeach; ?> 
                                                      <?php endif; ?>
                                                </select>

                                             </div>

                                             </div>

                                      </div>
                                    
                                     <div class="col-md-12 col-sm-12 col-xs-12">

                                        <div class="form-group">



                                            <label for="description">Description</label>

                                            <textarea type="text"  name="description" placeholder="Description"  class="form-control">
                                              <?php if (!empty($audio_info->details)) {
                                                echo $audio_info->details ;
                                              }  ?>
                                            </textarea>

                                        </div>

                                    </div>
                                    <div class="col-md-12 col-sm-12 col-xs-12">

                                        <div class="form-group">
                                          <label for="about">About</label>

                                            <textarea type="text"  name="about" placeholder="About"  class="form-control">
                                              <?php if (!empty($audio_info->about_video)) {
                                                echo $audio_info->about_video ;
                                              }  ?>
                                            </textarea>

                                        </div>

                                    </div>
                                    <div class="row">
                                      
                                         <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="form-group col-md-4">
                                                <?php if (!empty($audio_info->profile_image)): ?>
                                                    <img id="blah" src="<?php echo base_url() . $audio_info->profile_image ?>" class="" width="100" height="80"/>
                                                <?php else: ?>
                                                    <img id="blah" src="<?php echo base_url() ?>assets/uploads/images/logo-white.png" width="50" height="50" alt="Image">
                                                <?php endif; ?>
                                            </div>
                                        
                                            <div class="form-group col-md-8">
                                                hidden  old_path when update
                                                <input type="hidden" name="old_path" id="old_path" value="<?php
                                                if (!empty($audio_info->profile_image)) {
                                                    echo $audio_info->profile_image;
                                                }
                                                ?>">
                                                <label for="image">Cover Image </label>
                                                <input type="file" onchange="readURL(this);" name="profile_picture"  accept="image/*">
                                                <p class="help-block">Max file size 2MB.</p>
                                                <em><strong>Note :</strong> Please use transparent PNG image for better resolution. </em>
                                            </div> 
                                        </div> 
                                    </div>
                                     <?php if (empty($audio_info->audio_link)){ ?> 
                                    <div class="row">
                                       <hr>
                                         <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="form-group col-md-12">
                                                <label for="image">Audio </label>
                                                <input type="file" name="audio" required="" placeholder="Please fill Audio file " accept="audio/*" >
                                            </div>
                                        </div> 
                                    </div>
                                  <?php } ?>



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







