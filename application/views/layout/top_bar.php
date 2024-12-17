<body class="" style="background-color: #ffffff !important;">
  <div class="header navbar navbar-inverse ">
    <!-- BEGIN TOP NAVIGATION BAR -->
    <div class="navbar-inner">
      <div class="header-seperation" >
        <ul class="nav pull-left notifcation-center" id="main-menu-toggle-wrapper" style="display:none">
          <li class="dropdown"> <a id="main-menu-toggle" href="#main-menu"  class="" >
            <div class="iconset top-menu-toggle-white"></div> </a>
          </li>
        </ul>
        <a href="<?=base_url()?>"><span style="color:#ffffff; font-size: 19px; padding-left: 15px; line-height: 60px">
          <?php if (isset($unit_name[0]['company_name_english'])) {
            echo $unit_name[0]['company_name_english'];
          } else if (isset($unit_name)) {
            echo $unit_name;
          }else {
            echo "ERP | AJ Group";
          }
          ?></span>
        </a>

        <ul class="nav pull-right notifcation-center">
        </ul>
      </div> <!-- END RESPONSIVE MENU TOGGLER -->

      <div class="header-quick-nav" >
        <!-- BEGIN TOP NAVIGATION MENU -->
        <div class="pull-left">
          <ul class="nav quick-section">
            <li class="quicklinks"> <a href="javascript:;" class="" id="layout-condensed-toggle" style="color: white;">
              <i class="fa fa-bars" style="font-size: 22px; color: white !important;"></i>
              <!-- <div class="iconset top-menu-toggle-dark"></div> --> </a>
            </li>
          </ul>
        </div> <!-- END TOP NAVIGATION MENU -->

        <!-- BEGIN CHAT TOGGLER -->
        <div class="pull-right">
          <div class="chat-toggler">
            <div class="user-details" style="float:right;">
              <div class="username">
                <span class="" style="margin-left: 20px;">Welcome, <b><?=$username?></b> <img src="<?=base_url()?>awedget/assets/img/avater.jpg"  alt="Profile Image" data-src="<?=base_url()?>awedget/assets/img/avater.jpg" data-src-retina="<?=base_url()?>awedget/assets/img/avater.jpg" width="35" height="35" style="border-radius: 35px;" />
                </span>
              </div>
            </div>
          </div>

          <ul class="nav quick-section ">
            <li class="quicklinks"> <a data-toggle="dropdown" class="dropdown-toggle  pull-right " href="javascript:;" id="user-options">
             <i class="fa fa-cog" style="font-size: 22px; color: white !important;"></i>
             </a>
             <ul class="dropdown-menu  pull-right" role="menu" aria-labelledby="user-options">
                <li><a href="<?=base_url()?>change_password"><i class="fa fa-lock"></i>&nbsp;&nbsp;Change Password</a></li>

                <li><a href="<?=base_url()?>logout_FE"><i class="fa fa-power-off"></i>&nbsp;&nbsp;Log Out</a></li>
              </ul>
            </li>
          </ul>
        </div> <!-- END CHAT TOGGLER -->
      </div> <!-- END TOP NAVIGATION MENU -->
    </div> <!-- END TOP NAVIGATION BAR -->
  </div> <!-- END HEADER -->
