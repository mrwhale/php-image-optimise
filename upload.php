<?php
session_start();
$ds          = DIRECTORY_SEPARATOR;  //1
 //todo get original file size and then get file size of resize, save to file for use in view
 
$storeFolder = 'uploads/' . $_SESSION['folder'];

if(!is_dir($storeFolder)){
    mkdir($storeFolder);
}
if (!empty($_FILES)) {
    print_r($_FILES);
    $tempFile = $_FILES['file']['tmp_name'];      
      
    $targetPath = dirname( __FILE__ ) . $ds. $storeFolder . $ds;
     
    $targetFile =  $targetPath. $_FILES['file']['name'];
    $resizeName = $targetPath . explode(".",$_FILES['file']['name'])[0];
    //move_uploaded_file($tempFile,$targetFile);
    $resize = new Imagick($tempFile);

    if(!empty($_POST['resize'])){
        //Not empty we should resize the image
        $resize->resizeImage($_POST['size'],$_POST['size'],Imagick::FILTER_LANCZOS,1);
    }
    //dont resize but optimise. convert to jpg and lower quality
    
    $resize->stripImage();
    $resize->setImageCompression(imagick::COMPRESSION_JPEG);
    $resize->setImageCompressionQuality(80);
    if(!empty($_POST['progressive'])){
        //make image progressive
        $resize->setInterlaceScheme(imagick::INTERLACE_PLANE);
    }
    $resize->writeImage($resizeName . '.jpg');
    $resize->destroy();
}
?>  