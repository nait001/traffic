<header class="header dark-bg">
      <div class="toggle-nav">
        <div class="icon-reorder tooltips" data-original-title="Toggle Navigation" data-placement="bottom"><i class="icon_menu"></i></div>
      </div>

      <!--logo start-->
      <a href="index.php" class="logo">Traffic <span class="lite">System</span></a>
      <!--logo end-->

      <div class="nav search-row" id="top_menu">
        <!--  search form start -->
        
        <!--  search form end -->
      </div>

      <div class="top-nav notification-row">
        <!-- notificatoin dropdown start-->
        <ul class="nav pull-right top-menu">

          <!-- task notificatoin start -->
          
          <!-- task notificatoin end -->
          <!-- inbox notificatoin start-->
          
          <!-- inbox notificatoin end -->
          <!-- alert notification start-->
          
          <!-- alert notification end-->
          <!-- user login dropdown start-->
          <?php 
            if(isset($_SESSION['user'])) {
                $user = $_SESSION['user'];
            }
          ?>
          <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="profile-ava">
                                <img alt="" style="width:50px;height:50px;" src="../img/sagay-city-police.jpg">
                            </span>
                            <span class="username"><?php echo ucfirst($user); ?></span>
                            <b class="caret"></b>
                        </a>
            <ul class="dropdown-menu extended logout">
              <div class="log-arrow-up"></div>
              <li class="eborder-top">
                <a href="#" data-toggle="modal" data-target="#credentials"><i class="icon_profile"></i> Change Credentials</a>
              </li> 
              </li>
              <li>
                <a href="process/logout.php"><i class="icon_key_alt"></i> Log Out</a>
              </li> 
            </ul>
          </li>
          <!-- user login dropdown end -->
        </ul>
        <!-- notificatoin dropdown end-->
      </div>
    </header> 
    <div class="modal fade" id="credentials">
        <div class="modal-dialog modal-sm">
            <div class="modal-content" >
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <center><h1>Update Info</h1></center>
                </div>
                <form class="form-validate form-horizontal" method="POST" action="process/change_credentials.php" id="form_credentials">
                    <div class="modal-body"> 
                        <div class="form-group">
                            <label for="username" class="control-label col-lg-3">Username: </label>
                            <div class="col-lg-9">
                                <input style="color:black !important;" type="text" id="username" value="<?php echo $_SESSION['user'] ?>"class="form-control" name="username" readonly />
                            </div> 
                        </div>
                        <div class="form-group ">
                            <label for="u_fname" class="control-label col-lg-3">First Name: </label>
                        <div class="col-lg-9">
                            <input style="color:black !important;" class="form-control" id="u_fname" name="u_fname" type="text" value="<?php echo $_SESSION['fname'] ?>" required />
                        </div>
                        </div>
                        <div class="form-group ">
                            <label for="u_mname" class="control-label col-lg-3">Middle Name: </label>
                        <div class="col-lg-9">
                            <input style="color:black !important;" class="form-control" id="u_mname" name="u_mname" type="text" value="<?php echo $_SESSION['mname'] ?>" />
                        </div>
                        </div>
                        <div class="form-group ">
                            <label for="u_lname" class="control-label col-lg-3">Last name: </label>
                        <div class="col-lg-9">
                            <input style="color:black !important;" class="form-control" id="u_lname" name="u_lname" type="text" value="<?php echo $_SESSION['lname'] ?>" required />
                        </div>
                        </div>
                        <div class="form-group">
                            <label for="old_password" class="control-label col-lg-3">Old Password: </label>
                            <div class="col-lg-9">
                                <input style="color:black !important;" type="password" id="old_password" class="form-control" name="old_password" placeholder="Old Password" />
                            </div> 
                        </div>
                        <input type="hidden" name="pass" value="<?php echo $_SESSION['password'] ?>" />
                        <div class="form-group">
                            <label for="new_pass" class="control-label col-lg-3">New Password: </label>
                            <div class="col-lg-9">
                                <input style="color:black !important;" type="password" id="new_pass" class="form-control" name="new_pass" placeholder="New Password" />
                            </div> 
                        </div>
                        <div class="form-group">
                            <label for="con_pass" class="control-label col-lg-3">Confirm Password: </label>
                            <div class="col-lg-9">
                                <input style="color:black !important;" type="password" id="con_pass" class="form-control" name="con_pass" placeholder="Confirm Password" />
                            </div> 
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary pull-left" id="updates">Save</button>
                    </div>
                </form>  
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div> 