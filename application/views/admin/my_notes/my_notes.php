<!-- JQuery DataTable Css -->
<link href="<?= base_url()?>public/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">  
<!-- Bootstrap Select Css -->
<link href="<?= base_url() ?>public/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />

<link href="<?= base_url()?>public/plugins/jquery-datatable/skin/bootstrap/css/dataTables.searchHighlight.css" rel="stylesheet">  


<div class="nav_top_bar">
  <div class="inputContainer search_wrap ">
      <input class="Field search_field" type="text" placeholder="Search">
      
      <i class="material-icons search_btn">search</i>
  </div>

  <div class="nav_logout">
        <a href="<?= base_url('auth/logout');?>" class="logout_btn">
          <span>LOGOUT</span>
        </a>
  </div>

</div>



<div class="container-fluid">
   

  <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 row_left">
            <div class="card">
                <div class="header">
                    <h2>
                       Your Notes
                    </h2>
                    <ul class="header-dropdown m-r--5">
                        <li>
                            <a href="javascript:void(0);" class="view-layout-btn note_wrap_ctr_btn">
                              <i class="material-icons">table_view</i>     
                            </a>
                        </li>
                        <li class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                <i class="material-icons">more_vert</i>
                            </a>
                            <ul class="dropdown-menu pull-right">
                                <li><a href="javascript:void(0);">Action</a></li>
                                <li><a href="javascript:void(0);">Another action</a></li>
                                <li><a href="javascript:void(0);">Something else here</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="body">
                  <?php echo form_open(base_url('admin/my_notes/create_notes'), 'id="create_note_form"')?> 
                    <div class="create-note">
                    
                      <div class="create-note-left">CREATE A NOTE</div> <div class="create-note-right"><i class="material-icons">add</i></div>
                      
                    
                    </div>
                    <input type="submit" name="submit" value="UPDATE" class="btn btn-primary m-t-15 waves-effect new_create_notes" style="display: none;">
                  <?php echo form_close();?>

                  <div class="table-responsive">
                    <table id="note_datatable" class="table table-bordered table-striped table-hover dataTable">
                      <thead style="display: none;">
                        <tr>
                          <th>Notes Name</th>
                          <th>Updated</th>
                          <th>Created</th>
                          <th>Tags</th>  
                          <th>ID</th> 
                          <th>Content</th> 
                          <th>User_ID</th>  
                          <th>Hide_Tags</th>                        
                        </tr>
                      </thead>
                      
                      <tbody>
                          <tr>
                              <td>
                                <div class="show_create_date">Febraray 1, 2021</div>
                                <div class="show_note_title">Michael Bruce</div>
                              </td>
                              <td>Javascript Developer</td>
                              <td>Singapore</td>
                              <td>29</td>
                             
                              
                          </tr>
                          <tr>
                              <td>  
                                <div class="show_create_date">Febraray 1, 2021</div>
                                <div class="show_note_title">Tester</div>
                              </td>
                              <td>Customer Support</td>
                              <td>New York</td>
                              <td>27</td>
                             
                             
                          </tr>
                          <tr>
                              <td>  
                                <div class="show_create_date">Febraray 2, 2021</div>
                                <div class="show_note_title">Developer</div>
                              </td>
                              <td>Customer Support</td>
                              <td>New York</td>
                              <td>27</td>
                              
                             
                          </tr>
                          <tr>
                              <td>  
                                <div class="show_create_date">Febraray 3, 2021</div>
                                <div class="show_note_title">Colre</div>
                              </td>
                              <td>Customer Support</td>
                              <td>New York</td>
                              <td>20</td>
                             
                             
                          </tr>
                      </tbody>
                      
                    </table>
                  </div>
                    
                  


                </div>
            </div>
        </div>
       

        <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12 row_right">
          <div class="card">
            <div class="body">
                <div class="note-details-wrap">
                  <?php echo form_open(base_url('admin/my_notes/update_notes'), 'class="form-horizontal"')?> 
                    <div class="note-details-header">
                      <div class="left_title">
                        TITLE
                      </div>
                      <div class="right_title">
                        
                        <input type="text" id="subject" name="subject" value="<?= $note_data->subject; ?>" placeholder="Enter your title here…." class="note_input">
                      </div>
                    </div>

                    <div class="note-details-header">
                      <div class="left_title">
                        AUTHOR
                      </div>
                      <div class="right_title_middle right_title_name">
                        <?php echo $user_data['username']; ?>                     
                      </div>
                    </div>

                    <div class="note-details-header">
                      <div class="left_title">
                        DATE
                      </div>
                      <div class="right_title_middle right_title_date">
                        <?php  echo $note_data->created_at;  ?>
                      </div>
                    </div>

                    <div class="note-details-header">
                      <div class="left_title">
                        TAGS
                      </div>
                      <div class="right_title_middle right_title_tags">
                        <?php  echo $note_data->tags;  ?>
                      </div>
                    </div>

                    <div class="note_editor">
                      
                          
                          
                        
                            
                            
                                  <div class="note_editor_wrap">
                                      <textarea id="ckeditor" name="content">
                                        <?php  echo $note_data->content;  ?>
                                      </textarea>
                                      <input type="hidden" id="curID" name="curid" value="<?php  echo $note_data->id;  ?>">
                                  </div>
                            
                        
                                      
                        
                              
                                  <input type="submit" name="submit" value="UPDATE" class="btn btn-primary m-t-15 waves-effect">
                              
                                                
                      
                    </div>
                  <?php echo form_close();?>
                </div>

          
       
            </div>
          </div>
        </div>
      
  </div>
    <!-- #END# Colored Card - With Loading -->
