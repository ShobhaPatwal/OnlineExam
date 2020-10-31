<?php
$url = $_SERVER['REQUEST_URI'];
$path = parse_url($url, PHP_URL_PATH);
$filename = basename($path);
$test_menu = array('tests.php', 'add_test.php', 'viewTest.php');
$user_menu = array('test_result.php', 'users.php');
?>
<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
	<div class="profile-sidebar">
		<div class="profile-usertitle">
			<div class="profile-usertitle-name">
				<?php
				$sql = "SELECT * FROM admin WHERE admin_id='".$_SESSION['admindata']['admin_id']."'";
				$result = $conn->query($sql);
				if ($result->num_rows > 0) {
					$row = $result->fetch_assoc();
                    echo ucfirst($row['name']);
                } ?>
                </div>
			<div class="profile-usertitle-status">
				<?php
				if (isset($_SESSION['admindata']['admin_email'])) : ?>
					<span class="indicator label-success"></span>Online
				<?php endif;?>
			</div>
		</div>
		<div class="clear"></div>
	</div>
	<div class="divider"></div>
	<ul class="nav menu">
		<li <?php if($filename == 'index.php'): ?>class="current"<?php endif; ?>><a href="index.php"><em class="fa fa-dashboard">&nbsp;</em> Dashboard</a></li>
		<li class="parent <?php if(in_array($filename,$test_menu)): ?>current<?php endif; ?>">
			<a data-toggle="collapse" href="#sub-item-1">
				<em class="fa fa-navicon">&nbsp;</em> View Tests Created<span data-toggle="collapse" href="#sub-item-1" class="icon pull-right"><em class="fa fa-plus"></em></span>
			</a>
			<ul class="children collapse" id="sub-item-1">
				<li <?php if($filename == 'tests.php'): ?>class="current"<?php endif; ?> >
					<a href="tests.php">
						<span class="fa fa-arrow-right">&nbsp;</span> Manage Tests
					</a>
				</li>
				<li <?php if($filename == 'add_test.php'): ?>class="current"<?php endif; ?> >
					<a href="add_test.php">
						<span class="fa fa-arrow-right">&nbsp;</span> Add Test
					</a>
				</li>
			</ul>
		<li class="parent <?php if(in_array($filename,$user_menu)): ?>current<?php endif; ?>">
			<a data-toggle="collapse" href="#sub-item-2">
				<em class="fa fa-users">&nbsp;</em> Users<span data-toggle="collapse" href="#sub-item-1" class="icon pull-right"><em class="fa fa-plus"></em></span>
			</a>
			<ul class="children collapse" id="sub-item-2">
				<li <?php if($filename == 'users.php'): ?>class="current"<?php endif; ?> >
					<a href="users.php">
						<span class="fa fa-arrow-right">&nbsp;</span> Show Users
					</a>
				</li>
			</ul>
		</li>		</li>

		<li><a href="logout.php"><em class="fa fa-power-off">&nbsp;</em> Logout</a></li>
	</ul>
</div><!--/.sidebar-->