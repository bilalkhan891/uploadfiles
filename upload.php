<?php  


if (isset($_POST['submit'])) {
	$file = $_FILES['file'];

	$fileName = $_FILES['file']['name'];
	$fileTmpName = $_FILES['file']['tmp_name'];
	$fileSize = $_FILES['file']['size'];
	$fileError = $_FILES['file']['error'];
	$fileType = $_FILES['file']['type'];

	//return the extention of the files 
	$fileExt = explode('.', $fileName);
	// string to lower case 
	// end gets the last piece of data from an array
	$fileActualExt = strtolower(end($fileExt));

	$allowed =  array('jpg', 'jpeg', 'png', 'pdf' );

	// checks if a certen string is in the array
	if (in_array($fileActualExt/*array*/, $allowed/*string*/)) {
		if ($fileError === 0) {
			if ($fileSize < 1000000) {
				// unique() return the micro second time that is of couse a uniqe name each time
				$fileNameNew = uniqid('', true).".".$fileActualExt;
				$fileDestination = 'uploads/'.$fileNameNew;
				//this actually uploads the file
				move_uploaded_file($fileTmpName, $fileDestination);
				header("Location: index.php?upload=success")
;			} else {
				echo "Your file size is too big!";
			}
		}
	} else {
		echo "You cannot upload files of this type!";
	}

}