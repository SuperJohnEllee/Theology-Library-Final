<?php
	session_start();
	session_set_cookie_params(432000);
	$session_user = htmlspecialchars($_SESSION['admin_user']);

	if (!$session_user) {
		header("location: index.php");
	}

	include ('../connection.php');
	include('../function/function.php');

	$admin_sql = "SELECT AdminID FROM admin";
	$admin_res = mysqli_query($conn, $admin_sql);
	$admin_count = mysqli_num_rows($admin_res);

    $active_admin_sql = mysqli_query($conn, "SELECT AdminID FROM admin WHERE AdminStatus = 'Active'");
    $active_admin_count = mysqli_num_rows($active_admin_sql);

    $inactive_admin_sql = mysqli_query($conn, "SELECT AdminID FROM admin WHERE AdminStatus = 'Inactive'");
    $inactive_admin_count = mysqli_num_rows($inactive_admin_sql);

	createAdmins();
    
?>
<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" charset="utf-8">
	<meta name="description" content="College of Theology Library">
	<meta name="author" content="John Ellee Robado">
	<meta http-equiv="Content-Type" content="width=device-width, initial-scale=1.0">
	<title>College of Theology Library</title>
	<link rel="icon" href="../img/logo/COT Logo.jpg">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/mdb.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body class="cyan lighten-5">
	<nav class="navbar navbar-expand-lg navbar-light bg-dark fixed-top">
        <a class="navbar-brand" href="#"><img src="../img/logo/COT Logo.jpg" alt="Logo" height="30" width="30"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbar">
          <ul class="navbar-nav mr-auto">
             <li class="nav-item">
                <a class="nav-link active text-white" href="adminHome.php"><span class="fa fa-home"></span> Home <span class="sr-only">(current)</span></a></li>
            </ul>
        </div>
    </nav><br><br><br>
    <div class="container">
        <div class="page-header">
            <h1 class="text-center"><span class="fa fa-user"></span> Administrator Information(<?php echo htmlspecialchars($admin_count); ?>)</h1>
                <hr class="theo-footer-hr">
                <!--<a class="btn btn-primary" href="admin-add-account.php"><i class="fa fa-plus"></i>&nbsp;Add New Admin</a>-->
            </h3>       
        </div>
        <ul class="nav nav-tabs md-tabs nav-justified">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#create_admin" role="tab"><span class="fa fa-pencil"></span> Create Admin</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#viewActiveAdmin" role="tab"><span class="fa fa-eye"></span> View Active Admins</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#viewInactiveAdmin" role="tab"><span class="fa fa-eye-slash"></span> View Inactive Admins</a>
            </li>
        </ul>
        <div class="tab-content card">
            <div class="tab-pane fade in show active" id="create_admin" role="tabpanel">
                <br>
        <div class="row main">
            <div class="text-dark ml-5">
                <h1 class="text-center">Create Administrator</h1>
                <br>
                <p>You can only create another Admin, Work Student, Staff, Instructor or Secretary</p>
                    <form class="form-horizontal" method="post" enctype="multipart/form-data">
                    <div class="row">   
                        <div class="md-form col-md-6">
                            <i class="fa fa-user prefix"></i>
                            <input class="form-control" type="text" name="lastname">
                            <label>Last Name</label>
                        </div>
                        <div class="md-form col-md-6">
                           <i class="fa fa-user prefix"></i>
                           <input class="form-control" type="text" name="firstname">
                           <label>First Name</label>
                        </div>
                        <div class="md-form col-md-6">
                           <i class="fa fa-user prefix"></i>
                           <input class="form-control" type="text" name="midname">
                           <label>Middle Name</label>
                        </div>
                        <div class="md-form col-md-6">
                           <i class="fa fa-user prefix"></i>
                           <input class="form-control" type="text" name="gender">
                           <label>Gender - Male or Female</label>
                        </div>
                        <div class="md-form col-md-6">
                           <i class="fa fa-user prefix"></i>
                           <input class="form-control" type="text" name="type">
                           <label>Type - Admin,Staff,Secretary, etc.</label>
                        </div>
                        <div class="md-form col-md-6">
                            <i class="fa fa-user prefix"></i>
                            <input class="form-control" type="text" name="username">
                            <label>Username</label>
                        </div>
                        <div class="md-form col-md-6">
                           <i class="fa fa-lock prefix"></i>
                           <input class="form-control" type="password" name="password">
                           <label>Password</label>
                        </div>
                        <div class="md-form col-md-6">
                            <i class="fa fa-lock prefix"></i>
                            <input class="form-control" type="password" name="confirm_password">
                            <label>Confirm Password</label>
                        </div>
                        <div class="form-group mx-auto col-md-6">
                            <button class="btn btn-success btn-lg col-md-10"  name="add_admin" id="register">Create Account</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
            </div>
        <div class="tab-pane fade" id="viewActiveAdmin" role="tabpanel">
            <h3 class="text-center">Active Administrator(<?php echo $active_admin_count; ?>)</h3>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th>Admin ID</th>
                            <th>Name</th>
                            <th>Type</th>
                            <th>Status</th>
                            <th>Username</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $view_admin = "SELECT * FROM admin WHERE AdminStatus = 'Active' ORDER BY AdminID DESC";
                        $result = mysqli_query($conn, $view_admin);
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                $fullname = htmlspecialchars($row['AdminLName']) . ", " . htmlspecialchars($row['AdminFName']) . " " . htmlspecialchars($row['AdminMName']);
                                ?>
                                <tr>
                                    <td><?php echo $row['AdminID']; ?></td>
                                    <td><?php echo $fullname; ?></td>
                                    <td><?php echo $row['AdminType']; ?></td>
                                    <td class="font-weight-bold text-warning"><?php echo $row['AdminStatus']; ?></td>
                                    <td><?php echo $row['AdminUser']; ?></td>
                                    <td><a class="btn btn-warning"  onclick="return confirm('Disabled this admin?');" href="crud_action.php?admin_deact=<?php echo $row['AdminID'] ?>"><span class="fa fa-close"></span> Disabled</a></td>
                                </tr>

                    <?php } ?>
               <?php } else {

                    echo "<tr><td colspan='11'><h3 class='alert alert-warning text-center'>
                        <span class='fa fa-warning'></span> No Admins Found</h3></td></tr>";
                }
                    ?>
                    </tbody>    
            </table>
        </div>
    </div>
    <div class="tab-pane fade" id="viewInactiveAdmin" role="tabpanel">
        <h3 class="text-center"> Inactive Administrator(<?php echo $inactive_admin_count; ?>)</h3>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th>Admin ID</th>
                            <th>Name</th>
                            <th>Type</th>
                            <th>Status</th>
                            <th>Username</th>
                        <th class="text-center" colspan="3">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $view_admin = "SELECT * FROM admin WHERE AdminStatus = 'Inactive' ORDER BY AdminID DESC";
                        $result = mysqli_query($conn, $view_admin);
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                $fullname = htmlspecialchars($row['AdminLName']) . ", " . htmlspecialchars($row['AdminFName']) . " " . htmlspecialchars($row['AdminMName']);
                                ?>
                                <tr>
                                    <td><?php echo $row['AdminID']; ?></td>
                                    <td><?php echo $fullname; ?></td>
                                    <td><?php echo $row['AdminType']; ?></td>
                                    <td class="font-weight-bold text-danger"><?php echo $row['AdminStatus']; ?></td>
                                    <td><?php echo $row['AdminUser']; ?></td>
                                    <td><a class="btn btn-info" onclick="return confirm('Enabled this admin?');" href="crud_action.php?admin_act=<?php echo $row['AdminID'] ?>"><span class="fa fa-check"></span> Enabled</a></td>
                                    <td><a class="btn btn-danger" onclick="return confirm('Delete this admin?');" href="crud_action.php?admin_del=<?php echo $row['AdminID']; ?>"><span class="fa fa-trash"></span> Delete</a></td>
                                </tr>

                    <?php } ?>
               <?php } else {

                    echo "<tr><td colspan='11'><h3 class='alert alert-warning text-center'>
                        <span class='fa fa-warning'></span> No Admins Found</h3></td></tr>";
                }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
<!-- JavaScript Libraries -->
<script src="../js/bootstrap.js"></script>
<script src="../js/jquery.js"></script>
<script src="../js/mdb.min.js"></script>
<script src="../js/jquery.min.js"></script>
<script src="../js/popper.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
</body>
</html>