<?php
function my_acf_admin_head(){
?>
    <style type="text/css">
        .postbox.acf-postbox {
            border: 3px solid #c5c5c5;
            margin: 30px;
        }

        .postbox-header {
            background-color: #c5c5c5;
            color: white;
        }

        .postbox-header:hover {
            background-color: #c5c5c5 !important;
            color: white !important;
        }
    </style>
<?php
}
add_action('acf/input/admin_head', 'my_acf_admin_head');


function my_admin_head(){
?>
    <style type="text/css">
        .user-description-wrap,
        .user-profile-picture{
            display: none;
        }
    </style>
<?php
}
add_action('admin_head', 'my_admin_head');
?>