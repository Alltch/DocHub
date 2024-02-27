<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $uploadedBy = $_POST['uploadedBy'];
    $uploadDate = date('Y-m-d');
    
    // Check if file was uploaded without errors
    if(isset($_FILES["file"]) && $_FILES["file"]["error"] == 0){
        $filePath = "uploads/" . basename($_FILES["file"]["name"]);
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $filePath)) {
            // File uploaded successfully, now insert into database
            $conn = mysqli_connect("localhost", "root", "", "dochub");
            $query = "INSERT INTO documents (Title, FilePath, UploadDate, UploadedBy) VALUES ('$title', '$filePath', '$uploadDate', '$uploadedBy')";
            mysqli_query($conn, $query);
            mysqli_close($conn);
            echo "File uploaded successfully!";
        } else {
            echo "Error uploading file!";
        }
    } else {
        echo "Error: No file uploaded!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Upload Document</title>
</head>
<body>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
    <label for="title">Title:</label>
    <input type="text" id="title" name="title"><br><br>
    <label for="uploadedBy">Uploaded By:</label>
    <input type="text" id="uploadedBy" name="uploadedBy"><br><br>
    <label for="file">Select File:</label>
    <input type="file" id="file" name="file"><br><br>
    <input type="submit" value="Upload Document">
</form>
</body>
</html>
