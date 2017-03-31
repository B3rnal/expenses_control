
$(document).ready(function(){
    $(document).foundation();
    loadUserTable();	    
});
var currentUserTable;

function message(string){
    console.log(string);
}

// Users.php
// load users Table
function loadUserTable(){
    message("dentro de load User");
    initUserTable();
}

function initUserTable(){
    if(currentUserTable){
        $('#usersTableContainer').jtable('destroy');
    }
    currentUserTable=$('#usersTableContainer').jtable({
            title: 'Users',
            paging: true, //Enable paging
            pageSize: 20, //Set page size (default: 10)
            sorting: true, //Enable sorting
            defaultSorting: 'Name ASC', //Set default sorting
            actions: {
                listAction: '/tables/listUsers.php',
                deleteAction: '/tables/deleteUsers.php',
                updateAction: '/tables/updateUsers.php',
                createAction: '/tables/createUsers.php'
            },
            fields: {
                userId: {
                    key: true,
                    create: false,
                    edit: false,
                    list: false

                },

                name: {
                    title: 'Name',
                    type: 'textarea',
                    list: true,
                    width: '20%',
                },

                department: {
                    title: 'Department',
                    type: 'textarea',
                    list: true,
                    width: '20%',
                },

                type: {
                    title: 'User Type',
                    options: { '1': 'Admin', '2': 'Basic'},
                    width: '20%',
                },

                email: {
                    title: 'Email',
                    type: 'textarea',
                    list: true,
                    width: '20%',
                },

                phone: {
                    title: 'Phone',
                    type: 'textarea',
                    list: true,
                    width: '20%',
                }
            }
        });
    $('#usersTableContainer').jtable('load');
}