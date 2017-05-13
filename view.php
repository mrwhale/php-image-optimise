

<?php
$files = glob("uploads/*.*");
for ($i = 1; $i < count($files); $i++) {
    $image = $files[$i];
    $supported_file = array(
        'gif',
        'jpg',
        'jpeg',
        'png'
    );
 
    $ext = strtolower(pathinfo($image, PATHINFO_EXTENSION));
    if (in_array($ext, $supported_file)) {
        echo basename($image).'</br>';
echo '<img height="200" src="' . $image . '" alt="Random image" />';
} else {
continue;
}
}
?>