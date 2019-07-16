<!DOCTYPE html PUBLIC>
<html>
<head>
    <meta charset='utf-8'/>
    <title>Assign Form</title>

    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/bootstrap.css"/>
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/style.css"/>
</head>
<body>
<div class="container">

    <form method="post" action="<?php echo base_url();?>Tasks/assign_task_db">
        <div class="col-sm-8 mx-auto">

            <?php
            $error_msg= $this->session->flashdata('error_msg');
            if($error_msg) {
                ?>
                <div class="alert alert-danger" align="center">
                    <?php echo $error_msg; ?>
                </div>
                <?php
            }
            ?>

            <h2 align="center" class="mb-3 mt-3 p-2 bg-warning text-dark">Assign a task</h2>

            <table class="table table-bordered table-dark table-striped">
                <tr>
                    <th>Select a task</th>
                    <td>
                        <select name="Task_description" required>
                            <option value="">Choose a task...</option>
                            <?php foreach ($descriptions as $u_key) { ?>
                            <option> <?php echo $u_key->Task_description; ?> </option>
                            <?php } ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>Select a user</th>
                    <td>
                        <select name="Firstname_lastname" required>
                            <option value="">Choose a user...</option>
                            <?php foreach ($users as $u_key) { ?>
                                <option> <?php echo $u_key->Firstname_lastname; ?> </option>
                            <?php } ?>
                        </select>
                    </td>
                </tr>
            </table>
            <tr>
                <td>
                    <input type="submit" class="btn-primary btn-lg" name="submit" value="Assign" />
                </td>
                <th>&nbsp;</th>
                <a type="button" class="btn-secondary btn-lg" href="<?php echo base_url('Tasks');?>">Cancel</a>
            </tr>

        </div>
    </form>
</div>
</body>

</html>