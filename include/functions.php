<?php
	function includeHeadSection($title) {
?>
		<head>
			<meta charset="utf-8">
			<meta http-equiv="X-UA-Compatible" content="IE=edge">
			<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">		
			
			<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" 
				  integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
				  
			<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" 
				  integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
				  
			<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">	

			<link href="css/main.css" rel="stylesheet" type="text/css" />			

			<title><?php echo $title; ?></title>		
		</head>		
		
<?php		
	}
?>

<?php
	function includeFooterSection() {
?>		
		<div id="footer">
				<p class="footer-block">&copy; 2019 A B C Company Ltd. </p>
		</div>
<?
	}
?>

<?php
	function includejQuery() {
?>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>	

		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" 
				integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" 
				crossorigin="anonymous"></script>

<?
	}
?>