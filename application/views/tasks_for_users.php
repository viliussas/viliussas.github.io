<!DOCTYPE html PUBLIC>
<html>
<head>

    <meta charset='utf-8'/>
    <title>Tasks for users</title>

    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/bootstrap.css"/>
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/style.css"/>

    <script type="text/javascript">
        function show_confirm(act, gotoid1, gotoid2) {
            var r = confirm("Do you really want to delete the task assigned to the user?");
            if(r === true) {
                window.location = "<?php echo base_url();?>Tasks/" + act + "/" + gotoid1 + "/" + gotoid2;
            }
        }
    </script>

</head>

<body>

<nav class="navbar navbar-expand-lg bg-dark">
    <a class="navbar-brand" href="<?php echo base_url('Tasks');?>">Tasks list</a>
    <a class="navbar-brand" href="<?php echo base_url('Login/user_logout');?>">Logout</a>
</nav>

<div class="col-sm-12">
    <?php
    $success_msg= $this->session->flashdata('success_msg1');
    if($success_msg) {
        ?>
        <div class="alert alert-success" align="center">
            <?php echo $success_msg; ?>
        </div>
        <?php
    }
    ?>
</div>

<div class="col-sm-4 offset-sm-4">
    <h2 align="center" class="mb-3 mt-3 p-2 bg-warning text-dark">Tasks for users</h2>
</div>

<div class="col-sm-7 mx-auto">
    <table class="table table-bordered table-dark table-striped">
        <tr>
            <th>Task id</th>
            <th>User id</th>
            <th>State</th>
            <th>Action</th>
        </tr>
        <?php
        if($tasks_for_users_list) {
            foreach ($tasks_for_users_list as $u_key) { ?>
                <tr>
                    <td><?php echo $u_key->Task_id; ?></td>
                    <td><?php echo $u_key->User_id; ?></td>
                    <td><?php echo $u_key->State; ?></td>
                    <td align="center"><a href="#" onClick="show_confirm('delete_task_for_user', <?php echo $u_key->Task_id;?>, <?php echo $u_key->User_id;?>)">Delete</a></td>
                </tr>
            <?php }
        }?>
    </table>
</div>
<div class="col-sm-2 offset-sm-5">
    <?php
    if($links) {
        ?>
        <h3 align="center" class="p-1 bg-dark text-white"><?php echo $links; ?></h3>
        <?php
    }
    ?>
</div>

</body>

</html>
