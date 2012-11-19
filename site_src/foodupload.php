<?php 
include 'core/init.php';
include 'includes/overall/header.php';
?>
<h1>Food Upload</h1>
<?php



if(empty($_POST)=== false){
	$required_fields = array('name');
	foreach($_POST as $key=>$value){
		if(empty($value)&& in_array($key, $required_fields) === true){
			$errors[] = 'fields marked with an * are required';
			break 1;
		}
	}
}

if(empty($_file)===false){
	$allowedExts = array("jpg", "jpeg", "gif", "png");
	$extension = end(explode(".", $_FILES["file"]["name"]));
	if ((($_FILES["file"]["type"] == "image/gif")
	|| ($_FILES["file"]["type"] == "image/jpeg")
	|| ($_FILES["file"]["type"] == "image/png")
	|| ($_FILES["file"]["type"] == "image/pjpeg"))
	&& ($_FILES["file"]["size"] < 2000000)
	&& in_array($extension, $allowedExts)
	&& empty($errors)===true)
	  {
	  if ($_FILES["file"]["error"] > 0)
		{
		echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
		}
	  else
		{
		//echo "Upload: " . $_FILES["file"]["name"] . "<br />";
		//echo "Type: " . $_FILES["file"]["type"] . "<br />";
		//echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
		//echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";

		if (file_exists("upload/" . $_FILES["file"]["name"]))
		  {
		  echo $_FILES["file"]["name"] . " already exists. ";
		  }
		else{
			
			
			// echo "Stored in: " . "upload/" . $_FILES["file"]["name"];
		}
	  }
	}
}

if(isset($_GET['success']) && empty($_GET['success'])){
	echo 'your food have been uploaded successfully!';
}else{
	if(empty($_POST) === false && empty($errors) === true){
		$food_data = array(
			'IDPerson' => $user_data['IDPerson'],
			'Name' => $_POST['name'],
			'Description' => $_POST['description'],
			'Calories' => $_POST['cal']
		);
		
		$returnID=add_food($food_data);
		//if(empty($_file)===false){
		if(move_uploaded_file($_FILES['file']['tmp_name'], "upload/" . $returnID)) {
			chmod("upload/" . $returnID, 0755);
			//echo "The file ".  basename( $_FILES['uploadedfile']['name']). " has been uploaded";
		} else{
			//echo "There was an error uploading the file, please try again!";
		}
			add_foodURL(mysql_insert_id(),"upload/" . $returnID);
		//}
		header('Location: food.php?IDFood='.$returnID);
		exit();
		
	}else if (empty($errors)=== false){
		echo output_errors($errors);
	}
}

	  
if(logged_in()){
?>

<form action="foodupload.php" method="post"
enctype="multipart/form-data">
Food name*:<input type="text" name="name"/><br><br>
Description:<br> <textarea name="description" COLS=30 ROWS=3></TEXTAREA><br>
Calories:<input type="text" name="cal"/><br><br>
<label for="file">image:</label>
<input type="file" name="file" id="file" />
<br />

<input type="submit" name="submit" value="Submit" />
</form>

<?php
}else{
	echo 'You must be logged in to upload a food.';
}
include 'includes/overall/footer.php';?>