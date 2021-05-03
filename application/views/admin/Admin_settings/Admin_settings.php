<!-- JQuery DataTable Css -->
<link href="<?= base_url()?>public/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">  
<!-- Bootstrap Select Css -->
<link href="<?= base_url() ?>public/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
<link href="<?= base_url()?>public/plugins/jquery-datatable/skin/bootstrap/css/dataTables.searchHighlight.css" rel="stylesheet">  



<div class="nav_top_bar hide_nav_top_bar">
  <div class="inputContainer header_title_wrap ">
     <div class="header_title">Admin</div>
  </div>

  <div class="nav_logout">
        <a href="<?= base_url('auth/logout');?>" class="logout_btn">
          <span>LOGOUT</span>
        </a>
  </div>

</div>



<div class="manage_row_wrap col-lg-3 col-md-3 col-sm-12 col-xs-12">
    <div class="manage_title">Manage</div>

    <div class="manage_body selected" id="admin_manage_users">Users</div>
    <div class="manage_body" id="admin_manage_notes">Notes ( total <span class="my_cur_notes_counts"><?= $counts; ?></span> )</div>
    <div class="manage_body" id="admin_manage_tags">Tags</div>
</div>




<div class=" users_row_wrap col-lg-9 col-md-9 col-sm-12 col-xs-12">
      
Users

</div>

<div class=" notes_row_wrap col-lg-9 col-md-9 col-sm-12 col-xs-12">

    <div class="action_bar_wrap">
        <div class="action_bar_title">Actions</div>
        <div class="action_bar_line">|</div>
        <div class="action_bar_action" id="edit_notes_btn">Edit</div>
        <?php echo form_open(base_url('admin/profile/delete_notes'), 'class="form-horizontal"' )?>  
            <div class="action_bar_action" id="delete_notes_btn">Delete</div>
        <?php echo form_close(); ?>
       
        <div class="action_bar_action" id="active_notes_btn">Active/Inactive</div>
    </div>

    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
               
                <div class="body">
                    <div class="table-responsive">
                       

                        <table id="show_note_datatable" class="table table-bordered table-striped table-hover dataTable">
                            <thead>
                            <tr>
                                <th class="show_note_table_check"></th>
                                <th class="show_note_table_title">Title</th>
                                <th>Date Added</th> 
                                <th class="hide_note_tags"></th>
                                <th class="hide_note_id"></th>
                                <th class="hide_note_content"></th>
                                <th class="hide_note_userid"></th>
                                <th class="hide_note_username"></th>
                                <th class="hide_note_active"></th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th></th>
                                <th>Title</th>
                                <th>Date Added</th> 
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div> 
</div>


<div class=" tags_row_wrap col-lg-9 col-md-9 col-sm-12 col-xs-12">
Tags
</div>





<!-- Trigger the modal with a button -->
<button type="button" class="btn btn-info btn-lg show_modal_btn" data-toggle="modal" data-target="#myModal">Open Modal</button>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body">
        
        <div class="pop_row">
            <div class="card">
                <div class="body">
                    <div class="note-details-wrap">

                        <form class="form-horizontal" id="update_note_form" enctype='multipart/form-data'>
                            <div class="note-details-header">
                                <div class="left_title">
                                TITLE
                                </div>
                                <div class="right_title">
                                
                                <input type="text" id="subject" name="subject" value="" placeholder="Enter your title here…." class="note_input">
                                </div>
                            </div>

                            <div class="note-details-header">
                                <div class="left_title">
                                AUTHOR
                                </div>
                                <div class="right_title_middle right_title_name">
                                            
                                </div>
                            </div>

                            <div class="note-details-header">
                                <div class="left_title">
                                DATE
                                </div>
                                <div class="right_title_middle right_title_date">
                                
                                </div>
                            </div>

                            <div class="note-details-header">
                                <div class="left_title">
                                TAGS
                                </div>
                                <div class="right_title_middle right_title_tags">
                                
                                </div>
                                <div class="create_new_tag_btn_wrap"> 
                                
                                    <input type="text" id="createtag" class="create_tag" name="create_tag">
                                    
                                
                                <i class="material-icons create_new_tag_btn">add</i>
                                </div>
                            </div>

                            <div class="note_editor">
                                    
                                            <div class="note_editor_wrap">
                                                <textarea id="ckeditor" name="content">
                                            
                                                </textarea>
                                                <input type="hidden" id="curID" name="curid" value="">
                                            </div>
                                        
                                            <input type="submit" name="submit" value="UPDATE" class="btn btn-primary m-t-15 waves-effect update_note" style="display: none;">
                                
                            </div>
                        <?php echo form_close();?>
                    </div>

                

                </div>
            </div>
        </div>



      </div>
      
    </div>

  </div>
