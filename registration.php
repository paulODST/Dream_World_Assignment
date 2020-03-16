 <?php

include("control.php");

$hostname="localhost";
$db="dream_singles";
$Username="root";
$Password ="Wranlanda02";

$error_msg="";

//List of emails in used (for validation test)
$used_emails= ['emile@outlook.com',
			   'ken@gmail.com',
			   'beatrize@aol.jp',
			   'strange@msn.fr',
			   'raven@future.com',
			   'wraith@predator.imc',
			   'ghost@ww2.com',
			   'price@usaa.com',
			   'john117@microsoft.com',
			   'renji@fullbring.com'];

//Using PDO to establish connection with DB
$conn= new PDO("mysql:host=$hostname;dbname=$db", $Username, $Password);

	if(isset($_POST['register'])){
		
		
		//Verifying that form submitted has no empty field
		if(empty($_POST['password'])){
			$error_msg.="<p>password is missing</p>";
		}else{
			$password=$_POST['password'];
		}		
		if(empty($_POST['email'])){
			$error_msg.="<p>email is missing</p>";
		}else{
			$email=$_POST['email'];
		}
		if(strtotime($_POST['dob'])==false){
			$error_msg.="<p>date of birth is missing</p>";
		}else{
			$dob=$_POST['dob'];
		}
		
		
		if(empty($error_msg)){
			
			//Searching $used_emails list to check if email is not in use already
			if(in_array($_POST['email'], $used_emails)){
				$error_msg.="<p>email submitted is already in use</p>";
			}

			//Searching DB to check that email submitted is already in use.
			$email_srch = $conn->prepare('SELECT email FROM accounts WHERE email = :email');
			$email_srch->execute(array(':email' => $email));
			//checking for existing/invalid email
			if(row_verify($email_srch)==true){
				$error_msg.="<p>email submitted is already in use</p>";
			}
			//checking for invalid DOB
			if(dob_verify($dob)==false){
				$error_msg.="<p>you must be 18 or older</p>";
			}
			//checking for invalid password
			if(pass_verify($password)==false){
				$error_msg.="<p>password must have at least 1 letter and 1 number</p>";
			}
			
			//adding valid user inputs/creds to DB 
			elseif(empty($error_msg)){
				
				$table= "CREATE TABLE IF NOT EXISTS accounts (
						email varchar(100) PRIMARY KEY,
						password varchar(100),
						dob date)";

				$conn->exec($table);
			
				$add_usr= $conn->prepare("INSERT INTO accounts(email, password, dob) VALUES(:email, :password, :dob)");
				$conn->beginTransaction();
				$add_usr-> execute(array(':email'=>$email,
										 ':password'=>$password,
										 ':dob'=>$dob));
				$conn->commit();
			    $conn->null;
				header("Location:registration.php");
			    exit;
			}
		
		}
		
	}
?>

<!doctype html>
<html lang="en">
<head>

<title>Dream-World Registration form</title>
<link rel="stylesheet" href="style.css">

</head>

<body>

	<div class= "logo">
		<img src='dream_logo.png'>
	</div>
	
	<div class= "signup-page">
	<form action="" method="POST">
		<div class= "register-form">
			<h2 style="font-family:Roboto, sans-serif; color: #4d4d4d;">Create account</h2>
			<input type="text" name="email" placeholder="email" autocomplete="off" />
			<input type="password" name="password" placeholder="password" autocomplete="off" />
			<input type="date" name="dob" placeholder="birthday" autocomplete="off" />
			
			<button type="submit" name="register">Create</button>
			
			<div class="error">
				<?php echo '<span style="font-family:Roboto,sans-serif;color:red;">'.$error_msg.'</span>';?>
			</div>
		</div>		
	</form>
	</div>





</body>
</html>