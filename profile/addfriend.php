<?php
session_start();
include_once('../includes/connect.php');
$id	=	mysqli_real_escape_string($con,$_POST['uid']);
$user_id	=	$_SESSION['user']['uid'];
$relation   = 'Acquaintance';
$friend_result = mysqli_query($con,"SELECT * FROM contacts WHERE (user_Id = '$id' AND target_id = '$user_id') OR (user_Id = '$user_id' AND target_id = '$id') ");
$is_friend = mysqli_num_rows($friend_result);
if ($is_friend != 1)
	{
	$time = time();
	mysqli_query($con,"INSERT INTO contacts (user_Id,target_id,relation,add_date) VALUES('$id','$user_Id','$relation' ,'$time')");
	}
else
	{
	$time = time();
	mysqli_query($con,"UPDATE contacts SET hide = '0' WHERE (user_Id = '$id' AND target_id = '$user_id') OR (user_Id = '$user_id' AND target_id = '$id')");
	?>
    <tr><td id="friend_button"><div class="sub_menu_icon" onClick="remove_friend('<?php echo $id;?>')"><img src="../images/"><br/>Remove Friend</div></td></tr>
    <?php
	}
?>