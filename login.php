<?php
	// Include Files
	include_once ('include/db_connect.php');
	include_once ('include/includeHeading.php');
	?>



<div>

	<form id="loginForm">
		<table>
			<thead>
			<tr>
				<th colspan="2">Please Login with Your Username and Password</th>
			</tr>
			</thead>
			<tbody>
				<tr>
					<td><label>Username</label></td>
					<td><input type="text" id="username" 
								name="username" placeholder = "Username" ></input></td>							
				</tr>
								<tr>
					<td><label>Password</label></td>
					<td><input type="password" id="password" 
								name="password" placeholder = "Password" ></input></td>							
				</tr>
			</tbody>
			<tfoot>
				<tr>
					<td colspan="2", class = 'footer'>
						<input type="submit" class = 'submit' value="Submit"> </input>
						<input type="reset" class = 'clear' value="Clear"> </input>													
					</td>							
				</tr>
			</tfoot>
		</table>
	</form>
			<div id="message" class="form-control" style="display: none"></div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"
	integrity="sha384-
	B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k"
	crossorigin="anonymous"></script>

<script>
	$(document).ready(function() {
			$('#loginForm').submit(function(event) {
				event.preventDefault(); 
				$('#message').empty();
				$('#message').hide();
				var postForm = $('#loginForm').serialize();
				console.log(postForm);
				$.ajax({ 
					type : 'POST', 
					url : 'checkUser.php', 
					data : postForm,
					dataType : 'json',
					success : function(data) {
						if ( ! data.success ) { 
							if (data.errors.username) {
								$('#message').fadeIn(1000).html(data.errors.username); 
								$('#message').show();
							} 
							else if (data.errors.password) { 
								$('#message').fadeIn(1000).html(data.errors.password); 
								$('#message').show();
							}
							}
						else { // if sucssful, then throw a success message
							$('#message').fadeIn(1000).append('<p>' + data.posted + '</p>'); 
							$('#message').show();
							window.location='main.php';
							}
					}
			});
		});
	});

	$('#username, #password').focus(function(event) {
	$('#message').empty();
	$('#message').hide();
	});
</script>


<?php
	// Include Files
	include_once ('include/includeFooting.php');
	?>