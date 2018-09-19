<aside>
	<div id="sidebar" class="nav-collapse ">
		<!-- sidebar menu start-->
        	<ul class="sidebar-menu">
				<li class="">
            		<a class="" href="home.php">
						<i class="icon_house_alt"></i>
						<span>Home</span>
					</a>
				</li>
				<li class="sub-menu">
					<a href="view.php" class="">
						<i class="icon_document_alt"></i>
						<span>View Records</span>
					</a>
				</li>
				<?php if($_SESSION['level'] != 2): ?>
					<li>
						<a class="" href="violation.php">
							<i class="fa fa-exclamation-triangle"></i>
							<span>Add Violation</span>

						</a>

					</li> 
					<li>
						<a class="" href="penalty.php">
							<i class="fa fa-rouble"></i>
							<span>Add Penalty</span>
						</a>
					</li>
				<?php endif ?>
				<li class="sub-menu">
					<a href="violator.php" class="">
						<i class="fa fa-user"></i>
						<span>Add Violator</span>
					</a>
				</li>
				<?php if($_SESSION['level'] != 2): ?>
				<li class="sub-menu">
					<a href="endorser.php" class="">
						<i class="fa fa-user"></i>
						<span>Add Endorser</span>
					</a>
				</li>
				<?php endif ?>
				<?php if($_SESSION['level'] != 3 && $_SESSION['level'] != 2): ?>
					<li class="sub-menu">
						<a href="register_user.php" class="">
							<i class="fa fa-user"></i>
							<span>Register User</span>
						</a>
					</li>
					<li class="sub-menu">
						<a href="view_users.php" class="">
							<i class="fa fa-user"></i>
							<span>View User</span>
						</a>
					</li>
				<?php endif ?>
				</ul>
        <!-- sidebar menu end-->
      </div>
    </aside>