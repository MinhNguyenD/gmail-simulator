<h3> SENT/DRAFT </h3>
						<div class = "inbox-content" > 
							<div class = "email-title"> 
								<h4> TITLE </h4>
								<?php

									$sql8 = "SELECT * FROM je_email_sentdrafts"; 
									$result8 = $db->query($sql8); 
									$i = 3; //id start @ 3
									
									/*
										check if user has sent/draft email, if yes display the title
									*/
									if($result8->num_rows > 0){
										while($row8 = $result8->fetch_assoc()){
											
											if($row8['je_sentdraft_from_id'] == $_SESSION['userid']){
        
												$title = $row8['je_sentdraft_subject'];
												echo "<p> <a href='index.php?view=sentdraft&mail=$i' > $title</a> </p>"; 
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
									$sql9 = "SELECT * FROM je_email_sentdrafts"; 
									$result9 = $db->query($sql9);
					
									if(isset($_REQUEST['mail'])){
										while($row9 = $result9->fetch_assoc()){
											if($_REQUEST['mail'] == $row9['je_sentdraft_id']){
												echo "
												<div>
													<p> To: ".$row9['je_sentdraft_to_email']. "</p>
													<p> Date: ".$row9['je_sentdraft_datetime']."</p>
													<p>".$row9['je_sentdraft_content']. "</p>
													
												</div>"; 
											}
										}
									}
		
								?> 
							</div> 
						</div>