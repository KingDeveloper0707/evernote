<?php $cur_tab = $this->uri->segment(2)==''?'dashboard': $this->uri->segment(2); ?>  
<?php $sub_tab = $this->uri->segment(3)==''?'dashboard': $this->uri->segment(3); ?>

<!-- Left Sidebar -->
<aside id="leftsidebar" class="sidebar">
  <!-- User Info -->
  <div class="sidebar-logo">
    <a class="sidebar-logo-link" href="<?= base_url('admin/dashboard');?>"><img src="<?php echo base_url('public/images/brain_logo.png');?>"/></a>
  </div>
  
  <div class="user-info">
    <div class="image">
      <img src="<?= base_url()?>public/images/user.png" width="48" height="48" alt="User" />
    </div>
    <div class="info-container">
      <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?= strtoupper($this->session->userdata('name'));?></div>
      <div class="email"><?= $this->session->userdata('email');?></div>
      <div class="btn-group user-helper-dropdown">
        <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
        <ul class="dropdown-menu pull-right">
          <li id=""><a href="<?= base_url('admin/profile'); ?>"><i class="material-icons">person</i>Profile</a></li>
          <li role="seperator" class="divider"></li>
          <li id=""><a href="<?= base_url('auth/logout'); ?>"><i class="material-icons">input</i>Sign Out</a></li>
        </ul>
      </div>
    </div>
  </div>
  <!-- #User Info -->
  <!-- Menu -->
  <div class="menu">
    <ul class="list">
      <li class="header">MAIN NAVIGATION</li>
      <li id="dashboard">
        <a href="<?= base_url('admin/dashboard');?>">
          <i class="material-icons">home</i>
          <span>Home</span>
        </a>
      </li>
      <li id="users">
        <a href="javascript:void(0);" class="menu-toggle">
          <i class="material-icons">person</i>
          <span>Users</span>
        </a>
        <ul class="ml-menu">
          <li id="add">
            <a href="<?= base_url('admin/users/add'); ?>">Add New User</a>
          </li>
          <li id="user_list">
            <a href="<?= base_url('admin/users'); ?>">Users List</a>
          </li>
          <li id="group">
            <a href="<?= base_url('admin/group'); ?>">User Group</a>
          </li>
          <li id="profile">
            <a href="<?= base_url('admin/profile'); ?>">User Profile</a>
          </li>
        </ul>
      </li>
      
      <li id="customers">
        <a href="<?= base_url('admin/customers');?>">
          <i class="material-icons">supervisor_account</i>
          <span>Customers</span>
        </a>
      </li>
      
      <li id="requests">
        <a href="<?= base_url('admin/requests');?>">
          <i class="material-icons">textsms</i>
          <span>Requests</span>
        </a>
      </li>
      
      <li id="requests">
        <a href="<?= base_url('admin/payments');?>">
          <i class="material-icons">monetization_on</i>
          <span>Online Payments</span>
        </a>
      </li>

      <li id="templates">
        <a href="javascript:void(0);" class="menu-toggle">
          <i class="material-icons">email</i>
          <span>Email Templates</span>
        </a>
        <ul class="ml-menu">
          <li id="request">
            <a href="<?= base_url('admin/templates/request'); ?>">Request Form</a>
          </li>        
          <li id="payment">
            <a href="<?= base_url('admin/templates/payment'); ?>">Online Payment Form</a>
          </li>
        </ul>
      </li>
                        
      <li id="activity">
        <a href="<?= base_url('admin/activity');?>">
          <i class="material-icons">flag</i>
          <span>Users Activity</span>
        </a>
      </li>

       <li id="general_settings">
        <a href="<?= base_url('admin/general_settings');?>">
          <i class="material-icons">settings</i>
          <span>Settings</span>
        </a>
      </li>

    </ul>
  </div>
  <!-- #Menu -->
  <!-- Footer -->
  <div class="legal">
    <div class="copyright">
      <a href="javascript:void(0);"><?= $this->general_settings['copyright'] ?></a>.
    </div>
  </div>
  <!-- #Footer -->
</aside>
<!-- #END# Left Sidebar -->

<script>
  $("#<?= $cur_tab; ?>").addClass('active');
  $("#<?= $sub_tab; ?>").addClass('active');
</script>
