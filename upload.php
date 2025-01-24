<?php

echo '<pre>';
print_r($_POST);
print_r($_FILES);

echo 'File Exist: '.file_exists($_FILES['image']['tmp_name']);

move_uploaded_file($_FILES['image']['tmp_name'], 'image.jpg');

