<?php
//Set Session here and all that
session_start();

if (!isset($_SESSION["isLogin"]) || $_SESSION["isLogin"] != 1) {
?>
<div class="row">
	<div class="col-sm-12">
		<h1 style="border-bottom: 2px solid #333; padding-bottom: 10px; margin-bottom: 20px;">
			<b>LOGIN</b>
		</h1>
	</div>
	<div class="col-md-12">
		<div class="card-body">
			<form>
				<div class="form-group mb-3">
					<label for="email">Email Address</label>
					<input type="email" class="form-control" id="email" placeholder="Enter email">
				</div>
				<div class="form-group mb-4">
					<label for="password">Password</label>
					<input type="password" class="form-control" id="password" placeholder="Password">
				</div>
				<button type="submit" class="btn btn-primary w-100">Sign In</button>
				<br/><br/>
				<p>For testing purposes, the e-mail is admin@gmail.com , and the password is admin</p>
			</form>
		</div>
	</div>
</div>
<?php 
}else{ ?>
<div class="row">
	<div class="col-sm-12">
		<h1 style="border-bottom: 2px solid #333; padding-bottom: 10px; margin-bottom: 20px;">
			<b>ADMIN PANEL</b>
		</h1>
	</div>
	<div class="col-md-12">
		<div class="card-body">
			<table class="table">
			  <thead>
				<tr>
				  <th scope="col">#</th>
				  <th scope="col">GUID</th>
				  <th scope="col">Consent Date</th>
				  <th scope="col">Version</th>
				  <th scope="col">Accepted</th>
				</tr>
			  </thead>
			  <tbody>
				<?php
				$sql = "SELECT * FROM authentication ORDER BY id DESC";
				$result = mysqli_query($connection, $sql);
				$counter = 1;
				while ($row = mysqli_fetch_assoc($result)) {
				?>
				<tr>
				  <th scope="row"><?php echo $counter; ?></th>
				  <td><?php echo $row['GUID']; ?></td>
				  <td><?php echo date("F j, Y, g:i a", strtotime($row['consent_date'])); ?></td>
				  <td><?php echo $row['version']; ?></td>
				  <td><?php echo $row['accepted']; ?></td>
				</tr>
				<?php 
				$counter++;
				} ?>
			  </tbody>
			</table>
		</div>
		<button onclick="signOut()" class="btn btn-secondary w-100">Sign Out</button>
	</div>
</div>
<?php } ?>


<script>
$('form').on('submit', function(e) {
    e.preventDefault(); //Prevents screen from refreshing
	
    const email = $('#email').val();
    const password = $('#password').val();

    $.ajax({
        url: 'phpLogic/login.php',
        method: 'POST',
		dataType: 'json',
        data: {
            email: email,
            password: password
        },
        success: function(response) {
			if (response.success) {
				location.reload();
			} else {
				alert(response.message); // Shows "Invalid email or password." from PHP
			}
		},
        error: function(http, status, error) {
            alert('Invalid email or password.');
        }
    });
});

function signOut() {
    $.ajax({
        url: 'phpLogic/logout.php',
        method: 'POST',
        success: function(response) {
            location.reload();
        }
    });
}
</script>