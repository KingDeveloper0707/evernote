<!-- Bootstrap Select Css -->
<link href="<?= base_url() ?>public/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
<link href="<?= base_url() ?>public/plugins/light-gallery/css/lightgallery.css" rel="stylesheet">
<div class="block-header">
    <ol class="breadcrumb breadcrumb-bg-cyan" style="margin-top:10px;">
        <li>
        	<a href="<?= base_url() ?>">
        		<i class="material-icons">home</i> Dashboard
        	</a></li>
        <li>
        	<a href="<?= base_url('admin/requests') ?>">
        		<i class="material-icons">textsms</i> List
        	</a>
        </li>
    </ol>
</div>

<div class="row clearfix">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="card">
      <div class="header">
        <h2>
          View Request Detail
        </h2>
      </div>
      
      <div class="body">
	      <form class="form-horizontal">
	        <div class="row clearfix">
	            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 form-control-label">
	                <label for="email_address_2">Submission Date</label>
	            </div>
	            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
	                <div class="form-group">
	                    <div class="form-line">
	                        <input type="text" id="date" class="form-control" value="<?= date('F j, Y - H:i:s',strtotime($request['created_at'])); ?>">
	                    </div>
	                </div>
	            </div>
	        </div>
	        	      
	        <div class="row clearfix">
	            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 form-control-label">
	                <label for="email_address_2">Request</label>
	            </div>
	            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
	                <div class="form-group">
	                    <div class="form-line">
	                        <input type="text" id="request" class="form-control" value="<?php echo $request['request'];?>">
	                    </div>
	                </div>
	            </div>
	        </div>

	        <div class="row clearfix">
	            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 form-control-label">
	                <label for="email_address_2">Item</label>
	            </div>
	            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
	                <div class="form-group">
	                    <div class="form-line">
	                        <input type="text" id="item" class="form-control" value="<?php echo $request['item'];?>">
	                    </div>
	                </div>
	            </div>
	        </div>        

	        <div class="row clearfix">
	            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 form-control-label">
	                <label for="email_address_2">Type</label>
	            </div>
	            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
	                <div class="form-group">
	                    <div class="form-line">
	                        <input type="text" id="type" class="form-control" value="<?php echo $request['type'];?>">
	                    </div>
	                </div>
	            </div>
	        </div> 
	        
	        <?php 
	        	foreach($attrs as $key => $value) {
			?>
	        <div class="row clearfix">
	            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 form-control-label">
	                <label for="email_address_2"><?php echo $key;?></label>
	            </div>
	            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
	                <div class="form-group">
	                    <div class="form-line">
	                        <input type="text" class="form-control" value="<?php echo $value;?>">
	                    </div>
	                </div>
	            </div>
	        </div> 				
			<?php		
				}
	        ?>
	        
	        
	         
	        
	        <div class="row clearfix">
	            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 form-control-label">
	                <label for="email_address_2">Cash</label>
	            </div>
	            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
	                <div class="form-group">
	                    <div class="form-line">
	                        <input type="text" id="cash" class="form-control" value="<?php echo $request['price'];?>">
	                    </div>
	                </div>
	            </div>
	        </div> 
	        	        
	        <div class="row clearfix">
	            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 form-control-label">
	                <label for="email_address_2">Original Price</label>
	            </div>
	            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
	                <div class="form-group">
	                    <div class="form-line">
	                    	<input type="text" id="original_price" class="form-control" value="<?php echo $request['original_price'];?>">
	                    </div>
	                </div>
	            </div>
	        </div>
	              		
	        <div class="row clearfix">
	            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 form-control-label">
	                <label for="email_address_2">Description</label>
	            </div>
	            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
	                <div class="form-group">
	                    <div class="form-line">
	                    	<textarea rows="4" class="form-control no-resize" spellcheck="false"><?php echo $request['description'];?></textarea>
	                    </div>
	                </div>
	            </div>
	        </div>   
	           	
      	</form>
      </div>
    </div>
  </div>
</div>

<?php if ($photos != NULL) {?>
<div class="row clearfix">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	    <div class="card">
	      <div class="header">
	        <h2>Photos</h2>
	      </div>
	      
	       <div class="body">
	       	<div id="aniimated-thumbnials" class="list-unstyled row clearfix">
	       		<div class="row clearfix">
	       		<?php 
	       			foreach($photos as $photo) {
	       				$file_url = base_url($photo['path'].'/'.$photo['filename']);
	       		?>
	       		
		       		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
		                <a href="<?php echo $file_url;?>" data-sub-html="<?php echo $photo['original_filename'];?>">
	                        <img class="img-responsive thumbnail" src="<?php echo $file_url;?>">
	                    </a>
		            </div>
	       		<?php						
					}
	       		?>
	       		</div>
	       	</div>
	       </div>
	    </div>
    </div>    	
</div>
<?php } ?>

<?php if ($receipt != NULL) {?>
<div class="row clearfix">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	    <div class="card">
	      <div class="header">
	        <h2>Receipt</h2>
	      </div>
	      
	       <div class="body">
	       		<a href="<?php echo base_url($receipt['path'].'/'.$receipt['filename']); ?>" target="_blank">Download Receipt</a>
	       </div>
	    </div>
    </div>    	
</div>
<?php } ?>

<div class="row clearfix">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="card">
      <div class="header">
        <h2>Customer</h2>
      </div>
      
      <div class="body">
      	<form class="form-horizontal">
      	
	        <div class="row clearfix">
	            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 form-control-label">
	                <label for="email_address_2">Name</label>
	            </div>
	            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
	                <div class="form-group">
	                    <div class="form-line">
	                    	<input type="text" id="firstname" class="form-control" value="<?php echo $customer['firstname'];?>">
	                    </div>
	                </div>
	            </div>
	            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
	                <div class="form-group">
	                    <div class="form-line">
	                    	<input type="text" id="lastname" class="form-control" value="<?php echo $customer['lastname'];?>">
	                    </div>
	                </div>
	            </div>	            
	        </div> 
	        
	        
	        <div class="row clearfix">
	            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
	                <label for="email_address_2">Email</label>
	            </div>
	            <div class="col-lg-6 col-md-6 col-sm-8 col-xs-7">
	                <div class="form-group">
	                    <div class="form-line">
	                    	<input type="text" id="email" class="form-control" value="<?php echo $customer['email'];?>">
	                    </div>
	                </div>
	            </div>
	        </div> 
	             
	        <div class="row clearfix">
	            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 form-control-label">
	                <label for="email_address_2">Zip Code</label>
	            </div>
	            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
	                <div class="form-group">
	                    <div class="form-line">
	                    	<input type="text" id="zip" class="form-control" value="<?php echo $customer['zip'];?>">
	                    </div>
	                </div>
	            </div>
	            <div class="col-lg-1 col-md-1 col-sm-4 col-xs-4 form-control-label">
	                <label for="email_address_2">Phone</label>
	            </div>
	            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
	                <div class="form-group">
	                    <div class="form-line">
	                    	<input type="text" id="mobile" class="form-control" value="<?php echo $customer['mobile_no'];?>">
	                    </div>
	                </div>
	            </div>	            
	        </div>	             	
      	</form>
      </div>
    </div>
  </div>
</div>

<!-- Autosize Plugin Js -->
<script src="<?= base_url() ?>public/plugins/autosize/autosize.js"></script>

<!-- Light Gallery Plugin Js -->
<script src="<?= base_url() ?>public/plugins/light-gallery/js/lightgallery-all.js"></script>

<!-- Custom Js -->
<script src="<?= base_url() ?>public/js/pages/medias/image-gallery.js"></script>

