

<div class="nav_top_bar">
  <div class="inputContainer search_wrap">
      <input class="Field search_field" type="text" placeholder="Search">
      
      <i class="material-icons search_btn">search</i>
  </div>

  <div class="nav_logout">
        <a href="<?= base_url('auth/logout');?>" class="logout_btn">
          <span>LOGOUT</span>
        </a>
  </div>

</div>










<script>

  $( ".side_menu_bar_wrap li" ).each(function( index ) {
    if ($(this).hasClass("active")){
      $(this).removeClass("active");
    }
    $("#my_notes").addClass("active");
  });

</script>