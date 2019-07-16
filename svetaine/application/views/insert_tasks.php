<!DOCTYPE html PUBLIC>
<html>
<head>
    <meta charset='utf-8'/>
    <title>Insert Form</title>

    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/bootstrap.css"/>
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/style.css"/>
</head>
<body>
	<div class="container">

			<form method="post" action="<?php echo base_url();?>Tasks/insert_task_db">

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

				<h2 align="center" class="mb-3 mt-3 p-2 bg-warning text-dark">Insert a task</h2>
				<table class="table table-bordered table-dark table-striped">
					<tr>
						<th>Enter the task's description</th>
						<td><textarea class="form-control" rows="5" name="Task_description" required></textarea></td>
					</tr>
				</table>
				<tr>
					<td>
						<input type="submit" class="btn-primary btn-lg" name="submit" value="Create" />
					</td>
					<th>&nbsp;</th>
					<a type="button" class="btn-secondary btn-lg" href="<?php echo base_url('Tasks');?>">Cancel</a>
				</tr>

			</div>
		</form>
	</div>
</body>

</html>
