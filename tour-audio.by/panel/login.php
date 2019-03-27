<div class="container">
	<div class="row">
		<div class="col-md-3"></div>
		<div class="col-md-6">
			<form method="post" class="bg-light text-primary login-form" action="includes/user.php?action=login">
				<div class="form-group">
					<label for="username">User name:</label>
					<input type="text" class="form-control" id="username" name="username" required>
				</div>
				<div class="form-group">
					<label for="password">Password:</label>
					<input type="password" class="form-control" id="password" name="password" required>
				</div>
				<?php
				if(isset($_GET['login']) && $_GET['login'] == 'error'){
					?>
					<div class="alert alert-danger" role="alert">
						<strong>Error!</strong> Check your username or password and retry!
					</div>
				<?php } ?>
				<div class="form-group text-right">
					<button type="submit" class="btn btn-primary">Login</button>
				</div>
			</form>
		</div>
		<div class="col-md-3"></div>
	</div>
</div>
