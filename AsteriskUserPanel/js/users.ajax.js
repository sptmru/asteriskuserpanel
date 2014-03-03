$(document).ready(allUsers());

function allUsers() {
    $(".alert").alert('saved');
    $.ajax({
        url: 'include/users.php?action=showUsers',
        success: function(data) {
            $('.allusers').show();
            $('.allusers').html(data);
        }
    });
}

function findUsers() {
    $.ajax({
        url: 'include/users.php?action=showUsers',
        data: ({number: $('.findusers').val()}),
        success: function(data) {
            $('.allusers').show();
            $('.allusers').html(data);
        }
    });
}

function showAddingForm() {
    $('.newuser').toggle();
    if ($('.newuser').is(":visible"))
        $('.addnewuser').html('Hide this form');
    else
        $('.addnewuser').html('Add New User');
}

function deleteSelectedUsers() {
    var users = '';
    var checkboxes = $('#usersTable input[type=checkbox]:checked');
    checkboxes.each(function() {
        users = users + ",'" + this.name + "'";
    });
    users = users.substr(1, users.length);

    $.ajax({
        url: 'include/users.php?action=deleteUsers',
        data: ({numbers: users}),
        success: function() {
            $.ajax({
                url: 'include/users.php?action=showUsers',
                success: function(data) {
                    $('.allusers').show();
                    $('.allusers').html(data);
                }
            });
        }
    });
}

function changeActiveness(id, value) {
    $.ajax({
        url: 'include/users.php?action=changeActiveness',
        data: ({id: id, value: value}),
        success: function() {
            
            $.ajax({
                url: 'include/users.php?action=editUser',
                data: ({id: id}),
                success: function(data) {
                    $('.edit').show();
                    $('.edit').html(data);
                }
            });

            $.ajax({
                url: 'include/users.php?action=showUsers',
                success: function(data) {
                    $('.allusers').show();
                    $('.allusers').html(data);
                }
            });
            
            $('.alerts').html("<center><h2>Saved successfully.</h2></center>");
            $('.alerts').slideUp(300).fadeIn(400);
            $('.alerts').delay(1000).fadeOut(400);
            
            
        }
    });
}

function editUser(id) {
    $.ajax({
        url: 'include/users.php?action=editUser',
        data: ({id: id}),
        success: function(data) {
            $('.edit').show();
            $('.edit').html(data);
        }
    });
}

function saveUser(id) {
    $.ajax({
        url: 'include/users.php?action=saveUser',
        data: ({id: id, number: $('.number').val(), name: $('.name').val(), password: $('.password').val(), prefix: $('.prefix').val() }),
        success: function() {
            $.ajax({
                url: 'include/users.php?action=editUser',
                data: ({id: id}),
                success: function(data) {
                    $('.edit').show();
                    $('.edit').html(data);
                }
            });

            $.ajax({
                url: 'include/users.php?action=showUsers',
                success: function(data) {
                    $('.allusers').show();
                    $('.allusers').html(data);
                }
            });
            
            $('.alerts').html("<center><h2>Saved successfully.</h2></center>");
            $('.alerts').slideUp(300).fadeIn(400);
            $('.alerts').delay(1000).fadeOut(400);
        }
    });
}

function applyChanges() {
    $.ajax({
        url: 'include/users.php?action=applyChanges',
        success: function(data) {
            $('.allusers').show();
            $('.allusers').html(data);
        }
    });
}