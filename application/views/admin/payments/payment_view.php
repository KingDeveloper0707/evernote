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
        	<a href="<?= base_url('admin/payments') ?>">
        		<i class="material-icons">monetization_on</i> List
        	</a>
        </li>
    </ol>
</div>

<div class="row clearfix">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="card">
      <div class="header">
        <h2>
          View Online-Payment Request Detail
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
	                        <input type="text" id="date" class="form-control" value="<?= date('F j, Y - H:i:s',strtotime($payment['created_at'])); ?>">
	                    </div>
	                </div>
	            </div>
	        </div>
	        	      
	        <div class="row clearfix">
	            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 form-control-label">
	                <label for="email_address_2">Pledge1</label>
	            </div>
	            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
	                <div class="form-group">
	                    <div class="form-line">
	                        <input type="text" id="pledge1" class="form-control" value="<?php echo $payment['pledge1'];?>">
	                    </div>
	                </div>
	            </div>
	        </div>
	        
	        <?php if ($payment['pledge2']) { ?>
	        <div class="row clearfix">
	            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 form-control-label">
	                <label for="email_address_2">Pledge2</label>
	            </div>
	            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
	                <div class="form-group">
	                    <div class="form-line">
	                        <input type="text" id="pledge2" class="form-control" value="<?php echo $payment['pledge2'];?>">
	                    </div>
	                </div>
	            </div>
	        </div> 
	        <?php } ?>

			<?php if ($payment['pledge3']) { ?>
	        <div class="row clearfix">
	            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 form-control-label">
	                <label for="email_address_2">Pledge3</label>
	            </div>
	            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
	                <div class="form-group">
	                    <div class="form-line">
	                        <input type="text" id="pledge3" class="form-control" value="<?php echo $payment['pledge3'];?>">
	                    </div>
	                </div>
	            </div>
	        </div> 
	        <?php } ?>
	        
	        <?php if ($payment['pledge4']) { ?>
	        <div class="row clearfix">
	            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 form-control-label">
	                <label for="email_address_2">Pledge4</label>
	            </div>
	            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
	                <div class="form-group">
	                    <div class="form-line">
	                        <input type="text" id="pledge4" class="form-control" value="<?php echo $payment['pledge4'];?>">
	                    </div>
	                </div>
	            </div>
	        </div> 
	        <?php } ?>
	        
	        <?php if ($payment['pledge5']) { ?>
	        <div class="row clearfix">
	            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 form-control-label">
	                <label for="email_address_2">Pledge5</label>
	            </div>
	            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
	                <div class="form-group">
	                    <div class="form-line">
	                        <input type="text" id="pledge5" class="form-control" value="<?php echo $payment['pledge5'];?>">
	                    </div>
	                </div>
	            </div>
	        </div> 
	        <?php } ?>	        
	        
	        <div class="row clearfix">
	            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 form-control-label">
	                <label for="email_address_2">Payment Type</label>
	            </div>
	            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
	                <div class="form-group">
	                    <div class="form-line">
	                        <input type="text" id="type" class="form-control" value="<?php echo $payment['type'];?>">
	                    </div>
	                </div>
	            </div>
	        </div> 
	        
	        <?php if ($payment['type'] == "Existing Loan") { ?>
  			<div class="row clearfix">
	            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 form-control-label">
	                <label for="email_address_2">Existing Loan</label>
	            </div>
	            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
	                <div class="form-group">
	                    <div class="form-line">
	                        <input type="text" id="type" class="form-control" value="<?php echo $payment['type1'];?>">
	                    </div>
	                </div>
	            </div>
	        </div> 
	        <?php } else if ($payment['type'] == "Layaway Item") { ?>
	        <div class="row clearfix">
	            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 form-control-label">
	                <label for="email_address_2">Layaway Item</label>
	            </div>
	            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
	                <div class="form-group">
	                    <div class="form-line">
	                        <input type="text" id="type" class="form-control" value="<?php echo $payment['type2'];?>">
	                    </div>
	                </div>
	            </div>
	        </div>	        
	        <?php } ?>
	        
        	<?php if ($payment['type'] == "Layaway Item" && $payment['type2'] == "Custom Amount") { ?>
	        <div class="row clearfix">
	            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 form-control-label">
	                <label for="email_address_2">Custom Amount($)</label>
	            </div>
	            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
	                <div class="form-group">
	                    <div class="form-line">
	                        <input type="text" id="type" class="form-control" value="<?php echo $payment['amount'];?>">
	                    </div>
	                </div>
	            </div>
	        </div>	        	
        	<?php } ?>
	        		        
	        <div class="row clearfix">
	            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 form-control-label">
	                <label for="email_address_2">Store</label>
	            </div>
	            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
	                <div class="form-group">
	                    <div class="form-line">
	                        <input type="text" id="store" class="form-control" value="<?php echo $payment['store'];?>">
	                    </div>
	                </div>
	            </div>
	        </div> 	           	
      	</form>
      </div>
    </div>
  </div>
</div>

<?php if ($payment['ticket'] != NULL) {?>
<div class="row clearfix">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	    <div class="card">
	      <div class="header">
	        <h2>Ticket Image</h2>
	      </div>
	      
	       <div class="body">
	       	<div id="aniimated-thumbnials" class="list-unstyled row clearfix">
	       		<div class="row clearfix">
		       		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
		                <a href="<?php echo base_url($payment['ticket']);?>" data-sub-html="Ticket Image">
	                        <img class="img-responsive thumbnail" src="<?php echo base_url($payment['ticket']);?>">
	                    </a>
		            </div>

	       		</div>
	       	</div>
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

