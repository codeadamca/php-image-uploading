<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Results</title>
</head>
<body>

    <h1>Upload Results</h1>
    
<?php

// Include PHP libraries installed using Composer
require __DIR__ . '/vendor/autoload.php';

// Import WideImage package
use WideImage\WideImage;

// Dump form data to browser
echo '<h2>Form Data</h2>';
echo '<pre>';
print_r($_POST);
print_r($_FILES);
echo '</pre>';

// Check if the temp file from the form exists
echo '<h2>Check File</h2>';
echo 'File Exist: '.file_exists($_FILES['image']['tmp_name']);

// Get the file extenion for the new file names based on the
// file type of the uploaded image.
if($_FILES['image']['type'] == 'image/png')
{
    $extension = 'png';
}
else if($_FILES['image']['type'] == 'image/jpeg')
{
    $extension = 'jpg';
}
else if($_FILES['image']['type'] == 'image/gif')
{
    $extension = 'gif';
}

// Creater the new filenames for the original image and 
// the new thumbnail.
$original_filename = 'original.'.$extension;
$thumbnail_filename = 'thumbmail.'.$extension;

// Output the two new filenames to confirm they are correct
echo '<h2>New Filenames</h2>';
echo 'New Filename: '.$original_filename.'<br>
    Thumbnail: '.$thumbnail_filename;

// Copy the temp file to this folder using the original 
// filename from the variable above.
move_uploaded_file($_FILES['image']['tmp_name'], $original_filename);

// Copy the file crreated in the line above, resize it, crop it,
// and save it using the thumbnail filename.
$square = WideImage::load($original_filename)
    ->resize(200, 200, 'outside')
    ->crop("center", "middle", 200, 200)
    ->saveToFile($thumbnail_filename);

?>

    <h2>Image Results</h2>
    <hr>
    <img src="<?=$original_filename?>" style="max-width: 300px;">
    <hr>
    <img src="<?=$thumbnail_filename?>">
    
</body>
</html>
