<!-- Striped Rows -->
<div class="row clearfix">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="card">
      <div class="header">
        <h2 style="display: inline-block;">
          Online-Payment Request List
        </h2>
		<a href="<?= base_url('admin/payments/export_all');?>" class="btn btn-info waves-effect pull-right" >
			<i class="material-icons">archive</i> EXPORT ALL</a>
		
		<a href="#" class="btn btn-primary waves-effect pull-right" style="margin-right:10px;" id="btn_export">
			<i class="material-icons">archive</i> EXPORT SELECTED</a>
		
      </div>
      <div class="body table-responsive">
        <table class="table table-striped" id="dataTable">
          <thead>
            <tr>
              <th></th>
              <th>#</th>
              <th>DateTime</th>
              <th>Customer</th>              
              <th>Email</th>
              <th>Pledge1</th>
              <th>Payment Type</th>
              <th>Store</th>
              <th width="110px">Action</th>
            </tr>
          </thead>
          <tbody>
          	<?php 
          		if ($all_payments == false) {
			?>
				<tr>
					<td colspan="9">No Requests</td>
				</tr>
			<?php		
				} else {
					$i = $start;
					foreach($all_payments as $row) {
			?>
	              <tr class="<?= $row['mark_read']?'':'unread'; ?>">
	              	<td align="center">
	              		<input type="checkbox" class="chkclass " id="req_id" value="<?= $row['id']; ?>" />
	              	</td>
	                <td><?= ++$i; ?></td>
	                <td><?= date('F j, Y - H:i:s',strtotime($row['created_at'])); ?></td>
	                <td><?= $row['firstname']; ?> <?= $row['lastname']; ?></td>
	                <td><?= $row['email']; ?></td>	                
	                <td><?= $row['pledge1']; ?></td>	                
	                <td><?= $row['type']; ?></td>
	                <td><?= $row['store']; ?></td>
	                <td>
	                	<a title="View" class="view btn btn-sm btn-info" href="<?php echo base_url('admin/payments/view/'.$row['id']);?>"> 
	                		<i class="material-icons">visibility</i>
	                	</a>
	                	
	                	<a title="Delete" class="delete btn btn-sm btn-danger" data-href="<?php echo base_url('admin/payments/del/'.$row['id']); ?>" data-toggle="modal" data-target="#confirm-delete"> 
	                		<i class="material-icons">delete</i>
	                	</a>
	                	
	                </td>
                  </tr>			
			<?php			
					}
				}
          	?>

              </tbody>
            </table>
          </div>
          <div class="pull-right">
            <?php echo $this->pagination->create_links(); ?>
          </div>
        </div>
      </div>
    </div>
    <!-- #END# Striped Rows -->
<div id="confirm-delete" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Delete</h4>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to delete?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <a class="btn btn-danger btn-ok">Delete</a>
      </div>
    </div>
  </div>
</div>
    
 <script>
  	function jsonify(){
		var rows = $('#dataTable tr');
		var a = [];
		rows.each(function(){
		    if($(this).find('#req_id').is(':checked')) {
		       	var req_id = $(this).find('#req_id').val();
		       	var x = {req_id:req_id};
		    	a.push(x);
		    }
		});
		var c = JSON.stringify(a);
		return c;
	}
	
	function download(filename, text) {
	  var element = document.createElement('a');
	  element.setAttribute('href', filename);
	  element.setAttribute('download', "Test.csv");

	  element.style.display = 'none';
	  document.body.appendChild(element);

	  element.click();

	  document.body.removeChild(element);
	}
 
    //Delete Dialogue
    $('#confirm-delete').on('show.bs.modal', function(e) {
   	 	$(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
    });
    
    $('#btn_export').on('click', function(e) {
 	   var data = jsonify();

       $.ajax({
          type:'POST',
          url:'<?= base_url('admin/payments/export') ?>',
          data:{details:data},
        dataType: "json",
          success:function(rsp) {
            if (rsp.success == true) {				
				window.location.href = rsp.path;
				//download(rsp.path);
			}
          }
       });
           	
	});
 </script>    