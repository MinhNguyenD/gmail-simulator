<?php
	/*
	 * This function.php was coded by:
	 * Student name: Minh Nguyen
	 * B00#: B00861753
	 * Email: mn549239@dal.ca
	 */
	function sanitizeData($rawData) {
		$sanitizedData = trim($rawData);
		$sanitizedData = htmlspecialchars($sanitizedData);
		$sanitizedData = stripslashes($sanitizedData);
		return $sanitizedData;
	}
?>