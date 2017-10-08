
<?php 
session_start();
echo $_SESSION['folder'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Creating an Image Gallery From Folder using PHP</title>
<style type="text/css">
body
{
 background:#fff;
}
img
{
 width:25%;
 box-shadow:0px 0px 20px #cecece;
 -moz-transform: scale(0.7);
 -moz-transition-duration: 0.6s; 
 -webkit-transition-duration: 0.6s;
 -webkit-transform: scale(0.7);
 
 -ms-transform: scale(0.7);
 -ms-transition-duration: 0.6s; 
}
img:hover
{
  box-shadow: 20px 20px 20px #dcdcdc;
 -moz-transform: scale(0.8);
 -moz-transition-duration: 0.6s;
 -webkit-transition-duration: 0.6s;
 -webkit-transform: scale(0.8);
 
 -ms-transform: scale(0.8);
 -ms-transition-duration: 0.6s;
 
}
</style>
</head>
<body>
<?php
//todop download button that will zip all images up and download
//todo read file for old + new file sizes to display to user
if (is_session_started() === FALSE){
  echo "No session, go away";
}


if(!$_SESSION['folder']){
    //folder doesnt exist so no uplaods
    echo "no files for your session, please go back and try again";
    exit();
}else{
    $folder_path = 'uploads/' . $_SESSION['folder'] . '/'; //image's folder path
    if(!is_dir($folder_path)){
        //no folder here so mustnt have uploaded anything
        echo "nothing uploaded";
    }else{

    
        $num_files = glob($folder_path . "*.{JPG,jpg,gif,png,bmp}", GLOB_BRACE);

        $folder = opendir($folder_path);
        
        if($num_files > 0){
            while(false !== ($file = readdir($folder))){
            $file_path = $folder_path.$file;    
            $extension = strtolower(pathinfo($file ,PATHINFO_EXTENSION));
            if($extension=='jpg') {?>
                        <a download="<?php echo $file_path?>" href="<?php echo $file_path; ?>"><img src="<?php echo $file_path; ?>" /></a>
                        <?php
                }
            }
        }else{
            echo "the folder was empty !";
        }
        closedir($folder);
    }
}
?>
</body>
</html>


<?php
/**
* @return bool
*/
function is_session_started()
{
    if ( php_sapi_name() !== 'cli' ) {
        if ( version_compare(phpversion(), '5.4.0', '>=') ) {
            return session_status() === PHP_SESSION_ACTIVE ? TRUE : FALSE;
        } else {
            return session_id() === '' ? FALSE : TRUE;
        }
    }
    return FALSE;
}
?>