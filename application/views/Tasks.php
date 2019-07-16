<!DOCTYPE html PUBLIC>
<html>
<head>

    <meta charset='utf-8'/>
    <title>Tasks</title>

    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/bootstrap.css"/>
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/style.css"/>

    <script type="text/javascript">
        function show_confirm(act, gotoid) {
            if(act==="edit")
                var r=confirm("Do you really want to edit?");
            else
                var r=confirm("Do you really want to delete?");
            if(r===true) {
                window.location="<?php echo base_url();?>Tasks/"+act+"/"+gotoid;
            }
        }
    </script>

</head>
<body>


<nav class="navbar navbar-expand-lg bg-dark">
    <a class="navbar-brand" href="<?php echo base_url('Tasks/show_assigned_tasks');?>">Assigned tasks</a>
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
    <h2 align="center" class="mb-3 mt-3 p-2 bg-warning text-dark">Tasks management</h2>
</div>

<div class="col-sm-11 mx-auto">
    <table class="table table-bordered table-dark table-striped">
        <tr>
            <th>Task id</th>
            <th class="w-50">Task description</th>
            <th colspan="2">Action</th>
        </tr>
        <?php
        if($tasks_list) {
            foreach ($tasks_list as $u_key) { ?>
                <tr>
                    <td><?php echo $u_key->Task_id; ?></td>
                    <td><?php echo $u_key->Task_description; ?></td>
                    <td align="center"><a href="#" onClick="show_confirm('edit', <?php echo $u_key->Task_id;?>)">Edit</a></td>
                    <td align="center"><a href="#" onClick="show_confirm('delete', <?php echo $u_key->Task_id;?>)">Delete</a></td>
                </tr>
            <?php }
        }?>
        <tr>
            <td colspan="6" align="right"><a href="<?php echo base_url();?>Tasks/add_form">Insert New Task</a></td>
        </tr>
        <tr>
            <td colspan="6" align="right"><a href="<?php echo base_url();?>Tasks/assign_task">Assign a Task</a></td>
        </tr>
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
