<!DOCTYPE html>
<?php
    session_start();
    $session_user = $_SESSION['admin_user'];
    if (!$session_user) {
        header("location: index.php");
    }
	include ('../connection.php');
    include('../function/function.php');
    createAdmins();
?>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="College of Theology Library">
    <meta http-equiv="Content-Type" content="IE=edge">
    <title>College of Theology Library</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/mdb.min.css">
    <link rel="icon" href="../img/logo/cot2.jpg">
</head>
<body class="cyan lighten-4">
	   <nav class="navbar navbar-expand-lg navbar-light bg-dark fixed-top">
        <a class="navbar-brand" href="#"><img src="../img/logo/cot2.jpg" align="logo" height="30" width="30">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
     </button>
     <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link text-white" href="adminHome.php"><i class="fa fa-home"></i>&nbsp;Home<span class="sr-only">(current)</span></a>
            </li>
        </ul>
     </div>
    </nav><br><br><br>
	<div class="container">
        <div class="row main">
            <div class="text-dark ml-5">
                <h1 class="text-center">Create Administrator</h1>
                <br>
                <p>You can only create another Admin, Work Student, Staff, Instructor or Secretary</p>
                    <form class="form-horizontal" method="post" enctype="multipart/form-data">
                    <div class="row">   
                        <div class="form-group col-md-6">
                            <label for="lastname" class="cols-sm-2 control-label">Last Name</label>
                            <div class="cols-sm-10">
                                    <input type="text" class="form-control" name="lastname" id="lastname" placeholder="Last Name" required>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="firstname" class="cols-sm-2 control-label">First Name</label>
                            <div class="cols-sm-10">
                                    <input type="text" class="form-control" name="firstname" id="firstname"  placeholder="First Name" required />
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="midname" class="cols-sm-2 control-label">Middle Name</label>
                            <div class="cols-sm-10">
                                    <input type="text" class="form-control" name="midname" id="midname"  placeholder="Middle Name" required />
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                           <label for="type" class="cols-sm-2 control-label">Gender</label>
                            <div class="cols-sm-10">
                                    <input type="text" class="form-control" name="gender" id="type" placeholder="Male or Female" required />
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="type" class="cols-sm-2 control-label">Type</label>
                            <div class="cols-sm-10">
                                    <input type="text" class="form-control" name="type" id="type" placeholder="Admin, Staff, Secretary, etc." required />
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="username" class="cols-sm-2 control-label">Username</label>
                            <div class="cols-sm-10">
                                    <input class="form-control" type="text" name="username" id="username" placeholder="Username" required>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="password" class="cols-sm-2 control-label">Password</label>
                            <div class="cols-sm-10">
                                    <input class="form-control" type="password" name="password" id="password" placeholder="Password" required>
                            </div>
                        </div>
                            <div class="form-group col-md-6">
                                <label for="confirm_password" class="cols-sm-2 control-label">Confirm Password</label>
                                <div class="cols-sm-10">
                                        <input class="form-control" type="password" name="confirm_password" id="confirm_password" placeholder="Confirm Password" required>
                                </div>
                            </div>
                        <div class="form-group mx-auto col-md-6">
                            <button class="btn btn-success btn-lg col-md-10"  name="add_admin" id="register">Create Account</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    <!--JavaScript Libraries -->
    <script src="../js/bootstrap.js"></script>
    <script src="../js/jquery.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/jquery.min.js"></script>
    <script src="../js/mdb.min.js"></script>
</body>
</html>