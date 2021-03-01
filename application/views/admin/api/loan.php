<div class="container">
    <div class="col-sm-4 col-md-offset-4">
    <h4>Upload files using Codeigniter and Ajax</h4>

        <form class="form-horizontal" id="submit" enctype='multipart/form-data'>
        	
            <div class="form-group">
            	<label>Request</label>
        		<input type="text" name="request_id" class="form-control" value="1">    
            </div>
            
            <div class="form-group">
            	<label>Item</label>
        		<input type="text" name="item_id" class="form-control" value="2">    
            </div>
            
            <div class="form-group">
            	<label>Type</label>
        		<input type="text" name="type" class="form-control" value="tv">    
            </div>
            
            <div class="form-group">
            	<label>Original Remote</label>
        		<input type="text" name="attrs[Does it include original remote?]" class="form-control" value="yes">    
            </div>
            <div class="form-group">
            	<label>Model</label>
        		<input type="text" name="attrs[What is the make and model number?]" class="form-control" value="LG-432">    
            </div>
            
            <div class="form-group">
            	<label>Condition</label>
        		<input type="text" name="attrs[What is the condition of your tv?]" class="form-control" value="NEW">    
            </div>
            
            
            
            <div class="form-group">
            	<label>Cash Amount</label>
        		<input type="text" name="price" class="form-control" value="200.3">    
            </div>
            
            <div class="form-group">
            	<label>Original Price</label>
        		<input type="text" name="original_price" class="form-control" value="140.5">    
            </div>
            
            <div class="form-group">
            	<label>Photo</label>
                <input type="file" name="photos[]" accept="image/*" multiple="">
            </div>
            
            <div class="form-group">
            	<label>Receipt</label>
                <input type="file" name="receipt">
            </div>
            
            <div class="form-group">
            	<label>Description</label>
                <textarea name="description">This is my test. Description Test test.</textarea>
            </div>

			<br>
			<br>
			<br>
			<div class="form-group">
            	<label>First Name</label>
                <input type="text" name="firstname" value="Dmytro">
            </div>
            
            <div class="form-group">
            	<label>Last Name</label>
                <input type="text" name="lastname" value="Chervinko">
            </div>
            
            <div class="form-group">
            	<label>Zip Code</label>
                <input type="text" name="zip" value="112233-04">
            </div>
            
            <div class="form-group">
            	<label>Phone Number</label>
                <input type="text" name="mobile_no" value="234-342-3234">
            </div>
            
            <div class="form-group">
            	<label>Email</label>
                <input type="email" name="email" value="test.app@gmail.com">
            </div>
            
            
            
			
            <div class="form-group">
                <button class="btn btn-success" id="btn_upload" type="submit">Upload</button>
            </div>
        </form>   
    </div>
</div>

<script type="text/javascript" src="<?php echo base_url().'public/plugins/jquery/jquery.min.js'?>"></script>
<script type="text/javascript">
    $(document).ready(function(){
 
        $('#submit').submit(function(e){
        	
            e.preventDefault(); 
            var ajax_url = '<?php echo base_url();?>api/add_request';
            var data = new FormData(this);

	    
		    $.ajax({
		      type: "POST",
		      url: ajax_url,
		      data: data,
		      dataType: "json",
		      processData:false,
		      contentType:false,
		      success: function(res) {
		      	console.log('Success');
		     	}, error: function(res) {
			 	console.log('error');
			 	}
		    });

        });
         
 
    });
     
</script>