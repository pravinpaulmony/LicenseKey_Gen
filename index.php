<!DOCTYPE html>
<html lang="en">
<head>
  <title>License Key Generator</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!--INCLUDED BOOTSTRAP -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<style>
	body {
		background-color: #d0dadf!important;
	}
</style>
<body class="text-dark">

<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
	<a class="navbar-brand font-weight-bold text-light" href="#">LICENSE-VALGEN</a>
</nav>

<!--INCLUDED MAIN.PHP FILE FOR FORM SUBMISSION VALIDATIONS-->
<?php include 'application/main.php'; ?>

<div class="container-fluid">
  <div class="row">
	  <div class="col-md-1"></div>
	  <div class="col-md-4 m-5">
		<div class="card text-dark">
		  <div class="card-header text-uppercase font-weight-bold text-center bg-dark text-light">
			<h6>Key Generator</h6>
		  </div>
		  
		  <!--KEY GENERATION FORM -->
		  <form name="generate_form" method="post" action="index.php" enctype="multipart/form-data">
			  <div class="card-body">
				<input type="hidden" class="form-control" name="type" value="generate">
				<div class="form-group">
				  <label class="font-weight-bold">Enter Your Email ID <span class="text-danger">*</span></label>
				  <label class="badge badge-danger"><?php echo $email_error; ?></label><!--EMAIL FORMAT VALIDATION ERROR NOTIFICATIONS -->
				  <input type="email" class="form-control" name="new_email" autocomplete="off" required value="<?php echo $email1; ?>">
				</div>
				<?php echo $expire_error; echo $exists_error; ?>
			  </div>
			  <div class="card-footer">
				<button type="submit" class="btn btn-success btn-block font-weight-bold">GENERATE KEY</button>
			  </div>
		  </form>

		
		<?php 
			 /* DISPLAY LICENSE KEY WHEN GENERATED  */
			$display = ($licenseKey!="" && strpos($licenseKey, 'expired') === false && strpos($licenseKey, 'exists') === false && $email_error=="") ? "input-group p-2 font-weight-bold" : "input-group p-2 font-weight-bold d-none"; 
		?>
			
		  <label class="<?php echo $display; ?>">YOUR LICENSE KEY</label>
		  <div class="<?php echo $display; ?>">
			<input type="text" class="form-control" id="new_license" autocomplete="off" value="<?php echo $licenseKey; ?>" readonly>
			<div class="input-group-append">
			  <button class="btn btn-xs btn-info" onclick="copycode()">copy</button>
			</div>
		  </div>
		  
		</div>
	  </div>
	  
	  <div class="col-md-4 m-5">
		<div class="card text-dark">
		  <div class="card-header text-uppercase font-weight-bold text-center bg-dark text-light">
			<h6>Key Validator</h6>
		  </div>
		  
		  <!--KEY VALIDATION FORM -->
		  <form name="validate_form" method="post" action="index.php" enctype="multipart/form-data">
			  <div class="card-body">
				<input type="hidden" class="form-control" name="type" value="validate">
				<div class="form-group">
				  <label class="font-weight-bold">Enter Your Email ID <span class="text-danger">*</span></label>
				  <label class="badge badge-danger"><?php echo $email_error1; ?></label> <!--EMAIL FORMAT VALIDATION ERROR NOTIFICATIONS -->
				  <input type="email" class="form-control" name="user_email" autocomplete="off" required value="<?php echo $email2; ?>">
				</div>
				<div class="form-group">
				  <label class="font-weight-bold">Enter Your License Key <span class="text-danger">*</span></label>
				  <label class="badge badge-danger"><?php echo $key_error; ?></label> <!--LICENSE FORMAT VALIDATION ERROR NOTIFICATIONS -->
				  <?php echo $license_valid; ?> <!-- LICENSE VALIDATION ERROR NOTIFICATIONS -->
				  <input type="text" class="form-control" name="user_license" autocomplete="off" required value="<?php echo $userkey; ?>">
				</div>
			  </div>
			  <div class="card-footer">
				<button type="submit" class="btn btn-primary btn-block font-weight-bold mt-3">VALIDATE KEY</button>
			  </div>
		  </form>
		  
		</div>
	  </div>
	</div>
</div>
</body>
</html>
<script>

/* AVOIDING FORM RESUBMISSION */
if ( window.history.replaceState ) {
	window.history.replaceState( null, null, window.location.href );
}

/* EXTRA FEATURE FOR USER TO COPY THE LICENSE KEY */
function copycode() {

  var copyText = document.getElementById("new_license");
  copyText.select();
  copyText.setSelectionRange(0, 99999);
  document.execCommand("copy");
  alert("Copied the License Key: " + copyText.value);
}
</script>