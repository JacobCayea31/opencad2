<?php

/**

Open source CAD system for RolePlaying Communities.
Copyright (C) 2017 Shane Gill

This program is free software: you can redistribute it and/or modify
 it under the terms of the GNU General Public License as published by
 the Free Software Foundation, either version 3 of the License, or
 (at your option) any later version.

This program comes with ABSOLUTELY NO WARRANTY; Use at your own risk.
**/

    if(session_id() == '' || !isset($_SESSION)) {
      session_start();
    }
    require_once('../oc-config.php');
    require_once( ABSPATH . '/oc-functions.php');
    require_once( ABSPATH . "/oc-includes/adminActions.php");
    require_once( ABSPATH . "/oc-includes/publicFunctions.php");
    if (empty($_SESSION['logged_in']))
    {
        header('Location: ../index.php');
        die("Not logged in");
    }
    else
    {
      $name = $_SESSION['name'];
    }


    if ( $_SESSION['admin_privilege'] == 3)
    {
      if ($_SESSION['admin_privilege'] == 'Administrator')
      {}
    }
    else if ($_SESSION['admin_privilege'] == 2)
    {
      if ($_SESSION['admin_privilege'] == 'Moderator')
      {}
    }
    else
    {
        permissionDenied();
    }

    $accessMessage = "";
    if(isset($_SESSION['accessMessage']))
    {
        $accessMessage = $_SESSION['accessMessage'];
        unset($_SESSION['accessMessage']);
    }
    $adminMessage = "";
    if(isset($_SESSION['adminMessage']))
    {
        $adminMessage = $_SESSION['adminMessage'];
        unset($_SESSION['adminMessage']);
    }

    $successMessage = "";
    if(isset($_SESSION['successMessage']))
    {
        $successMessage = $_SESSION['successMessage'];
        unset($_SESSION['successMessage']);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
<?php include(ABSPATH . "/oc-includes/header.inc.php"); ?>

<body class="app header-fixed">

    <header class="app-header navbar">
      <a class="navbar-brand" href="#">
        <img class="navbar-brand-full" src="<?php echo BASE_URL; ?>/oc-content/themes/<?php echo THEME; ?>/images/tail.png" width="30" height="25" alt="OpenCAD Logo">
      </a>
      <?php include( ABSPATH . "oc-admin/oc-admin-includes/topbarNav.inc.php"); ?>
      <?php include( ABSPATH . "oc-includes/topProfile.inc.php"); ?>

    </header>

      <div class="app-body">
        <main class="main">
        <div class="breadcrumb" />
        <div class="container-fluid">
          <div class="animated fadeIn">
            <div class="row">
              <div class="col-sm-2 col-sm-2">
                <div class="card text-white bg-primary">
                  <div class="card-body pb-0">
                    <div class="text-value"><?php echo getGroupCount("1");?></div>
                    <div><?php echo getGroupName("1");?></div>
                    <br />
                  </div>
                </div>
              </div>
              <!-- /.col-->
              <div class="col-sm-2 col-sm-2">
                <div class="card text-white bg-primary">
                  <div class="card-body pb-0">
                    <button class="btn btn-transparent p-0 float-right" type="button">
                      <i class="icon-location-pin"></i>
                    </button>
                    <div class="text-value"><?php echo getGroupCount("2");?></div>
                    <div><?php echo getGroupName("2");?></div>
                    <br />
                  </div>
                </div>
                <br />
              </div>
              <!-- /.col-->
              <div class="col-sm-2 col-sm-2">
                <div class="card text-white bg-primary">
                  <div class="card-body pb-0">
                    <div class="text-value"><?php echo getGroupCount("3");?></div>
                    <div><?php echo getGroupName("3");?></div>
                  </div>
                  <br />
                </div>
              </div>
              <!-- /.col-->
              <div class="col-sm-2 col-sm-2">
                <div class="card text-white bg-primary">
                  <div class="card-body pb-0">
                    <div class="text-value"><?php echo getGroupCount("4");?></div>
                    <div><?php echo getGroupName("4");?></div>
                    <br />
                  </div>
                </div>
              </div>
              <!-- /.col-->
            <div class="col-sm-2 col-sm-2">
                <div class="card text-white bg-primary">
                  <div class="card-body pb-0">
                    <div class="text-value"><?php echo getGroupCount("5");?></div>
                    <div><?php echo getGroupName("5");?></div>
                    <br />
                  </div>
                </div>
              </div>
              <!-- /.col-->
            </div>
            <!-- /.row-->
            <div class="row align-self-center">
            <div class="col-sm-2 col-sm-2">
                <div class="card text-white bg-primary">
                  <div class="card-body pb-0">
                    <div class="text-value"><?php echo getGroupCount("5");?></div>
                    <div><?php echo getGroupName("5");?></div>
                    <br />
                  </div>
                </div>
              </div>
              <!-- /.col-->
              <div class="col-sm-2 col-sm-2">
                <div class="card text-white bg-primary">
                  <div class="card-body pb-0">
                    <div class="text-value"><?php echo getGroupCount("6");?></div>
                    <div><?php echo getGroupName("6");?></div>
                    <br />
                  </div>
                </div>
              </div>
              <!-- /.col-->
              <div class="col-sm-2 col-sm-2">
                <div class="card text-white bg-primary">
                  <div class="card-body pb-0">
                    <div class="text-value"><?php echo getGroupCount("7");?></div>
                    <div><?php echo getGroupName("7");?></div>
                    <br />
                  </div>
                </div>
              </div>
              <!-- /.col-->
            </div>
            <!-- /.row-->
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-align-justify"></i> <<?php echo lang_key("USER_MANAGER"); ?>
                </div>
                <div class="card-body">
                    <?php echo $accessMessage;?>
                    <?php getUsers();?>
                </div>
                <!-- /.row-->

              </div>

            </div>
            <!-- /.card-->

        </main>

        </div>

        <footer class="app-footer">
        <div>
            <a href="<?php echo BASE_URL; ?>/oc-content/themes/<?php echo THEME; ?>/images/tail.png">CoreUI Pro</a>
            <span>&copy; 2018 creativeLabs.</span>
        </div>
        <div class="ml-auto">

        </div>
        </footer>

            <?php
    include ( ABSPATH . "/oc-admin/oc-admin-includes/globalModals.inc.php");
    include ( ABSPATH . "/oc-includes/jquery-colsolidated.inc.php"); ?>


   <!-- Edit User Modal -->
    <div class="modal" id="editUserModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                    <!-- ./ modal-header -->
                    <div class="modal-body">
                        <form role="form" method="post" action="<?php echo BASE_URL; ?>/oc-includes/adminActions.php" class="form-horizontal">
                            <div class="form-group row">
                                <label class="col-md-3 control-label">Name</label>
                                <div class="col-md-9">
                                    <input name="name" class="form-control" id="name" />
                                    <span class="fas fa-user form-control-feedback right" aria-hidden="true"></span>
                                </div>
                                <!-- ./ col-sm-9 -->
                            </div>
                            <!-- ./ form-group -->
                            <div class="form-group row">
                                <label class="col-md-3 control-label">Email</label>
                                <div class="col-md-9">
                                    <input type="email" name="email" class="form-control" id="Email" />
                                    <span class="fas fa-envelope form-control-feedback right" aria-hidden="true"></span>
                                </div>
                                <!-- ./ col-sm-9 -->
                            </div>
                            <!-- ./ form-group -->
                            <div class="form-group row">
                                <label class="col-md-3 control-label">Identifier</label>
                                <div class="col-md-9">
                                    <input type="text" name="identifier" class="form-control" id="identifier" />
                                    <span class="fas fa-user form-control-feedback right" aria-hidden="true"></span>
                                </div>
                                <!-- ./ col-sm-9 -->
                            </div>
                            <!-- ./ form-group -->
                            <div class="form-group row">
                                <label class="col-md-3 control-label">User Groups</label>
                                <div class="col-md-9">
                                    <select name="userGroups[]" class="selectpicker form-control" id="userGroups"
                                        multiple>
                                        <?php getAgencies();?>
                                    </select>
                                </div>
                                <!-- ./ col-sm-9 -->
                            </div>
                            <!-- ./ form-group -->                                               
                    </div>
                    <!-- ./ modal-body -->
                    <div class="modal-footer">
                      <input type="hidden" name="userID" id="userID">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      <input type="submit" name="editUserAccount" class="btn btn-primary" value="Update User" />
                    </div>
                    <!-- ./ modal-footer -->
                    </form>
                </div>
                <!-- ./ modal-content -->
            </div>
            <!-- ./ modal-dialog modal-lg -->
        </div>
        <!-- ./ modal fade bs-example-modal-lg -->

            <!-- Change User Role Modal -->
    <div class="modal" id="editUserRoleModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="editUserRoleModal">Change User Role</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                </div>
                    <!-- ./ modal-header -->
                    <div class="modal-body">
                        <form role="form" method="post" action="<?php echo BASE_URL; ?>/oc-includes/adminActions.php"
                            class="form-horizontal">
                            <!-- ./ form-group -->
                            <div class="form-group row">
                                <label class="col-md-3 control-label">User Role</label>
                                <div class="col-md-9">
                                    <select name="userRole" class="selectpicker form-control" id="userRole">
                                        <?php getRole();?>
                                    </select>
                                </div>
                                <!-- ./ col-sm-9 -->
                            </div>
                            <!-- ./ form-group -->                                               
                    </div>
                    <!-- ./ modal-body -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <input type="hidden" name="userID" id="userID">
                        <input type="submit" name="editUserAccountRole" class="btn btn-primary" value="Update Role" />
                    </div>
                    <!-- ./ modal-footer -->
                    </form>
                </div>
                <!-- ./ modal-content -->
            </div>
            <!-- ./ modal-dialog modal-lg -->
        </div>
        <!-- ./ modal fade bs-example-modal-lg -->
        </div>

        <!-- Change Password -->
    <div class="modal" id="changeUserPassword" tabindex="-1" role="dialog" aria-hidden="true">
       <div class="modal-dialog modal-lg">
          <div class="modal-content">
             <div class="modal-header">
                        <h4 class="modal-title" id="changeUserPasswordLabel">Change Password</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
              </div>
        <!-- ./ modal-header -->
        <div class="modal-body">
          <form role="form" action="<?php echo BASE_URL; ?>/oc-includes/adminActions.php" method="post">
            <div class="form-group row">
              <label class="col-lg-2 control-label">Password</label>
              <div class="col-lg-10">
                <input class="form-control" type="password" name="password" id="password" size="30" maxlength="255" placeholder="Enter your new password..." value="" required <?php if ( DEMO_MODE == true ) {?> readonly <?php } ?> />
              </div>
              <!-- ./ col-sm-9 -->
            </div>
            <div class="form-group row">
              <label class="col-lg-2 control-label">Confirm Password</label>
              <div class="col-lg-10">
                <input class="form-control" type="password" name="confirm_password" size="30" id="confirm_password" maxlength="255" placeholder="Retype your new password..." value="" required <?php if ( DEMO_MODE == true ) {?> readonly <?php } ?> />
              </div>
              <!-- ./ col-sm-9 -->
            </div>
        </div>
        <!-- ./ modal-body -->
        <div class="modal-footer">
            <input type="hidden" name="userID" id="userID">
            <input type="submit" name="changeUserPassword" id="changeUserPassword" class="btn btn-primary" value="Change Password" />
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </form>
        </div>
        <!-- ./ modal-footer -->
      </div>
      <!-- ./ modal-content -->
    </div>
    <!-- ./ modal-dialog modal-lg -->
  </div>
  <!-- ./ modal fade bs-example-modal-lg -->

            <script>
        $(document).ready(function() {

            $('#pendingUsers').DataTable({
                paging: true,
                searching: true
            });

        });
        </script>

        
        <script>
        $(document).ready(function() {
            $('#allUsers').DataTable;
        });

        $('#editUserModal').on('show.bs.modal', function(e) {
            var $modal = $(this),
                userId = e.relatedTarget.id;

            $.ajax({
                cache: false,
                type: 'POST',
                url: '<?php echo BASE_URL; ?>/oc-includes/adminActions.php',
                data: {
                    'getUserDetails': 'yes',
                    'userId': userId
                },                
                success: function(result) {
                    data = JSON.parse(result);
                    $('input[name="name"]').val(data['name']);
                    $('input[name="email"]').val(data['email']);
                    $('input[name="identifier"]').val(data['identifier']);
                    $('input[name="userId"]').val(data['userId']);

                    $("#userRole").selectpicker();
                    for (var i = 0; i < data['role'].length; i++) {
                        $('select[name="userRole"] option[value="' + data['role'][i] +
                            ' selected"]').val(1);
                    }
                    console.log("object: %O", result)
                    $('#userRole').selectpicker('refresh');
                },

                error: function(exception) {
                    alert('Exeption:' + exception);
                }
            });
        });

         $('#editUserRoleModal').on('show.bs.modal', function(e) {
            var $modal = $(this),
                userId = e.relatedTarget.id;

            $.ajax({
                cache: false,
                type: 'POST',
                url: '<?php echo BASE_URL; ?>/oc-includes/adminActions.php',
                data: {
                    'getUserID': 'yes',
                    'userId': userId
                },
                success: function(result) {
                    data = JSON.parse(result);
                    $('input[name="userID"]').val(data['userId']);

                },

                error: function(exception) {
                    alert('Exeption:' + exception);
                }
            });
        });



        $(".delete_group").click(function() {
            var dept_id = $(this).attr("data-dept-id");
            var user_id = $(this).attr("data-user-id");
            if (confirm("Are you sure to delete the selected Group?")) {
                $.ajax({
                    cache: false,
                    type: 'GET',
                    url: '<?php echo BASE_URL; ?>/oc-includes/adminActions.php',
                    data: 'dept_id=' + dept_id + '&user_id=' + user_id,
                    success: function(result) {
                        //obj = jQuery.parseJSON(result);

                        $("#show_group").html(result);
                        window.location.href =
                            '<?php echo BASE_URL; ?>/oc-admin/userManagement.php';

                    }

                });
            }
        });
        </script>

</body>

            <script type="text/javascript"
        src="https://jira.opencad.io/s/a0c4d8ca8eced10a4b49aaf45ec76490-T/-f9bgig/77001/9e193173deda371ba40b4eda00f7488e/2.0.24/_/download/batch/com.atlassian.jira.collector.plugin.jira-issue-collector-plugin:issuecollector/com.atlassian.jira.collector.plugin.jira-issue-collector-plugin:issuecollector.js?locale=en-US&collectorId=ede74ac1">
    </script>

</html>