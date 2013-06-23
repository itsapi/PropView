<?
	$msg = '';
	include 'include/config.php';
	if (isset($_COOKIE['user'])){
?>

<!DOCTYPE html>

<html>
	<head>
		<title>PropView</title>
		<? include 'include/head.html' ?>
		<script src="js/admin.js"></script>
		<link rel="stylesheet" href="css/admin.css">
	</head>
	<body>
		<div id="container">
			<? include 'include/header.html' ?>
			<section id="left">
				<figure>
					<a href="index.php"><img src="files/logo.png" id="logo" alt="PropView Logo"></a>
					<figcaption>Virtual Property Supervision</figcaption>
				</figure>
				<h4>My Account:</h4>
				<ul>
					<li><a href="#">Edit account</a></li>
					<li><a href="#">Add user</a></li>
					<li><a href="index.php?logout">Logout</a></li>
				</ul>
				<form class="pure-form pure-form-stacked viewUser">
					<fieldset>
						<label for="user">User:</label>
						<select id="user">
						</select>
						<button type="submit" class="pure-button">View user</button>
					</fieldset>
				</form>
			</section>
			<section id="right">
				<form class="pure-form pure-form-stacked editUser">
					<fieldset>
						<legend>Edit user:</legend>
						<div class="pure-g-r">
							<div class="pure-u-1-3">
								<label for="username">Username:</label>
								<input type="text" id="username" required>
								<label for="email">Email address:</label>
								<input type="email" id="email" required>
								<label for="password">Password:</label>
								<input type="password" id="password" required>
								<label for="passwordc">Confirm password:</label>
								<input type="password" id="passwordc" required>
							</div>
							<div class="pure-u-1-3">
								<label for="firstname">First name:</label>
								<input type="text" id="firstname" required>
								<label for="lastname">Last name:</label>
								<input type="text" id="lastname" required>
								<label for="address">Business address:</label>
								<textarea id="address" required></textarea>
								<label for="addressb">Billing address:</label>
								<textarea id="addressb" required></textarea>
							</div>
							<div class="pure-u-1-3">
								<label for="subscription">Subscription:</label>
								<select id="subscription">
									<option value="1">Premium PLUS: 2 weeks/300+ photos</option>
									<option value="2">Premium: 4 weeks/200 photos</option>
									<option value="3">Executive: 6 weeks/150 photos</option>
									<option value="4">Basic: 12 weeks/100 photos</option>
								</select>
								<label for="payment">Payment:</label>
								<select id="payment">
									<option value="1">Invoice</option>
									<option value="2">Cash</option>
									<option value="3">Credit</option>
								</select>
								<button type="submit" class="pure-button">Update</button>
							</div>
						</div>
					</fieldset>
				</form>
			</section>
			<? include 'include/footer.html' ?>
		</div>
	</body>
</html>

<?
	} else {
		header('location: index.php');
	}
?>