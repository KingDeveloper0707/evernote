<!-- JQuery DataTable Css -->
<link href="<?= base_url()?>public/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">  
<!-- Bootstrap Select Css -->
<link href="<?= base_url() ?>public/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />

<link href="<?= base_url()?>public/plugins/jquery-datatable/skin/bootstrap/css/dataTables.searchHighlight.css" rel="stylesheet">  


<div class="nav_top_bar">
  <div class="inputContainer search_wrap ">
      <input class="Field search_field" type="search" placeholder="Search"><i class="close_search_btn material-icons">close</i>
      
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
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 row_left row_left_small">
            <div class="card">
                <div class="header">
                    <h2>
                       Your Notes
                    </h2>
                    <ul class="header-dropdown m-r--5">
                        <li class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                <i class="material-icons">sort</i>
                            </a>
                            <ul class="dropdown-menu pull-right">
                                <li><a style="pointer-events: none; color: #666;">Sort By</a></li>
                                <li><a class="sort_menu_item" id="sort_title_notes"><i class="material-icons">south</i><i class="material-icons">north</i><span>Title</span></span></a></li>
                                <li><a class="sort_menu_item" id="sort_updated_notes"><i class="material-icons">south</i><i class="material-icons">north</i><span>Date updated</span></span></a></li>
                                <li><a class="sort_menu_item" id="sort_created_notes"><i class="material-icons">south</i><i class="material-icons">north</i><span>Date created</span></span></a></li>
                            </ul>
                        </li>
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
                  

                  <form class="form-horizontal" id="create_note_form" enctype='multipart/form-data'>
                    <div class="create-note">
                    
                      <div class="create-note-left">CREATE A NOTE</div> <div class="create-note-right"><i class="material-icons">add</i></div>
                      
                    
                    </div>
                 
                    <input type="submit" name="submit" value="UPDATE" class="btn btn-primary m-t-15 waves-effect new_create_notes" style="display: none;">
                  </form>   
                 

                  <div class="table-responsive">
                    <table id="note_datatable" class="table table-bordered table-striped table-hover dataTable">
                      <thead style="display: none;">
                        <tr>
                          <th>Notes Name</th>
                          <th class="hide_created_notes">Created</th>
                          <th class="hide_updated_notes">Updated</th>                          
                          <th class="hide_tags_notes">Tags</th>  
                          <th>note_ID</th> 
                          <th>Content</th> 
                          <th>User_ID</th>  
                          <th>Hide_Tags</th>    
                          <th>Hide_Title</th>                        
                        </tr>
                      </thead>
                      
                    </table>
                  </div>
                    
                  


                </div>
            </div>
        </div>
       

        <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12 row_right">
          <div class="card">
            <div class="body">
                <div class="note-details-wrap">
                 
                  <form class="form-horizontal" id="update_note_form" enctype='multipart/form-data'>
                    <div class="note-details-header">
                      <div class="left_title">
                        TITLE
                      </div>
                      <div class="right_title">
                        
                        <input type="text" id="subject" name="subject" value="<?php if ($note_data) echo $note_data->subject; ?>" placeholder="Enter your title here…." class="note_input">
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
                        <?php  if ($note_data) echo $note_data->created_at;  ?>
                      </div>
                    </div>

                    <div class="note-details-header">
                      <div class="left_title">
                        TAGS
                      </div>
                      <div class="right_title_middle right_title_tags">
                        <?php  if ($note_data){
                         
                          $tag_list = explode(",", $note_data->tags);
                            if(count($tag_list) > 0){
                              foreach ($tag_list as $v) { 
                                   foreach ($tags_data as $tag_data){
                                        if ($tag_data[0] == $v){
                                          ?><div class="tag_list"><?php echo $tag_data[1]; ?></div>
                                          <?php 
                                        }
                                    }
                              }
                            } 
                            
                            ?>   
                            
                        <?php
                        
                          } 
                        
                          

                        
                          ?>
                      </div>
                      <div class="create_new_tag_btn_wrap"> 
                        
                          <input type="text" id="createtag" class="create_tag" name="create_tag">
                         
                       
                        <i class="material-icons create_new_tag_btn">add</i>
                      </div>
                    </div>

                    <div class="note_editor">
                      
                          
                          
                        
                            
                            
                                  <div class="note_editor_wrap">
                                      <textarea id="ckeditor" name="content">
                                        <?php  if ($note_data)echo $note_data->content;  ?>
                                      </textarea>
                                      <input type="hidden" id="curID" name="curid" value="<?php  if ($note_data)echo $note_data->id;  ?>">
                                  </div>
                            
                        
                                      
                        
                              
                                  <input type="submit" name="submit" value="UPDATE" class="btn btn-primary m-t-15 waves-effect update_note">
                              
                                                
                      
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
$(document).ready(function (){
  
  $( ".side_menu_bar_wrap li" ).each(function( index ) {
    if ($(this).hasClass("active")){
      $(this).removeClass("active");
    }
    $("#my_notes").addClass("active");
  });


var sort_order_num = sessionStorage.getItem("sort_order_number");

var init_order_note = "";

if (sort_order_num != null){
  console.log("not null first");
  switch(sort_order_num){
    case "0":
      init_order_note = [[ 0, "desc" ]];
      break;
    case "1":
      init_order_note = [[ 0, "asc" ]];
      break;
    case "2":
      init_order_note = [[ 8, "desc" ]];
      break;
    case "3":
      init_order_note = [[ 8, "asc" ]];
      break;
    case "4":
      init_order_note = [[ 2, "desc" ]];
      break;
    case "5":
      init_order_note = [[ 2, "desc" ]];
      break;
  }
}else{
  init_order_note = [[ 0, "desc" ]];
}


var note_datatable = $('#note_datatable').DataTable( {
      "paging":   false,
      "ordering": true,
      "order": init_order_note,
      "info":     false,
      "searchHighlight": true,
      "deferRender": true,      
      "select": true,
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
                "visible": true,
                "orderable": true,
                "searchable": false,
                "className": "hide_created_notes"
            },
            {
                "targets": [ 2 ],
                "visible": true,
                "orderable": true,
                "searchable": false,
                "className": "hide_updated_notes"
            },
            {
                "targets": [ 3 ],
                "visible": true,
                "orderable": true,
                "searchable": false,
                "className": "hide_tags_notes"
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
            ,
            {
                "targets": [ 8 ],
                "visible": true,
                "orderable": true,
                "className": "note_left_title_hide",
                "searchable": false
            }
        ]
});




  $(".create-note").on( "click", function() {


    $(".new_create_notes").trigger('click');
   
  });



  $('#create_note_form').submit(function(e){
        	
      e.preventDefault(); 
          
      var ajax_url = '<?php echo base_url();?>admin/my_notes/create_notes';
         

    
      $.ajax({
        type: "POST",
        url: ajax_url,   
        dataType: "json",
        success: function(res) {
          console.log("here");
          console.log(res);
          console.log(res['current_id']);

          note_datatable.row.add([
            '<div class="show_create_date">'+res['created_at']+'</div><div class="show_note_title">'+"Untitled"+'</div>',
							
            res['created_at'],
            res['updated_at'],
            res['tags'],
            res['current_id'],
            res['content'],
            res['user_id'],
            res['tags'],
            "Untitled",
          ]).draw(false);


          //note_datatable.ajax.reload();

          //select tr
          $( "#note_datatable tbody tr" ).each(function( index ) {
            var current_id = res['current_id'];
            if ($(this).hasClass("selected_tr") ){
              $(this).removeClass("selected_tr");
            }
    
            if (current_id == $(this).find(".note_left_id_hide").text()){
              $(this).addClass("selected_tr");
            }
            
          });


          var replaced_title = res['subject'];
          if (replaced_title == "Untitled") {
            $("#subject").val("");
          }else {
            $("#subject").val(replaced_title);
          }
          
          
          var replaced_date = res['created_at'];
          $(".right_title_date").text(replaced_date);

          var replaced_tags = res['tags'];
          $(".right_title_tags").text(replaced_tags);

          var replaced_id = res['current_id'];
          $("#curID").val(replaced_id);

          $("#subject").focus();
          CKEDITOR.instances.ckeditor.setData("");
          CKEDITOR.instances.ckeditor.focus();
          
         

         }, error: function(res) {
          console.log('error');
       }
      });

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

  var replaced_tags = $(this).find(".note_left_tags_hide").html();
  $(".right_title_tags").html(replaced_tags);

  var replaced_id = $(this).find(".note_left_id_hide").text();
  $("#curID").val(replaced_id);


  $("#createtag").css("display", "none");

  $("#subject").focus();
  

});

//create new tag click

$(".create_new_tag_btn").on( "click", function() {

  $("#createtag").css("display", "block");
  $("#createtag").focus();

});


$('#createtag').keypress(function (e) {
  if (e.which == 13) {
    $(".update_note").trigger('click');
   // $('form#create_tag_form').submit();
   console.log("aaaaa");
    return false;    //<---- Add this line
  }
});



$('#update_note_form').submit(function(e){
        	
        e.preventDefault(); 
          console.log("create_tags");
        var ajax_url = '<?php echo base_url();?>admin/my_notes/update_notes';
        var data = new FormData(this);

          //Replace Editor contents
        var editor1 = CKEDITOR.instances.ckeditor; //fck is just my instance name you will need to replace that with yours

        var edata = editor1.getData();

        data.append("e_content", edata);
       
         $.ajax({
           type: "POST",
           url: ajax_url,   
           data: data,
           dataType: "json",
           processData:false,
		       contentType:false,
           success: function(res) {
             
             console.log(res);
             var selected_element = $("tr.selected_tr");
             selected_element.attr("id", selected_element.find(".note_left_id_hide").text());
             var current_id = selected_element.find(".note_left_id_hide").text();

             if (res['new_tag_name'] != ""){
               var add_tag = "<div class='tag_list'>" + res['new_tag_name'];
               add_tag = add_tag + "</div>"
              $(".right_title_tags").append( add_tag );
              $("#createtag").css("display", "none");

              $("tr.selected_tr").find(".note_left_tags_hide").append( add_tag );
              $("tr.selected_tr").find(".hide_tags_notes").append( add_tag );
             }
            

              $("tr.selected_tr").find(".hide_updated_notes").text(res['updated_at']);

              if(res['subject'] != ""){
                $("tr.selected_tr").find(".show_note_title").text(res['subject']);
                $("tr.selected_tr").find(".note_left_title_hide").text(res['subject']);
              }else{
                $("tr.selected_tr").find(".show_note_title").text("Untitled");
                $("tr.selected_tr").find(".note_left_title_hide").text("Untitled");  
              }
                

              $("tr.selected_tr").find(".note_left_content_hide").html(res['content']);

             
              note_datatable.ajax.reload();

              console.log(selected_element.find(".note_left_id_hide").text());
              

              setTimeout(function() {
                $( "#note_datatable tbody tr" ).each(function( index ) {
                if ($(this).find(".note_left_id_hide").text() == current_id ){
                  $(this).addClass("selected_tr");
                  console.log("same----", index);
                }
              });
              }, 500);
            

              
   
            }, error: function(res) {
             console.log("error", res);
          }
         });

  });



$( ".note_wrap_ctr_btn" ).on( "click", function() {
  if (!$(".row_left").hasClass("col-lg-8")){
    
    $(".row_left").addClass("col-lg-8");
    $(".row_left").addClass("col-md-8");
    $(".row_left").removeClass("col-lg-4");
    $(".row_left").removeClass("col-md-4");
    $(".row_left").removeClass("row_left_small");
    $(".row_left").addClass("row_left_large");

    $(".row_right").addClass("col-lg-4");
    $(".row_right").addClass("col-md-4");
    $(".row_right").removeClass("col-lg-8");
    $(".row_right").removeClass("col-md-8");

    
   // note_datatable.column(1).visible(true);
   // note_datatable.column(2).visible(true);
   // note_datatable.column(3).visible(true);

  }else {
    
    $(".row_left").removeClass("col-lg-8");
    $(".row_left").removeClass("col-md-8");
    $(".row_left").addClass("col-lg-4");
    $(".row_left").addClass("col-md-4");
    $(".row_left").removeClass("row_left_large");
    $(".row_left").addClass("row_left_small");

    $(".row_right").addClass("col-lg-8");
    $(".row_right").addClass("col-md-8");
    $(".row_right").removeClass("col-lg-4");
    $(".row_right").removeClass("col-md-4");


  //  note_datatable.column(1).visible(false);
  //  note_datatable.column(2).visible(false);
   // note_datatable.column(3).visible(false);

  }
});



//Search Field


$( ".search_btn" ).on( "click", function() {

  console.log("sear_text", $(".search_field").val());
  var search_key = $(".search_field").val();

  //document.getElementByClass("search_field").innerHTML = x;

  if (search_key != ""){
    $(".close_search_btn").css("display", "block");

    $(".dataTables_filter input").val(search_key);

    note_datatable.search(search_key).draw();

    $("#note_datatable tbody tr").first().trigger("click");

  }
 

});


$( ".close_search_btn" ).on( "click", function() { 
  $(".dataTables_filter input").val("");
  
  $(".search_field").val("");
  note_datatable.search("").draw();
  $(this).css("display","none");

  $("#note_datatable tbody tr").first().trigger("click");

});



$('.search_field').keypress(function (e) {
 var key = e.which;
 if(key == 13)  // the enter key code
  {
    $(".search_btn").trigger("click");
    return false;  
  }
});   



///Setting Sort Order



console.log("sort_num", sort_order_num);

if (sort_order_num != null){
  console.log("not null");
  switch(sort_order_num){
    case "0":
      $("#sort_created_notes").addClass("selected");
      $("#sort_created_notes").attr( "sort_order_val", 0 );
      $("#sort_created_notes i").first().addClass("selected");
      sessionStorage.setItem('sort_order_number', 0);
      note_datatable.order( [ 1, 'desc' ] ).draw();
      $( "#note_datatable tbody tr" ).first().addClass( "selected_tr" );
      break;
    case "1":
      $("#sort_created_notes").addClass("selected");
      $("#sort_created_notes").attr( "sort_order_val", 1 );
      $("#sort_created_notes i").last().addClass("selected");
      sessionStorage.setItem('sort_order_number', 1);
      note_datatable.order( [ 1, 'asc' ] ).draw();
      $( "#note_datatable tbody tr" ).first().addClass( "selected_tr" );
      break;
    case "2":
      $("#sort_title_notes").addClass("selected");
      $("#sort_title_notes").attr( "sort_order_val",  2);
      sessionStorage.setItem('sort_order_number', 2);
      $("#sort_title_notes i").first().addClass("selected");
      note_datatable.order( [ 8, 'desc' ] ).draw();
      $( "#note_datatable tbody tr" ).first().addClass( "selected_tr" );
      break;
    case "3":
      $("#sort_title_notes").addClass("selected");
      $("#sort_title_notes").attr( "sort_order_val", 3 );
      sessionStorage.setItem('sort_order_number', 3);
      $("#sort_title_notes i").last().addClass("selected");
      note_datatable.order( [ 8, 'asc' ] ).draw();
      $( "#note_datatable tbody tr" ).first().addClass( "selected_tr" );
      break;
    case "4":
      $("#sort_updated_notes").addClass("selected");
      $("#sort_updated_notes").attr( "sort_order_val", 4);
      sessionStorage.setItem('sort_order_number', 4);
      $("#sort_updated_notes i").first().addClass("selected");
      note_datatable.order( [ 2, 'desc' ] ).draw();
      $( "#note_datatable tbody tr" ).first().addClass( "selected_tr" );
      break;
    case "5":
      $("#sort_updated_notes").addClass("selected");
      $("#sort_updated_notes").attr( "sort_order_val", 5 );
      sessionStorage.setItem('sort_order_number', 5);
      $("#sort_updated_notes i").last().addClass("selected");
      note_datatable.order( [ 2, 'asc' ] ).draw();
      $( "#note_datatable tbody tr" ).first().addClass( "selected_tr" );
      break;
  }
}else{
  console.log("null");
  
  $("#sort_created_notes").addClass("selected");
  $("#sort_created_notes").attr( "sort_order_val", 0 );
  $("#sort_created_notes i").first().addClass("selected");
  sessionStorage.setItem('sort_order_number', 0);
}



$( "#sort_created_notes" ).on( "click", function() { 

  var current_order_val;
  if ($(this).hasClass("selected")){
    current_order_val = $(this).attr("sort_order_val");
    console.log(current_order_val);
    if(current_order_val == 0){
      $(this).attr( "sort_order_val", 1 );
      sessionStorage.setItem('sort_order_number', 1);
      $("#sort_created_notes i").last().addClass("selected");
      
      if ($("#sort_created_notes i").first().hasClass("selected")){
        $("#sort_created_notes i").first().removeClass("selected");
      }
      note_datatable.ajax.reload();
      note_datatable.order( [ 1, 'asc' ] ).draw();

    }else{
      $(this).attr( "sort_order_val", 0 );
      $("#sort_created_notes i").first().addClass("selected");

      sessionStorage.setItem('sort_order_number', 0);

      if ($("#sort_created_notes i").last().hasClass("selected")){
        $("#sort_created_notes i").last().removeClass("selected");
      }
      note_datatable.ajax.reload();
      note_datatable.order( [ 1, 'desc' ] ).draw();
    }
      
  }else {
    $(this).attr( "sort_order_val", 0 );
      $("#sort_created_notes i").first().addClass("selected");

      sessionStorage.setItem('sort_order_number', 0);

      if ($("#sort_created_notes i").last().hasClass("selected")){
        $("#sort_created_notes i").last().removeClass("selected");
      }
      note_datatable.ajax.reload();
      note_datatable.order( [ 1, 'desc' ] ).draw();
  }
 
  $( ".sort_menu_item" ).each(function( index ) {
    if ($(this).hasClass("selected") ){
      $(this).removeClass("selected");
    }
  });

  $(this).addClass("selected");

  var selected_element = $("tr.selected_tr");
  selected_element.attr("id", selected_element.find(".note_left_id_hide").text());
  var current_id = selected_element.find(".note_left_id_hide").text();


  setTimeout(function() {
    $( "#note_datatable tbody tr" ).each(function( index ) {
    if ($(this).find(".note_left_id_hide").text() == current_id ){
      $(this).addClass("selected_tr");
      console.log("same----", index);
    }
  });
  }, 500);



});




$( "#sort_updated_notes" ).on( "click", function() { 

var current_order_val;
if ($(this).hasClass("selected")){
  current_order_val = $(this).attr("sort_order_val");
  console.log(current_order_val);
  if(current_order_val == 4){
    $(this).attr( "sort_order_val", 5 );
    sessionStorage.setItem('sort_order_number', 5);
    $("#sort_updated_notes i").last().addClass("selected");
    
    if ($("#sort_updated_notes i").first().hasClass("selected")){
      $("#sort_updated_notes i").first().removeClass("selected");
    }
    note_datatable.ajax.reload();
    note_datatable.order( [ 2, 'asc' ] ).draw();

  }else{
    $(this).attr( "sort_order_val", 4 );
    $("#sort_updated_notes i").first().addClass("selected");

    sessionStorage.setItem('sort_order_number', 4);

    if ($("#sort_updated_notes i").last().hasClass("selected")){
      $("#sort_updated_notes i").last().removeClass("selected");
    }
    note_datatable.ajax.reload();
    note_datatable.order( [ 2, 'desc' ] ).draw();
  }
    
}else {
  $(this).attr( "sort_order_val", 4 );
    $("#sort_updated_notes i").first().addClass("selected");

    sessionStorage.setItem('sort_order_number', 4);

    if ($("#sort_updated_notes i").last().hasClass("selected")){
      $("#sort_updated_notes i").last().removeClass("selected");
    }
    note_datatable.ajax.reload();
    note_datatable.order( [ 2, 'desc' ] ).draw();
}

$( ".sort_menu_item" ).each(function( index ) {
  if ($(this).hasClass("selected") ){
    $(this).removeClass("selected");
  }
});

$(this).addClass("selected");

var selected_element = $("tr.selected_tr");
  selected_element.attr("id", selected_element.find(".note_left_id_hide").text());
  var current_id = selected_element.find(".note_left_id_hide").text();


  setTimeout(function() {
    $( "#note_datatable tbody tr" ).each(function( index ) {
    if ($(this).find(".note_left_id_hide").text() == current_id ){
      $(this).addClass("selected_tr");
      console.log("same----", index);
    }
  });
  }, 500);



});


$( "#sort_title_notes" ).on( "click", function() { 

var current_order_val;
if ($(this).hasClass("selected")){
  current_order_val = $(this).attr("sort_order_val");
  console.log(current_order_val);
  if(current_order_val == 2){
    $(this).attr( "sort_order_val", 3 );
    sessionStorage.setItem('sort_order_number', 3);
    $("#sort_title_notes i").last().addClass("selected");
    
    if ($("#sort_title_notes i").first().hasClass("selected")){
      $("#sort_title_notes i").first().removeClass("selected");
    }
    note_datatable.ajax.reload();
    note_datatable.order( [ 8, 'asc' ] ).draw();

  }else{
    $(this).attr( "sort_order_val", 2 );
    $("#sort_title_notes i").first().addClass("selected");

    sessionStorage.setItem('sort_order_number', 2);

    if ($("#sort_title_notes i").last().hasClass("selected")){
      $("#sort_title_notes i").last().removeClass("selected");
    }

    note_datatable.ajax.reload();
    note_datatable.order( [ 8, 'desc' ] ).draw();
  }
    
}else {
  $(this).attr( "sort_order_val", 2 );
    $("#sort_title_notes i").first().addClass("selected");

    sessionStorage.setItem('sort_order_number', 2);

    if ($("#sort_title_notes i").last().hasClass("selected")){
      $("#sort_title_notes i").last().removeClass("selected");
    }

    note_datatable.ajax.reload();
    note_datatable.order( [ 8, 'desc' ] ).draw();
}

$( ".sort_menu_item" ).each(function( index ) {
  if ($(this).hasClass("selected") ){
    $(this).removeClass("selected");
  }
});

$(this).addClass("selected");

var selected_element = $("tr.selected_tr");
  selected_element.attr("id", selected_element.find(".note_left_id_hide").text());
  var current_id = selected_element.find(".note_left_id_hide").text();


  setTimeout(function() {
    $( "#note_datatable tbody tr" ).each(function( index ) {
    if ($(this).find(".note_left_id_hide").text() == current_id ){
      $(this).addClass("selected_tr");
      console.log("same----", index);
    }
  });
  }, 500);

  

});


});
</script>




<!-- Ckeditor -->
<script src="<?= base_url()?>public/plugins/ckeditor/ckeditor.js"></script>
<!-- Custom Js -->
<script type="text/javascript">
//CKEditor
CKEDITOR.replace('ckeditor');
CKEDITOR.config.height = 400;




</script>