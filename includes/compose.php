<h3> COMPOSE </h3>
<form action="index.php?view=compose" class="encode-form" method="post">
            <div class="form-group">
				<label for="email-to-id">To:</label>
				<input type="email" name="email-to" id="email-to-id">
            </div>

			<div class="form-group">
				<label for="email-static">From:</label>
				<input type="email" name="email-from" id="email-static" readonly value= <?php echo $_SESSION['useremail'];?>>
            </div>
            
            <div class="form-group">
                <label for="email-subject-id">Email Subject</label>
				<input name="email-subject" type="text" id="email-subject-id">
		    </div>	 
            <div class="form-group">
				<label for="message-input">Message</label>
				<textarea name="email-message" id="message-input"></textarea>
			</div>
            <input type="submit" name="send-email" value= "Send without encrypt" id ="email-send">
            <input type="submit" name="encrypt-save-email" value= "Encrypt and save" id ="encrypt-save">
            <input type="submit" name="save-nonencrypt-email" value= "Save without encrypt" id ="save-nonencrypt">
            <input type="submit" name="cancel-email" value= "Cancel" id ="cacncel-send">

            <?php
                if($_REQUEST['sent'] == 'true'){
                    //if send successfully (send to email is in the databse)
            ?>  
            <div class = "suggestion">      
               <p> Email sent successfully! </p> 
            <div> 
            
            <?php
                }
                else if($_REQUEST['sent'] == 'false'){
                    //if send fail (send to email is not in the databse)

            ?>
            <div class = "suggestion">      
               <p> Failed to send email </p> 
            <div> 
            <?php
            }
            ?>

            
            <?php
                if($_REQUEST['save'] == 'true'){
                    //if send successfully (send to email is in the databse)
            ?>  
            <div class = "suggestion">      
               <p> Email save successfully! </p> 
            <div> 
            
            <?php
                }
                else if($_REQUEST['save'] == 'false'){
                    //if send fail (send to email is not in the databse)

            ?>
            <div class = "suggestion">      
               <p> Failed to save email </p> 
            <div> 
            <?php
            }
            ?>
</form>

<?php
        require_once "includes/functions.php";
        require_once "includes/db.php";
        if(isset($_REQUEST['send-email'])){
            
            //process form submission 
            $email_to = sanitizeData($_REQUEST['email-to']);
            $email_from = sanitizeData($_REQUEST['email-from']);
            $email_subject  = sanitizeData($_REQUEST['email-subject']);
            $email_message  = sanitizeData($_REQUEST['email-message']);
            
            //check if send to email is in the database 
            $sql10 = "SELECT * FROM je_login WHERE je_login_email = '{$email_to}'";
            $result10 = $db->query($sql10);
			$row10 = $result10->fetch_assoc();
            $count2 = mysqli_num_rows($result10);
            
            //get send to email id and send form email id 
            $email_to_Id = $row10['je_login_id'];
            $email_from_Id = $_SESSION['userid']; 
            $current_time =  date('Y-m-d H:i:s');  
            
            //get new ID (increment) in inbox table 
            $sql11 = "SELECT * FROM je_inbox"; 
            $result11 = $db->query($sql11);
            $num_email_Ids = $result11->num_rows; 
            $new_email_Id = $num_email_Ids + 1; 
            
            //get new ID (increment) in sentdraft table 
            $sql13 = "SELECT * FROM je_email_sentdrafts"; 
            $result13 = $db->query($sql13);
            $num_email_Ids1 = $result13->num_rows; 
            $new_sentemail_Id = $num_email_Ids1 + 3; //starting at id = 3 
            
            /*  
                if send to email is in the database
                Insert sent email into database 
                insert inbox into database 

            */
            if($count2 > 0){
                $sql12 = "INSERT INTO je_inbox VALUES ($new_email_Id,'{$email_from}',$email_to_Id,'{$email_subject}','{$email_message}', 0,'{$current_time}')";
                $result12 = $db->query($sql12);
                $sql14 = "INSERT INTO je_email_sentdrafts VALUES ('{$new_sentemail_Id}','{$email_to}','{$email_from_Id}','{$email_subject}','{$email_message}', 0, 0,'{$current_time}')";
                $result14 = $db->query($sql14);
                header("Location: index.php?view=compose&sent=true");
            }
            else{
                header("Location: index.php?view=compose&sent=false");
            }
        }
        else if (isset($_REQUEST['encrypt-save-email'])){

        }
        else if (isset($_REQUEST['save-nonencrypt-email'])){
            //process form submission 
            $email_to = sanitizeData($_REQUEST['email-to']);
            $email_from = sanitizeData($_REQUEST['email-from']);
            $email_subject  = sanitizeData($_REQUEST['email-subject']);
            $email_message  = sanitizeData($_REQUEST['email-message']);
            
            //check if send to email is in the database 
            $sql10 = "SELECT * FROM je_login WHERE je_login_email = '{$email_to}'";
            $result10 = $db->query($sql10);
            $row10 = $result10->fetch_assoc();
            $count2 = mysqli_num_rows($result10);
            
            //get send to email id and send form email id 
            $email_to_Id = $row10['je_login_id'];
            $email_from_Id = $_SESSION['userid']; 
            $current_time =  date('Y-m-d H:i:s');  
            
            //get new ID (increment) in inbox table 
            $sql11 = "SELECT * FROM je_inbox"; 
            $result11 = $db->query($sql11);
            $num_email_Ids = $result11->num_rows; 
            $new_email_Id = $num_email_Ids + 1; 
            
            //get new ID (increment) in sentdraft table 
            $sql13 = "SELECT * FROM je_email_sentdrafts"; 
            $result13 = $db->query($sql13);
            $num_email_Ids1 = $result13->num_rows; 
            $new_sentemail_Id = $num_email_Ids1 + 3; //starting at id = 3 
            
            /*  
                if send to email is in the database
                Insert sent email into database 
                insert inbox into database 

            */
            if($count2 > 0){
                $sql14 = "INSERT INTO je_email_sentdrafts VALUES ('{$new_sentemail_Id}','{$email_to}','{$email_from_Id}','{$email_subject}','{$email_message}', 0, 0,'{$current_time}')";
                $result14 = $db->query($sql14);
                header("Location: index.php?view=compose&save=true");
            }
            else{
                header("Location: index.php?view=compose&save=false");
            }

        }
        else if (isset($_REQUEST['cancel-email'])){
            header("Location: index.php?view=compose");
        }
        
?>