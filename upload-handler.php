<?php

include "File.php";

$result = File::handleUpload($_FILES['input_file']);

if ($result !== FALSE) {
	header('Location: index.php?success=1&target_file_path=' . $result);
} else {
	header('Location: index.php?error=' . $e->getMessage());
}