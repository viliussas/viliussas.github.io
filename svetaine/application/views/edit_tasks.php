<!DOCTYPE html PUBLIC>
<html>
<head>
    <meta charset='utf-8'/>
    <title>Edit Form</title>

    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/bootstrap.css"/>
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/style.css"/>
</head>
<body>
<div class="container">
		<form method="post" action="<?php echo base_url();?>Tasks/update">

        <?php extract($task); ?>

        <div class="col-sm-8 mx-auto">
            <h2 align="center" class="mb-3 mt-3 p-2 bg-warning text-dark">Edit the task</h2>
            <table class="table table-bordered table-dark table-striped">
                <tr>
                    <th>Enter the task's description</th>
                    <td><textarea class="form-control" rows="5" name="Task_description" required><?php echo $Task_description; ?></textarea></td>
                </tr>
            </table>
            <tr>
                <td>
                    <input type="hidden" name="id" value="<?php echo $Task_id; ?>" />
                    <input type="submit" class="btn-primary btn-lg" name="submit" value="Update" />
                </td>
                <th>&nbsp;</th>
                <a type="button" class="btn-secondary btn-lg" href="<?php echo base_url('Tasks');?>">Cancel</a>
            </tr>
        </div>

    </form>
</div>

</body>

</html>
