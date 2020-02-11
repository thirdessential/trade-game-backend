<!-- Main content -->
<style type="text/css">
    
ul.single-ul li {
    padding: 10px;
}

ul.single-ul {
    list-style-type: none;
    margin-top: 15px;
}

</style>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary box-solid">
                <div class="box-header box-header-background with-border">
                    <h3 class="box-title"><?php echo ucfirst($show[0]->title); ?></h3>
                    <div class="box-tools pull-right">
                        <!-- <a href="<?php echo base_url(); ?>admin/type/edit_type" class="btn btn-warning">Add New</a> -->
                    </div>
                </div> 
                
                <div class="box-body table-responsive">
                       <div class="col-md-12" style='margin-bottom:10px'>
                           <img src="<?php echo base_url(); ?><?php echo $show[0]->bannerImage ?>" class="img img-responsive" style='width: 100%'>
                       </div>
                       <div class="col-md-9">
                        <h2><?php echo ucfirst($show[0]->title); ?></h2>
                        <p><?php echo $show[0]->details; ?></p>
                        <a class="btn btn-info"><?php echo ucfirst($show[0]->categoryTitle); ?></a>
                        <a class="btn btn-info"><?php echo ucfirst($show[0]->subCatTitle); ?></a> 
                        
                       <div class="col-md-12">
                        <div class="col-md-6">
                        <?php
                            if($show[0]->mediaType=='image'){
                               ?>
                                  <h3 class="text-justify" style="    float: left; width: 100%;">Media Image</h3>
                                  <img src="<?php echo base_url(); ?><?php echo $show[0]->fileLink ?>" class="img img-responsive" >
                               <?php
                            }
                         ?>
                       </div>
                        <div class="col-md-6">
                            <ul class="single-ul">
                            <li><i class="fa fa-thumbs-up "></i> Like : <?php echo $show[0]->totalView; ?></li>
                            <li><i class="fa fa-eye"></i>View : <?php echo $show[0]->totalLike; ?></li>
                            <li><i class="fa fa-download"></i>Downlaod : <?php echo $show[0]->totalDownlaod; ?></li>
                            <li><i class="fa fa-comments-o"></i>Comment : <?php echo $show[0]->totalComment; ?></li>
                        </ul>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-3 well">
                         <?php if($show[0]->profileImage){
                                            ?>
                                            <img src='<?php echo base_url(); ?><?php echo $show[0]->profileImage ?>' class='img img-responsive'>
                                            <?php
                                        }else{
                                            ?>
                                           <img src='<?php echo base_url(); ?>assets/uploads/users/No_Image_Available1.png' class='img img-responsive'>
                                            <?php
                                        } ?>
                       
                        
                            <h4 class="text-center">Post By :- <?php echo ucfirst($show[0]->username); ?></h4>
                    </div>
                    
                    <div class="col-md-12 well">
                         <h3>Comment List</h3>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <td>Comment By </td>
                                    <td>Review</td>
                                    <td>Comment</td>
                                   
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($review)) {
                                    foreach ($review as $key => $rw) {
                                       
                                     ?>
                                <tr>
                                    <td><?php echo $rw->reviewBy; ?></td>
                                    <td><?php echo $rw->rating; ?></td>
                                    <td><?php echo $rw->comment; ?></td>

                                </tr>
                            <?php } }else{
                                ?>
                                <tr>
                                    <td colspan="3">No comment in this post</td>
                                </tr>
                                <?php
                            }  ?>
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

