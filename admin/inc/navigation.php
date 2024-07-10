</style>
<!-- Main Sidebar Container -->
      <aside class="main-sidebar sidebar-dark-teal elevation-4 sidebar-no-expand bg-dark-teal">
        <!-- Brand Logo -->
        <a href="<?php echo base_url ?>admin" class="brand-link bg-transparent text-sm border-info shadow-sm bg-teal">
        <img src="<?php echo validate_image($_settings->info('logo'))?>" alt="Store Logo" class="brand-image img-circle elevation-3 bg-black" style="width: 1.8rem;height: 1.8rem;max-height: unset;object-fit:scale-down;object-position:center center">
        <span class="brand-text font-weight-light"><?php echo $_settings->info('short_name') ?></span>
        </a>
        <!-- Sidebar -->
        <div class="sidebar os-host os-theme-light os-host-overflow os-host-overflow-y os-host-resize-disabled os-host-transition os-host-scrollbar-horizontal-hidden">
          <div class="os-resize-observer-host observed">
            <div class="os-resize-observer" style="left: 0px; right: auto;"></div>
          </div>
          <div class="os-size-auto-observer observed" style="height: calc(100% + 1px); float: left;">
            <div class="os-resize-observer"></div>
          </div>
          <div class="os-content-glue" style="margin: 0px -8px; width: 249px; height: 646px;"></div>
          <div class="os-padding">
            <div class="os-viewport os-viewport-native-scrollbars-invisible" style="overflow-y: scroll;">
              <div class="os-content" style="padding: 0px 8px; height: 100%; width: 100%;">
                <!-- Sidebar user panel (optional) -->
                <div class="clearfix"></div>
                <!-- Sidebar Menu -->
                <nav class="mt-4">
                   <ul class="nav nav-pills nav-sidebar flex-column text-sm nav-compact nav-flat nav-child-indent nav-collapse-hide-child" data-widget="treeview" role="menu" data-accordion="false">
                   <li class="nav-item dropdown">                    
                      <a href="./" class="nav-link nav-home">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                          Dashboard
                        </p>
                      </a>
                    </li>
                    <?php if($_settings->userdata('type') == 0): ?>
                    <li class="nav-item dropdown">                    
                      <a href="<?php echo base_url ?>admin/?page=inquiries" class="nav-link nav-inquiries">
                        <i class="nav-icon fas fa-inbox"></i>
                        <p>
                          Inquiries
                        </p>
                      </a>
                    </li>
                    <?php endif; ?>
                    <?php if($_settings->userdata('type') == 0 || $_settings->userdata('type') == 1 || $_settings->userdata('type') == 3): ?>
                    <li class="nav-item dropdown">                    
                      <a href="<?php echo base_url ?>admin/?page=timekeeping" class="nav-link nav-timekeeping">
                        <i class="nav-icon fas fa-user-clock"></i>
                        <p>
                          Timekeeping
                        </p>
                      </a>
                    </li>
                    <?php endif; ?>
                    <?php if($_settings->userdata('type') == 0 || $_settings->userdata('type') == 2): ?>
                    <li class="nav-header">Medical</li>
                    <?php endif; ?>
                    <?php if($_settings->userdata('type') == 0): ?>
                    <li class="nav-item dropdown">
                      <a href="<?php echo base_url ?>admin/?page=patients" class="nav-link nav-patients">
                        <i class="nav-icon fas fa-user-injured"></i>
                        <p>
                          Patient List
                        </p>
                      </a>
                    </li>
                    <li class="nav-item dropdown">
                      <a href="<?php echo base_url ?>admin/?page=nurses" class="nav-link nav-nurses">
                        <i class="nav-icon fas fa-user-nurse"></i>
                        <p>
                          Nurse List
                        </p>
                      </a>
                    </li>
                    <li class="nav-item dropdown">
                      <a href="<?php echo base_url ?>admin/?page=doctors" class="nav-link nav-doctors">
                        <i class="nav-icon fas fa-user-md"></i>
                        <p>
                          Doctor List
                        </p>
                      </a>
                    </li>
                    <?php endif; ?>
                    <?php if($_settings->userdata('type') == 2): ?>
                    <li class="nav-item dropdown">
                      <a href="<?php echo base_url ?>admin/?page=patient_records" class="nav-link nav-patient_records">
                        <i class="nav-icon fas fa-clipboard"></i>
                        <p>
                          Patient Records  
                        </p>
                      </a>
                    </li>
                    <li class="nav-item dropdown">
                      <a href="<?php echo base_url ?>admin/?page=prescription_assistance" class="nav-link nav-prescription_assistance">
                        <i class="nav-icon fas fa-prescription"></i>
                        <p>
                          Prescription Assistance   
                        </p>
                      </a>
                    </li>
                    <?php endif; ?>
                    <?php if($_settings->userdata('type') == 0): ?>
                    <li class="nav-item dropdown">
                      <a href="<?php echo base_url ?>admin/?page=prescription_doctor" class="nav-link nav-prescription_doctor"> <!-- This is for doctor view.! -->
                        <i class="nav-icon fas fa-prescription"></i>
                        <p>
                          Prescription Assistance
                        </p>
                      </a>
                    </li>
                    <?php endif; ?>
                    <?php if($_settings->userdata('type') == 2): ?>
                    <li class="nav-header">Emergency</li>
                    <li class="nav-item dropdown">
                      <a href="<?php echo base_url ?>admin/?page=emergency" class="nav-link nav-emergency">
                        <i class="nav-icon fa fa-heartbeat"></i>
                        <p>
                          Emergency Room
                        </p>
                      </a>
                    </li>
                    <?php endif; ?> 
                    <?php if($_settings->userdata('type') == 0): ?>
                    <li class="nav-item dropdown">
                      <a href="<?php echo base_url ?>admin/?page=emergency_doctor" class="nav-link nav-emergency_doctor">
                        <i class="nav-icon fa fa-heartbeat"></i>
                        <p>
                          Emergency Room
                        </p>
                      </a>
                    </li>
                    <?php endif; ?> 
                    <?php if($_settings->userdata('type') == 2): ?>
                    <li class="nav-item dropdown">
                      <a href="<?php echo base_url ?>admin/?page=ambulance" class="nav-link nav-ambulance">
                        <i class="nav-icon fas fa-ambulance"></i>
                        <p>
                          Ambulance   
                        </p>
                      </a>
                    </li>
                    <?php endif; ?> 
                    <?php if($_settings->userdata('type') == 3): ?>
                    <li class="nav-item dropdown">
                      <a href="<?php echo base_url ?>admin/?page=ambulance_doctor" class="nav-link nav-ambulance_doctor">
                        <i class="nav-icon fas fa-ambulance"></i>
                        <p>
                          Ambulance
                        </p>
                      </a>
                    </li>
                    <?php endif; ?> 
                    <li class="nav-header">Administration</li>
                    <?php if($_settings->userdata('type') == 2): ?>
                    <li class="nav-item dropdown">
                      <a href="<?php echo base_url ?>admin/?page=billing" class="nav-link nav-billing">
                        <i class="nav-icon fas fa-file-invoice-dollar"></i>
                        <p>
                          Billing 
                        </p>
                      </a>
                    </li>
                    <?php endif; ?>      
                    <?php if($_settings->userdata('type') == 0): ?>          
                    <li class="nav-item dropdown">
                      <a href="<?php echo base_url ?>admin/?page=inventory" class="nav-link nav-inventory">
                        <i class="nav-icon fas fa-file-excel"></i>
                        <p>
                          Inventory    
                        </p>
                      </a>
                    </li>
                    <li class="nav-item dropdown">
                      <a href="<?php echo base_url ?>admin/?page=equipment" class="nav-link nav-equipment">
                        <i class="nav-icon fas fa-microscope"></i>
                        <p>
                          Equipment/Items    
                        </p>
                      </a>
                    </li>
                    <?php endif; ?>
                    <?php if($_settings->userdata('type') == 0): ?> 
                    <li class="nav-item dropdown">
                      <a href="<?php echo base_url ?>admin/?page=hospital_staff" class="nav-link nav-hospital_staff">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                          Hospital Staff 
                        </p>
                      </a>
                    </li>
                    <li class="nav-header">Maintenance</li>
                    <li class="nav-item dropdown">
                      <a href="<?php echo base_url ?>admin/?page=room_types" class="nav-link nav-room_types">
                        <i class="nav-icon fas fa-th-list"></i>
                        <p>
                          Room Types List
                        </p>
                      </a>
                    </li>
                    <li class="nav-item dropdown">
                      <a href="<?php echo base_url ?>admin/?page=rooms" class="nav-link nav-rooms">
                        <i class="nav-icon fas fa-door-open"></i>
                        <p>
                          Room List
                        </p>
                      </a>
                    </li>
                    <?php endif; ?>   
                    <?php if($_settings->userdata('type') == 1): ?>
                    <li class="nav-item dropdown">
                      <a href="<?php echo base_url ?>admin/?page=user/list" class="nav-link nav-user_list">
                        <i class="nav-icon fas fa-users-cog"></i>
                        <p>
                          User List
                        </p>
                      </a>
                    </li>
                    <li class="nav-item dropdown">
                      <a href="<?php echo base_url ?>admin/?page=system_info" class="nav-link nav-system_info">
                        <i class="nav-icon fas fa-cogs"></i>
                        <p>
                          Settings
                        </p>
                      </a>
                    </li>
                    <?php endif; ?>
                  </ul>
                </nav>
                <!-- /.sidebar-menu -->
              </div>
            </div>
          </div>
          <div class="os-scrollbar os-scrollbar-horizontal os-scrollbar-unusable os-scrollbar-auto-hidden">
            <div class="os-scrollbar-track">
              <div class="os-scrollbar-handle" style="width: 100%; transform: translate(0px, 0px);"></div>
            </div>
          </div>
          <div class="os-scrollbar os-scrollbar-vertical os-scrollbar-auto-hidden">
            <div class="os-scrollbar-track">
              <div class="os-scrollbar-handle" style="height: 55.017%; transform: translate(0px, 0px);"></div>
            </div>
          </div>
          <div class="os-scrollbar-corner"></div>
        </div>
        <!-- /.sidebar -->
      </aside>
      <script>
        var page;
    $(document).ready(function(){
      page = '<?php echo isset($_GET['page']) ? $_GET['page'] : 'home' ?>';
      page = page.replace(/\//gi,'_');

      if($('.nav-link.nav-'+page).length > 0){
             $('.nav-link.nav-'+page).addClass('active')
        if($('.nav-link.nav-'+page).hasClass('tree-item') == true){
            $('.nav-link.nav-'+page).closest('.nav-treeview').siblings('a').addClass('active')
          $('.nav-link.nav-'+page).closest('.nav-treeview').parent().addClass('menu-open')
        }
        if($('.nav-link.nav-'+page).hasClass('nav-is-tree') == true){
          $('.nav-link.nav-'+page).parent().addClass('menu-open')
        }

      }
      
		$('#receive-nav').click(function(){
      $('#uni_modal').on('shown.bs.modal',function(){
        $('#find-transaction [name="tracking_code"]').focus();
      })
			uni_modal("Enter Tracking Number","transaction/find_transaction.php");
		})
    })
  </script>