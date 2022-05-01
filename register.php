<?php
/*
This code contains code re-used from code for my GL5 solution in this course. 
This code is used with Prof. Raghav Sampangi's permission. This code is used as a starting point for my solution for A4.
*/

?> 

<?php 
    ob_start(); 
    session_start();    
	require_once "includes/header.php";
    require_once "includes/functions.php";
	require_once "includes/db.php"; 
?>
		<nav> 
			<h2>Hello! Please register to continue</a>!</h2> 
           
		</nav>
	</header> 

    <?php
    	if (isset($_REQUEST['submit-register'])) {
            // Process the form submission
            
            $fname_reg = sanitizeData($_REQUEST['fname-reg']);
            $lname_reg  = sanitizeData($_REQUEST['lname-reg']);
            $email_reg  = sanitizeData($_REQUEST['email-reg']);
            $password_reg  = sanitizeData($_REQUEST['password-reg']);
            $error = false;
            
            // check regex of fname 
            
            if (preg_match("/^[A-Z]$/", $fname_reg) == 0) {
                $replace = strtoupper(substr($fname_reg, 0, 0));
                $fname_reg = preg_replace('/^/', $replace, $fname_reg);
            }

            if (preg_match("/^[A-Z]$/", $lname_reg) == 0) {
                $replace1 = strtoupper(substr($lname_reg, 0, 0));
                $lname_reg = preg_replace('/^/', $replace1, $lname_reg);
            }

            if (preg_match("/@dal.ca$/", $email_reg) == 0 && preg_match("/@jediacademy.edu$/", $email_reg) == 0 && preg_match("/@theforce.org$/", $email_reg) == 0) {
                $error = true; 
                $_SESSION['error'] = "emailError: email must end with @dal.ca or @jediacademy.edu or @theforce.org";
            }
            if(!$error){
                //insert successful registration into database 
                $_SESSION['error'] = "";
                $sql3 = "SELECT * FROM je_login";
                $result3 = $db->query($sql3); 
                $numIds = $result3->num_rows; 
                $newId = $numIds + 1; 
            
                $sql4 = "INSERT INTO je_login VALUES ($newId,'{$email_reg}','{$password_reg}')";
			    $result4 = $db->query($sql4); 
            
                $sql5 = "INSERT INTO je_users VALUES ($newId,'{$fname_reg}','{$lname_reg}',$newId,0,0)";
			    $result5 = $db->query($sql5); 
                header("Location: index.php?registersuccess");
            }
            else{
                header("Location: register.php?registerfail");
            }
        }
        ob_end_flush();
    ?>
	<main class="pg-main-content">
		<h2>Enter your details</h2>
		
		<form action="register.php" class="encode-form" method="post">
			<div class="form-group">
				<label for="fname-input">First name</label>
				<input type="text" name="fname-reg" id="fname-input" required>
			</div>
			<div class="form-group">
				<label for="lname-input">Last name</label>
				<input type="text" name="lname-reg" id="lname-input" required>
			</div>
			<div class="form-group">
				<label for="email-input">Email</label>
				<input type="email" name="email-reg" id="email-input" required>
            </div>
            <?php
                if(isset($_SESSION['error'])){
                ?>
                <div>
                        <p><?php echo $_SESSION['error'];?></p>
                </div> 
            <?php
                }
            ?>
            
            <div class="form-group">
                <label for="password-register">Password</label>
				<input name="password-reg" type="password" id="password-register" required>
		    </div>	 
            <input type="submit" name="submit-register" value= "Register" id ="btn-submit">
            <div class = "suggestion"> 
                <p> Already have an account? <a href = index.php>Sign in </a></p>
            </div>
        </form>

	</main>
<?php
	include "includes/footer.php";
?>