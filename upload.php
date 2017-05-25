<?php
$ds          = DIRECTORY_SEPARATOR;  //1
 
$storeFolder = 'uploads';   //2

if (!empty($_FILES)) {
    print_r($_FILES);
    $tempFile = $_FILES['file']['tmp_name'];          //3             
      
    $targetPath = dirname( __FILE__ ) . $ds. $storeFolder . $ds;  //4
     
    $targetFile =  $targetPath. $_FILES['file']['name'];  //5
    $resizeName = $targetPath . explode(".",$_FILES['file']['name'])[0];
    move_uploaded_file($tempFile,$targetFile); //6
    $resize = new Imagick($targetFile);

    if(!empty($_POST['resize'])){
        //Not empty we should resize the image
        $resize->resizeImage($_POST['size'],$_POST['size'],Imagick::FILTER_LANCZOS,1);
    }
    //dont resize but optimise. convert to jpg and lower quality
    
    $resize->stripImage();
    $resize->setImageCompression(imagick::COMPRESSION_JPEG);
    $resize->setImageCompressionQuality(85);
    if(!empty($_POST['progressive'])){
        //make image progressive
        $resize->setInterlaceScheme(imagick::INTERLACE_PLANE);
    }
    $resize->writeImage($resizeName . '-resize.jpg');
    $resize->destroy();
}
?>  