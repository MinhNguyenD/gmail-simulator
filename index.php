<?php
/*
This code contains code re-used from code for my A3 solution in this course. 
This code is used with Prof. Raghav Sampangi's permission. This code is used as a starting point for my solution for A4.
*/
?>

<?php
    // Starter file for A4 in CSCI 2170 
    require_once "includes/functions.php";
	require_once "includes/db.php"; 
	require_once "includes/header.php";
    require_once "includes/login.php";

?> 

	<?php
		if (isset($_SESSION['username'])) {
			//login successful, display user page
	?>
			<nav> 
				<h2>Hello, <?php echo $_SESSION['username']; ?></h2>
				<p><a href="index.php?view=compose">Compose</a><p>
				<p><a href="index.php?view=sentdraft">Sent/Draft</a><p>
				<p><a href="index.php?view=inbox">Inbox</a><p> 
				<p><a href="profile.php">Profile</a></p>
				<p><a href="includes/logout.php">Logout</a></p>
			</nav>		
		</header>
		<main class="pg-main-content">
    <?php
			if($_REQUEST['view'] == 'inbox' ){
				//inbox view (when clicked the link)
				require_once "includes/inbox.php"; 
	?>			
	<?php
			}
			else if($_REQUEST['view'] == 'sentdraft' ){
				//sent/draft view (when clicked the link)
				require_once "includes/sentdraft.php"; 
	?>			
	<?php
			}
			else if($_REQUEST['view'] == 'compose' ){
				//compose view (when clicked the link)
				require_once "includes/compose.php";
	?>
	<?php
			}
    	}	
		else {
			//login fail, request to re-login
	?>
		<nav> 
			<h2>Hello! Please login to continue</a>!</h2> 
		</nav>
	</header> 
	<main class="pg-main-content">
		<form id = "form-login" name = "user-login" method = "post" action = "index.php"> 
				<label for="email">Email</label>
				<input name="email-login" type="email" id="email" placeholder="email@example.com">
				<label for="password">Password</label>
				<input name="password-login" type="password" id="password">
				<input type="submit" name="submit-login" value= "Log in">
				<input type="hidden" name="token-input" value="<?php echo $_SESSION['token'];?>">
				<div class = "suggestion"> 
					<p>Doesn't have an account?<a href="register.php"> Register</a></p> 
				</div>  
		</form>
	<?php
		}
	?>
	</main>	

<?php 
	require_once "includes/footer.php"; 
?> 

