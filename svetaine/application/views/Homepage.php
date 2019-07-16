<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <title>Homepage articles</title>

    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/style.css"/>
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/bootstrap.css"/>

    <script type="text/javascript">
        function show_confirm(act, gotoid1, gotoid2) {
            var r = confirm("Do you really want to check this task as done?");
            if(r === true) {
                window.location = "<?php echo base_url();?>Tasks/" + act + "/" + gotoid1 + "/" + gotoid2;
            }
        }
    </script>

</head>

<body>

<nav class="navbar navbar-expand-lg bg-dark">
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

<div class="container">
    <div class="row">
        <div class="col-sm-8">
            <h2 align="center" class="mb-5 mt-5 p-2 bg-danger text-white">Assigned tasks</h2>
            <div class="row">
					<?php
                    if($tasks) {
                        foreach ($tasks as $u_key) { ?>
                            <div class="col-md-6 mb-5">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <h6>Description : <br><b> <?php echo $u_key->Task_description ?> </b></h6>
                                        <p>Status : <b> <?php echo $u_key->State ?> </b></p>
                                        <a href="#" onClick="show_confirm('change_status', <?php echo $u_key->Task_id;?>, <?php echo $this->session->userdata('User_id'); ?>)">Done</a>
                                    </div>
                                </div>
                            </div>
                        <?php }?>
                    <?php }?>
            </div>
        </div>

		<div class="col-sm-4 offset-md-0">
            <?php
            if($this->session->userdata('User_name')) { ?>

                <div class="offset-md-0 py-5">
                    <div class="card bg-success">
                        <div class="card-header text-white" align="center">
                            <h3>User information</h3>
                        </div>
                        <div class="card-body text-white">
                            <h6>Full name - <b><?php echo $this->session->userdata('Firstname_lastname'); ?></b></h6>
                            <h6>User name - <b><?php echo $this->session->userdata('User_name'); ?></b></h6>
                            <h6>User id - <b><?php echo $this->session->userdata('User_id'); ?></b></h6>
                        </div>
                    </div>
                </div>

            <?php } ?>
		</div>

    </div>
</div>

</body>

</html>
