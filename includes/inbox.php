<h3> INBOX </h3>
				<div class = "inbox-content" > 
					<div class = "email-title"> 
						<h4> TITLE </h4>
						<?php
						
							$sql6 = "SELECT * FROM je_inbox"; 
							$result6 = $db->query($sql6); 
							$i = 1; //id start @ 1 
							/*
								check if user has inbox email, if yes display the title
							*/
							if($result6->num_rows > 0){
								while($row6 = $result6->fetch_assoc()){
									if($row6['je_email_to_id'] == $_SESSION['userid']){
										$title = $row6['je_email_subject'];
										echo "<p> <a href='index.php?view=inbox&mail=$i' > $title</a> </p>"; 
										//$numTitle++; 
									}
									$i++;
								}
							}
							
						?> 
					</div>
					
					<div class = "email-content">
						<h4> CONTENT </h4> 
						<?php 
							/*
								check if user select a title, if yes display the content of that title
							*/
							$sql7 = "SELECT * FROM je_inbox"; 
							$result7 = $db->query($sql7);
			
							if(isset($_REQUEST['mail'])){
								while($row7 = $result7->fetch_assoc()){
									if($_REQUEST['mail'] == $row7['je_email_id']){
										echo "
										<div>
											<p> From: ".$row7['je_email_from_email']. "</p>
											<p> Date: ".$row7['je_date_received']."</p>
											<p>".$row7['je_email_content']. "</p>
										</div>"; 
									}
								}
							}
						?> 
					</div> 
				</div>