</div>









<!-- Wait Me Plugin Js -->
<script src="<?= base_url()?>public/plugins/waitme/waitMe.js"></script>
<!-- Custom Js -->
<script src="<?= base_url()?>public/js/pages/cards/colored.js"></script>




<!-- Jquery DataTable Plugin Js -->
<script src="<?= base_url()?>public/plugins/jquery-datatable/jquery.dataTables.js"></script>
<script src="<?= base_url()?>public/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
<script src="<?= base_url()?>public/plugins/jquery-datatable/skin/bootstrap/js/dataTables.searchHighlight.min.js"></script>

<script src="<?= base_url()?>public/plugins/jquery-datatable/skin/bootstrap/js/jquery.highlight.js"></script>









<script>

  $( ".side_menu_bar_wrap li" ).each(function( index ) {
    if ($(this).hasClass("active")){
      $(this).removeClass("active");
    }
    $("#my_notes").addClass("active");
  });




var note_datatable = $('#note_datatable').DataTable( {
      "paging":   false,
      "ordering": false,
      "info":     false,
      "searchHighlight": true,
      "ajax": "<?=base_url('admin/my_notes/datatable_json')?>",
      "initComplete": function( settings, json ) {
        $( "#note_datatable tbody tr" ).first().addClass( "selected_tr" );
      },
      "columnDefs": [
            {
                "targets": [ 0 ],
                "orderable": true,
                "visible": true
            },
            {
                "targets": [ 1 ],
                "visible": false,
                "orderable": true,
                "searchable": false
            },
            {
                "targets": [ 2 ],
                "visible": false,
                "orderable": true,
                "searchable": false
            },
            {
                "targets": [ 3 ],
                "visible": false,
                "orderable": true,
                "searchable": false
            },
            {
                "targets": [ 4 ],
                "visible": true,
                "orderable": true,
                "className": "note_left_id_hide",
                "searchable": false
            },
            {
                "targets": [ 5 ],
                "visible": true,
                "orderable": true,
                "className": "note_left_content_hide",
                "searchable": false
            },
            {
                "targets": [ 6 ],
                "visible": true,
                "orderable": true,
                "className": "note_left_userid_hide",
                "searchable": false
            },
            {
                "targets": [ 7 ],
                "visible": true,
                "orderable": true,
                "className": "note_left_tags_hide",
                "searchable": false
            }
        ]
});




    $(".create-note").on( "click", function() {

  // $(".new_create_notes").trigger("click");
  
    //$("#create_note_form").submit();
    $(".new_create_notes").trigger('click');
    console.log("here");
  });






$( "#note_datatable tbody" ).on( "click", "tr", function() {

  $( "#note_datatable tbody tr" ).each(function( index ) {
    if ($(this).hasClass("selected_tr") ){
      $(this).removeClass("selected_tr");
    }
  });

  $(this).addClass("selected_tr");



  //Replace Editor contents
  var editor1 = CKEDITOR.instances.ckeditor; //fck is just my instance name you will need to replace that with yours

  var edata = editor1.getData();
  
  
  var replaced_text = $(this).find(".note_left_content_hide").html(); // you could also use a regex in the replace 

  if (edata != replaced_text) {
    CKEDITOR.instances.ckeditor.setData( replaced_text );
  }
  //alert(replaced_text);
  

  var replaced_title = $(this).find(".show_note_title").text();
  if (replaced_title == "Untitled") {
    $("#subject").val("");
  }else {
    $("#subject").val(replaced_title);
  }
  
  
  var replaced_date = $(this).find(".show_create_date").text();
  $(".right_title_date").text(replaced_date);

  var replaced_tags = $(this).find(".note_left_tags_hide").text();
  $(".right_title_tags").text(replaced_tags);

  var replaced_id = $(this).find(".note_left_id_hide").text();
  $("#curID").val(replaced_id);
  

});




$( ".note_wrap_ctr_btn" ).on( "click", function() {
  if (!$(".row_left").hasClass("col-lg-8")){
    
    $(".row_left").addClass("col-lg-8");
    $(".row_left").addClass("col-md-8");
    $(".row_left").removeClass("col-lg-4");
    $(".row_left").removeClass("col-md-4");

    $(".row_right").addClass("col-lg-4");
    $(".row_right").addClass("col-md-4");
    $(".row_right").removeClass("col-lg-8");
    $(".row_right").removeClass("col-md-8");

    note_datatable.column(1).visible(true);
    note_datatable.column(2).visible(true);
    note_datatable.column(3).visible(true);

  }else {
    
    $(".row_left").removeClass("col-lg-8");
    $(".row_left").removeClass("col-md-8");
    $(".row_left").addClass("col-lg-4");
    $(".row_left").addClass("col-md-4");

    $(".row_right").addClass("col-lg-8");
    $(".row_right").addClass("col-md-8");
    $(".row_right").removeClass("col-lg-4");
    $(".row_right").removeClass("col-md-4");


    note_datatable.column(1).visible(false);
    note_datatable.column(2).visible(false);
    note_datatable.column(3).visible(false);

  }
});

</script>


<!-- Autosize Plugin Js -->
<script src="<?= base_url() ?>public/plugins/autosize/autosize.js"></script> 
<!-- Custom Js -->
<script src="<?= base_url()?>public/js/pages/tables/jquery-datatable.js"></script>

<!-- Ckeditor -->
<script src="<?= base_url()?>public/plugins/ckeditor/ckeditor.js"></script>
<!-- Custom Js -->
<script type="text/javascript">
//CKEditor
CKEDITOR.replace('ckeditor');
CKEDITOR.config.height = 400;




</script>