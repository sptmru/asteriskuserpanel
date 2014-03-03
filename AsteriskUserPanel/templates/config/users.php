<?php

//template config

$SCRIPTS = '<link href="css/bootstrap.min.css" rel="stylesheet">
            <link href="css/custom.css" rel="stylesheet">
            <link href="css/x-editable.css" rel="stylesheet">
            <script src="http://code.jquery.com/jquery-2.0.3.min.js"></script> 
            <script src="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script> 
            <script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
            <script src="js/bootstrap-alert.js"></script>
            <script src="js/users.ajax.js"></script>';
$MENU = '<li class="active"><a href="/">Users</a></li>';
$INPUT_FIELD = 'Find Users By Number:';
$INPUT_CLASS = 'findusers';
$INPUT_ACTION = 'Go';
$INPUT_FUNCTION = 'findUsers()';
$BUTTONS = '<button type="button" class="buttons btn btn-primary addnewuser" onclick="showAddingForm()">Add New User</button>
            <button type="button" class="buttons btn btn-danger" onclick="deleteSelectedUsers()">Delete Selected Users</button>
            <a href="include/users.php?action=applyChanges"><button type="button" class="buttons btn btn-success">Apply Changes</button></a>';
$FIRST_CONTAINER = 'newuser';
$SECOND_CONTAINER = 'allusers';
$FIRST_CONTAINER_CONTENT = '<form class="form-inline" role="form" action="include/users.php">
                            <input type="hidden" name="action" value="addUser">
                            <div class="form-group">
                            <input type="text" class="form-control" id="number" name="number" placeholder="Number">
                            </div>
                            <div class="form-group">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Name">
                            </div>
                            <div class="form-group">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                            </div>
                            <div class="form-group">
                            <input type="text" class="form-control" id="prefix" name="prefix" placeholder="Prefix">
                            </div>
                            <button type="submit" class="btn btn-primary">Add an User</button>
                            </form>';
$SECOND_CONTAINER_CONTENT = '';
$THIRD_CONTAINER = 'edit';
$THIRD_CONTAINER_CONTENT = '';
$FOURTH_CONTAINER = 'csv';
$FOURTH_CONTAINER_CONTENT = '<p>CSV Import</p>'
                            . '<form action="include/users.php" enctype="multipart/form-data" method="POST">'
                            . '<span class="btn btn-file"><input type="file" name="filename"></span>'
                            . '<input type="hidden" name="action" value="CSVImport">'
                            . '<input type="submit" name="submit_upload" value="Import">'
                            . '</form>';