</div>




<!-- Jquery DataTable Plugin Js -->
<script src="<?= base_url()?>public/plugins/jquery-datatable/jquery.dataTables.js"></script>
<script src="<?= base_url()?>public/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
<script src="<?= base_url()?>public/plugins/jquery-datatable/skin/bootstrap/js/dataTables.searchHighlight.min.js"></script>

<script src="<?= base_url()?>public/plugins/jquery-datatable/skin/bootstrap/js/jquery.highlight.js"></script>
<script src="<?= base_url()?>public/plugins/bootbox/bootbox.min.js"></script>



<script>

$(document).ready(function() {

    $( ".side_menu_bar_wrap li" ).each(function( index ) {
        if ($(this).hasClass("active")){
            $(this).removeClass("active");
        }
        $("#admin_settings").addClass("active");
    });

    

    $(".manage_body").on( "click", function() {
        $( ".manage_body" ).each(function( index ) {
            if ($(this).hasClass("selected")){
                $(this).removeClass("selected");
            }            
        });

        $(this).addClass("selected");

        var current_id = $(this).attr("id");

        if (current_id == "admin_manage_users"){
            $(".users_row_wrap ").css("display", "block");
            $(".notes_row_wrap  ").css("display", "none");
            $(".tags_row_wrap  ").css("display", "none");
        }else if (current_id == "admin_manage_notes"){
            $(".users_row_wrap ").css("display", "none");
            $(".notes_row_wrap  ").css("display", "block");
            $(".tags_row_wrap  ").css("display", "none");
        }else if (current_id == "admin_manage_tags"){
            $(".users_row_wrap ").css("display", "none");
            $(".notes_row_wrap  ").css("display", "none");
            $(".tags_row_wrap  ").css("display", "block");
        }        


    });

    
    

    

    var show_note_datatable = $('#show_note_datatable').DataTable( {
        
        "ordering": true,
        "searchHighlight": true,
        "deferRender": true,   
        "order": [[ 2, "desc" ]],   
        "select": true,
        "iDisplayLength": 25,
        "language": {
            "lengthMenu": "Display _MENU_ Notes per page",
            "zeroRecords": "Nothing found - sorry",
            "info": "Showing page _PAGE_ of _PAGES_ ",
            "infoEmpty": "No notes available",
            "infoFiltered": "(filtered from _MAX_ total notes)"
        },
        "ajax": "<?=base_url('admin/admin_settings/datatable_json')?>",       
        "columnDefs": [
              {
                  "targets": [ 0 ],
                  "orderable": false,
                  "searchable": false, 
                  "width":"5%",
                  "visible": true
              },
              {
                  "targets": [ 1 ],
                  "visible": true,
                  "orderable": true,
                  "searchable": true,
                  "width":"75%",
                  "className": "hide_created_notes"
              },
              {
                  "targets": [ 2 ],
                  "visible": true,
                  "orderable": true,
                  "searchable": false,
                  "width":"20%",
                  "className": "hide_updated_notes"
              },
              {
                  "targets": [ 3 ],
                  "visible": true,
                  "orderable": true,
                  "searchable": false,
                  "width":"20%",
                  "className": "hide_notes_tags"
              },
              {
                  "targets": [ 4 ],
                  "visible": true,
                  "orderable": true,
                  "searchable": false,
                  "width":"20%",
                  "className": "hide_notes_id"
              },
              {
                  "targets": [ 5 ],
                  "visible": true,
                  "orderable": true,
                  "searchable": false,
                  "width":"20%",
                  "className": "hide_notes_content"
              },
              {
                  "targets": [ 6 ],
                  "visible": true,
                  "orderable": true,
                  "searchable": false,
                  "width":"20%",
                  "className": "hide_notes_userid"
              },
              {
                  "targets": [ 7 ],
                  "visible": true,
                  "orderable": true,
                  "searchable": false,
                  "width":"10%",
                  "className": "hide_notes_username"
              },
              {
                  "targets": [ 8 ],
                  "visible": true,
                  "orderable": true,
                  "searchable": false,
                  "width":"10%",
                  "className": "hide_notes_active"
              }
          ]
    });




        $('#active_notes_btn').on('click', function(e) {
            
            e.preventDefault(); 

            var allVals = [];  
            $("#show_note_datatable .chkclass:checked").each(function() {  
                allVals.push($(this).attr('value'));
            });  

            if(allVals.length <=0)  
            {  
                bootbox.alert("Please select Note!");
            }  else {  

                var ajax_url = '<?php echo base_url();?>admin/admin_settings/active_inactive_notes';
                var note_id = $("#show_note_datatable tbody tr.selected_tr .hide_notes_id").text();
                var active_val = $("#show_note_datatable tbody tr.selected_tr .hide_notes_active").text();


                $.ajax({
                    type: "POST",
                    url: ajax_url,   
                    data: {note_id: note_id, active_val: active_val},
                    success: function(res) {
                    
                            console.log("complete", res); 
                    

                        }, error: function(res) {
                            console.log('error');
                    }
                });


                if( $("#show_note_datatable tbody tr.selected_tr").find(".hide_notes_active").text() == "0"){
                    $("#show_note_datatable tbody tr.selected_tr .show_note_title").removeClass("inactive_title");
                    $("#show_note_datatable tbody tr.selected_tr").find(".hide_notes_active").text("1");
                }else {
                    $("#show_note_datatable tbody tr.selected_tr .show_note_title").addClass("inactive_title");
                    $("#show_note_datatable tbody tr.selected_tr").find(".hide_notes_active").text("0");
                }

            }
        
           

            
        });
   
  
        $('#delete_notes_btn').on('click', function(e) {
 
            e.preventDefault(); 

            var allVals = [];  
            $("#show_note_datatable .chkclass:checked").each(function() {  
                allVals.push($(this).attr('value'));
            });  
 
            if(allVals.length <=0)  
            {  
                bootbox.alert("Please select Note!");
            }  else {  
 
                //var check = confirm("Are you sure you want to delete this row?");  

                bootbox.confirm({
                    message: "Are you sure you want to delete this note?",
                    buttons: {
                        confirm: {
                        label: 'Delete'//,
                        //className: 'btn-class-here'
                        },
                        cancel: {
                        label: 'No'//,
                        //className: 'btn-class-here'
                        }
                    },
                    callback:function(result){
                        /* your callback code */ 
                        if(result){  
    
                        var join_selected_values = allVals.join(","); 

                        console.log(join_selected_values);
                        var ajax_url = '<?php echo base_url();?>admin/admin_settings/delete_notes';



                            $.ajax({
                                type: "POST",
                                url: ajax_url,   
                                data: 'ids='+join_selected_values,
                                success: function(res) {
                                
                                    
                                    $(".chkclass:checked").each(function() {  
                                        show_note_datatable.row( $(this).parents('tr') ).remove().draw();
                                    });                           

                                    $(".my_cur_notes_counts").text(show_note_datatable.rows().count());

                                   

                                    }, error: function(res) {
                                        console.log('error');
                                }
                            });
                                    
                        } 
                    } 
                }                   
                )
                 
            }  
        });

        $(document).on('click', '#show_note_datatable tbody tr', function(){ 
       
                    
            if($(this).find(".chkclass").is(':checked',true))  
            {
                
                $(this).find(".chkclass").prop('checked', true);  
            } else {  
                
                $(this).find(".chkclass").prop('checked',true);  
            }  

            
        });


        $(document).on('click', '.chkclass', function(){ 
        
            
            if($(this).is(':checked',true))  
            {
                
                $(this).prop('checked', false);  
            } else {  
                
                $(this).prop('checked',true);  
            }  
        });


        


        $( "#show_note_datatable tbody" ).on( "click", "tr", function() {

            

            $( "#show_note_datatable tbody tr" ).each(function( index ) {
                if ($(this).hasClass("selected_tr") ){
                    $(this).removeClass("selected_tr");
                }

                if($(this).find(".chkclass").is(':checked',true))  
                {
                    
                    $(this).find(".chkclass").prop('checked', false);  
                }
            });

            $(this).addClass("selected_tr");
            if($(this).find(".chkclass").is(':checked',true))  
            {
                
                $(this).find(".chkclass").prop('checked', true);  
            } else {  
                
                $(this).find(".chkclass").prop('checked',false);  
            }  
           

        });


        $('#edit_notes_btn').on('click', function(e) {
 
            e.preventDefault(); 

            var allVals = [];  
            $("#show_note_datatable .chkclass:checked").each(function() {  
                allVals.push($(this).attr('value'));
            });  

            if(allVals.length <=0)  
            {  
                bootbox.alert("Please select Note!");
            }  else {  
                    //Replace Editor contents
                    var editor1 = CKEDITOR.instances.ckeditor; //fck is just my instance name you will need to replace that with yours

                    var edata = editor1.getData();


                    var replaced_text = $("#show_note_datatable tbody tr.selected_tr").find(".hide_notes_content").html(); // you could also use a regex in the replace 

                    if (edata != replaced_text) {
                        CKEDITOR.instances.ckeditor.setData( replaced_text );
                    }
                    //alert(replaced_text);



                    current_ck_content = editor1.getData();

                    var replaced_title = $("#show_note_datatable tbody tr.selected_tr").find(".show_note_title").text();
                    if (replaced_title == "Untitled") {
                        $("#subject").val("");
                    }else {
                        $("#subject").val(replaced_title);
                    }


                    var replaced_date = $("#show_note_datatable tbody tr.selected_tr").find(".hide_updated_notes").text();
                    $(".right_title_date").text(replaced_date);

                    var replaced_tags = $("#show_note_datatable tbody tr.selected_tr").find(".hide_notes_tags").html();
                    $(".right_title_tags").html(replaced_tags);

                    var replaced_id = $("#show_note_datatable tbody tr.selected_tr").find(".hide_notes_id").text();
                    $("#curID").val(replaced_id);

                    $(".right_title_name").text($("#show_note_datatable tbody tr.selected_tr").find(".hide_notes_username").text());


                    $("#createtag").css("display", "none");

                    $("#subject").focus();


                    $(".show_modal_btn").trigger("click");
            }
        });


        //double click = show popup 
        $(document).on('dblclick', '#show_note_datatable tbody tr', function(){ 
        

            
              //Replace Editor contents
            var editor1 = CKEDITOR.instances.ckeditor; //fck is just my instance name you will need to replace that with yours

            var edata = editor1.getData();


            var replaced_text = $(this).find(".hide_notes_content").html(); // you could also use a regex in the replace 

            if (edata != replaced_text) {
                CKEDITOR.instances.ckeditor.setData( replaced_text );
            }
            //alert(replaced_text);



            current_ck_content = editor1.getData();

            var replaced_title = $(this).find(".show_note_title").text();
            if (replaced_title == "Untitled") {
                $("#subject").val("");
            }else {
                $("#subject").val(replaced_title);
            }


            var replaced_date = $(this).find(".hide_updated_notes").text();
            $(".right_title_date").text(replaced_date);

            var replaced_tags = $(this).find(".hide_notes_tags").html();
            $(".right_title_tags").html(replaced_tags);

            var replaced_id = $(this).find(".hide_notes_id").text();
            $("#curID").val(replaced_id);

            $(".right_title_name").text($(this).find(".hide_notes_username").text());


            $("#createtag").css("display", "none");

            $("#subject").focus();


            $(".show_modal_btn").trigger("click");
            
        });

       
        //Modal close
        $('#myModal').on('hidden.bs.modal', function () {
            // do something…
            console.log("Clicked---close--new");
            $(".update_note").trigger('click');
           
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

             return false;    //<---- Add this line
            }
        });



        //getting list of added filter rows and fitler_tags list Function
        function getting_list_filter(){

        
            var filter_row_list = [];

            $( "#show_note_datatable tbody tr" ).each(function( index ) {
                if ($(this).attr("filter_tags") != null){


                    if($(this).hasClass("added_filter_row")){
                        filter_row_list.push([1, $(this).attr("filter_tags"), $(this).find(".hide_notes_id").text()]); 
                    }else{
                        filter_row_list.push([0, $(this).attr("filter_tags"), $(this).find(".hide_notes_id").text()]); 
                    }

                }
            });

            return filter_row_list;       

        };



        $('#update_note_form').submit(function(e){
        	
            e.preventDefault(); 
              console.log("create_tags");
            var ajax_url = '<?php echo base_url();?>admin/admin_settings/update_notes';
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
                 
                 
                 var selected_element = $("#show_note_datatable tr.selected_tr");
                 selected_element.attr("id", selected_element.find(".hide_notes_id").text());
                 var current_id = selected_element.find(".hide_notes_id").text();
    
    
                 var filter_row_list = [];
                 filter_row_list = getting_list_filter();
    
                 if (res['new_tag_name'] != ""){
                   var add_tag = "<div class='tag_list'>" + res['new_tag_name'];
                   add_tag = add_tag + "</div>"
                  $(".right_title_tags").append( add_tag );
                  $("#createtag").css("display", "none");
    
                  $("#show_note_datatable tr.selected_tr").find(".note_left_tags_hide").append( add_tag );
                  $("#show_note_datatable tr.selected_tr").find(".hide_tags_notes").append( add_tag );
                 }
                
    
                  $("#show_note_datatable tr.selected_tr").find(".hide_updated_notes").text(res['updated_at']);
    
                  if(res['subject'] != ""){
                    $("#show_note_datatable tr.selected_tr").find(".show_note_title").text(res['subject']);
                    $("#show_note_datatable tr.selected_tr").find(".note_left_title_hide").text(res['subject']);
                  }else{
                    $("#show_note_datatable tr.selected_tr").find(".show_note_title").text("Untitled");
                    $("#show_note_datatable tr.selected_tr").find(".note_left_title_hide").text("Untitled");  
                  }
                    
    
                  $("#show_note_datatable tr.selected_tr").find(".note_left_content_hide").html(res['content']);
    
                 
                  show_note_datatable.ajax.reload();
    
                  
    
                  setTimeout(function() {
                        $( "#show_note_datatable tbody tr" ).each(function( index ) {
        
                        if ($(this).find(".hide_notes_id").text() == current_id ){
                             $(this).addClass("selected_tr");   
                             $(this).find(".chkclass").prop('checked', true);                
                        }
        
                        var i;
                        for (i = 0; i < filter_row_list.length; i++) {
                            // do something with `substr[i]`
                            if ($(this).find(".hide_notes_id").text() == filter_row_list[i][2] ){
                                $(this).attr("filter_tags", filter_row_list[i][1]);
                                
                                if(filter_row_list[i][0] == 1){
                                    $(this).addClass("added_filter_row");
                                }
                            }
                        }

                        if( $(this).find(".hide_notes_active").text() == "0"){
                            $(this).addClass("inactive_tr");
                        }
        
                    });
                  }, 500);
                
    
                  
       
                }, error: function(res) {
                 console.log("error", res);
              }
             });
    
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