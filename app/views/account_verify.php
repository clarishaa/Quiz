<!DOCTYPE html>
<html>
<head>
	<title>Gmail Account Verification</title>
	<!-- Include Bootstrap CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<!-- Include Bootstrap JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<style>
		.container {
			margin-top: 50px;
		}
		.box {
			background-color: #f2f2f2;
			border-radius: 5px;
			padding: 20px;
			box-shadow: 0px 0px 10px #888888;
		}
        .submit{
            display:flex;
            justify-content:center;
            align-items:center;
        }
	</style>
	<link rel="shortcut icon" href="../public/images/formlogo.png" />
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<div class="box" style="background-color: #0D6EFD;">>
					<h2 class="mb-4 text-center" style="color: white;">Email Verification</h2>
					<?php $LAVA =& lava_instance(); ?>
					<?php echo $LAVA->form_validation->errors(); ?>    
					<?php if (isset($success_message)) { ?>
						<div class="alert alert-success"><?php echo $success_message; ?></div>
					<?php } ?>
					<?php if (isset($error_message)) { ?>
						<div class="alert alert-danger"><?php echo $error_message; ?></div>
					<?php } ?>
					<form action="<?= site_url('check'); ?>" method="post" >
						<div class="form-group">
							<label for="to" style="color: white;">Verification code</label>
							<input type="text" class="form-control" id="to" name="verify" placeholder="Enter verification code" required>
							<input type="hidden" name="email" value="<?= $email ?>">
						</div>
                        <div class="mt-3 d-flex justify-content-center submit">
                        <div><input type="submit" value="Submit" class="btn btn-secondary " /></div>
                        </div>
					</form>
				</div>
			</div>
		</div>
	</div>
</body>
</html>