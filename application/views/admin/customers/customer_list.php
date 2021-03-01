<!-- JQuery DataTable Css -->
<link href="<?= base_url()?>public/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">  
<!-- Bootstrap Select Css -->
<link href="<?= base_url() ?>public/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
<!-- Exportable Table -->
<div class="row clearfix">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="card">
      <div class="header">
        <h2 style="display: inline-block;">
          Customers LIST
        </h2>
        <a href="<?= base_url('admin/customers/export');?>" class="btn btn-info waves-effect pull-right" ><i class="material-icons">archive</i> EXPORT</a>
      </div>
      <div class="body">
        <div class="table-responsive">
          <table id="na_datatable" class="table table-bordered table-striped table-hover dataTable">
            <thead>
              <tr>
                <th>#ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Created Date</th>
                <th>Phone</th>
                <th>Action</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>#ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Created Date</th>
                <th>Phone</th>
                <th>Action</th>
              </tr>
            </tfoot>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- #END# Exportable Table -->

<!-- Modal -->
<div id="confirm-delete" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Delete</h4>
      </div>
      <div class="modal-body">
        <p>As you sure you want to delete.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <a class="btn btn-danger btn-ok">Delete</a>
      </div>
    </div>
  </div>
</div>

 <!-- Jquery DataTable Plugin Js -->
<script src="<?= base_url()?>public/plugins/jquery-datatable/jquery.dataTables.js"></script>
<script src="<?= base_url()?>public/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
<script type="text/javascript">
  //---------------------------------------------------
  var table = $('#na_datatable').DataTable( {
      "processing": true,
      "serverSide": true,
      "ajax": "<?=base_url('admin/customers/datatable_json')?>",
      "order": [[5,'desc']],
      "columnDefs": [
        { "targets": 0, "name": "id", 'searchable':false, 'orderable':true},
        { "targets": 1, "name": "firstname", 'searchable':true, 'orderable':true},
        { "targets": 2, "name": "lastname", 'searchable':true, 'orderable':true},
        { "targets": 3, "name": "email", 'searchable':true, 'orderable':true},
        { "targets": 4, "name": "created_at", 'searchable':true, 'orderable':true},
        { "targets": 5, "name": "mobile_no", 'searchable':true, 'orderable':true},
        { "targets": 6, "name": "Action", 'searchable':false, 'orderable':false,'width':'100px'}
      ]
    });
  </script>
<!-- Autosize Plugin Js -->
<script src="<?= base_url() ?>public/plugins/autosize/autosize.js"></script> 
<!-- Custom Js -->
 <script src="<?= base_url()?>public/js/pages/tables/jquery-datatable.js"></script>
 <script>

    //Delete Dialogue
    $('#confirm-delete').on('show.bs.modal', function(e) {
    	$(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
    });
    $("#na_datatable").addClass('active');
 </script>
  

  

