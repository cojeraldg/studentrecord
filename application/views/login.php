<?php include ("inc/header.php"); ?>
	<div class="container">
        <?php echo form_open("welcome/signin",['class'=>'form-horizontal']);?>
        <?php if($msg = $this -> session -> flashdata('message')):?>
                <div class="row">
                    <div class="col-md-6">
                        <div class="alert alert-dismissible alert-danger">
                            <?php echo $msg;?>
                            
                        </div>
                    </div>
                </div>
        <?php endif;?>
        <h3> ADMIN LOGIN </h3>
        <hr>
        
                   </div>  
             </div> 

        <div class="row">
           <div class="col-md-6">
              <div class="form-group">
                         <label class="col-md-3 control-label"> Email </label>
                         <div class="col-md-9">
                              <?php echo form_input (['name' => 'email', 'class'=> 'form-control'
                                , 'placeholder'=> 'email', 'value' => set_value('email')]); ?>
                                </div>
                            </div>
                        </div>
                    </div class="col-md-6">
                    <?php echo form_error('email','<div class="text-danger">','</div>');?>
                   </div>  
             </div>  

                   </div>  
             </div> 

            
                        

             <div class="row">
           <div class="col-md-6">
              <div class="form-group">
                        
              <label class="col-md-3 control-label"> Password </label>
                         <div class="col-md-9">
                              <?php echo form_password (['name' => 'password', 'class'=> 'form-control'
                                , 'placeholder'=> 'Password']); ?>
                                </div>
                            </div>
                        </div>
                    </div class="col-md-6">
                    <?php echo form_error('password','<div class="text-danger">','</div>');?>
                   </div>  
             </div>  

             
                   </div>  
             </div>  
             <button type="submit" class="btn btn-primary"> LOGIN </button>
             <?php echo anchor ("welcome", "BACK", ['class'
							=> 'btn btn-primary']);?>
     <div>
         <?php echo form_close(); ?>
    </div>  
<?php include ("inc/footer.php"); ?>
	