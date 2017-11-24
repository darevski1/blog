<?php
function escape($string)
{
	global $connection;
	mysqli_real_escape_string($connection, trim($string));
}


function confirm($result)
{
	global $connection;
	if (!$result) {
		die("Errrrror" . mysqli_error($connection));
	}
}


function insert_categories()
{
	global $connection;
	if (isset($_POST['submit'])) {
		$cat_title = $_POST['cat_title'];
		if ($cat_title == "" || empty($cat_title)) {
			echo "This field should not be empty";
		} else {
			$query = "INSERT into categories(cat_title)";
			$query .= "VALUES('{$cat_title}')";

			$create_category_query = mysqli_query($connection, $query);

			if (!$create_category_query) {
				die('QUERY FAIL') . mysqli_query($connection);
			}
		}
	}
}

function user_online()
{
	if (isset($_GET['onLineusers'])) {

		global $connection;

		if (!$connection) {
			session_start();
			include("../includes/db.php");

			$session = session_id();
			$time = time();
			$time_out_in_seconds = 30;
			$time_out = $time - $time_out_in_seconds;

			$query = "SELECT * from users_online WHERE session = '$session'";
			$send_query = mysqli_query($connection, $query);
			$count = mysqli_num_rows($send_query);

			if ($count == NULL) {
				mysqli_query($connection, "INSERT INTO users_online(session, time) VALUES ('$session', '$time')");
			} else {
				mysqli_query($connection, "UPDATE users_online SET time = '$time' WHERE SESSION = '$session'");
			}
			$users_online = mysqli_query($connection, "SELECT * FROM users_online WHERE time > '$time_out'");
			echo $count_user = mysqli_num_rows($users_online);
		}
	}//get request isset
}

user_online();


// Check if the user is admin
function is_admin($username = '')
{

	global $connection;

	$query = "SELECT user_role FROM users WHERE username = '$username'";
	$result = mysqli_query($connection, $query);

	confirm($result);
	$row = mysqli_fetch_array($result);

	if ($row['user_role'] == 'admin') {
		return true;
	} else {
		return false;
	}
}

function username_exist($username)
{
	global $connection;

	$query = "SELECT username FROM users WHERE username = '$username'";
	$username_query = mysqli_query($connection, $query);

	confirm($username_query);

	if (mysqli_num_rows($username_query) > 0) {
		return true;
	} else {
		return false;
	}

}

function email_exist($email)
{
	global $connection;

	$query = "SELECT user_email FROM users WHERE user_email = '$email'";
	$username_query = mysqli_query($connection, $query);

	confirm($username_query);

	if (mysqli_num_rows($username_query) > 0) {
		return true;
	} else {
		return false;
	}

}

function redirect($location)
{

	return header("Location:" . $location);
}

function register_user($username, $email, $password)
{
	global $connection;

	$username = mysqli_real_escape_string($connection, $username);
	$email = mysqli_real_escape_string($connection, $email);
	$password = mysqli_real_escape_string($connection, $password);

	$password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));

	$query = "INSERT INTO users (username, user_email, user_password, user_role)";
	$query .= "VALUES ('{$username}','{$email}','{$password}','subscriber')";
	$register_user_query = mysqli_query($connection, $query);

	confirm($register_user_query);

	if (mysqli_affected_rows($connection, $register_user_query) == 0) {
		login_user($username, $password);
		redirect('../phpmaster/admin');
	}
}

function login_user($username, $password)
{

	global $connection;

	$username = trim($username);
	$password = trim($password);

	$username = mysqli_real_escape_string($connection, $username);
	$password = mysqli_real_escape_string($connection, $password);

	$query = "SELECT * FROM users WHERE username = '{$username}'";
	$select_user_query = mysqli_query($connection, $query);

	if (!$select_user_query) {
		die("Errorr" . mysqli_error($connection));
	}

	while ($row = mysqli_fetch_array($select_user_query)) {
		$db_user_id = $row['user_id'];
		$db_username = $row['username'];
		$db_user_firstname = $row['user_firstname'];
		$db_user_lastname = $row['user_lastname'];
		$db_user_role = $row['user_role'];
		$db_password = $row['user_password'];
	}
	//$password = crypt($password, $db_password);

	if (password_verify($password, $db_password)) {
		$_SESSION['username'] = $db_username;
		$_SESSION['firstname'] = $db_user_firstname;
		$_SESSION['lastname'] = $db_user_lastname;
		$_SESSION['user_role'] = $db_user_role;

		header("Location: /phpmaster/admin");
	} else {
		header("Location: /phpmaster/index.php");
	}

}