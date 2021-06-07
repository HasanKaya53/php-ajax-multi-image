<?php


/**
 *
 */
class imageClass
{
    /* 
      $queryType = 1 upload image
      $queryType = 2 upload pdf
    */
  function uploadFile($filesImage,$imageName="",$saveFolder="default",$queryType=1){
    
    
     if($saveFolder == "default"){
       $saveFolder = "img/";
     }

    /* if you need any file type You can write */
    if ($queryType == 1)
      $AccessfileType = array('jpeg', 'jpg', 'png');
    else if($queryType == 2)
      $AccessfileType = array('pdf');
    else
      die("plase set queryType"); // if not $queryType 1 or 2
    
    

    $allTemp = array();
    $allPath = array();
    $imageNamesArray = array();
    $errorStatus = 0; 
    $errorCode = "";
    
    /* if filesImage is array */
    if(is_array($filesImage['name'])){
      /* just count image */
      $filesImageCount = count($filesImage['name']);
    }
    
    /* if an image not post */
    if($filesImage <= 0){
      echo "please select image";
      die();
    }
    
    

    for($i = 0; $i < $filesImageCount; $i++){
      $path = $saveFolder;

      $img = $filesImage['name'][$i];
      $tmp = $filesImage['tmp_name'][$i];
      $maxSize = $filesImage['size'][$i];
      $ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
      
      
      if (empty($imageName)){
        /* If you didn't send a name  */
        $imgName = trim(str_replace(" ","-",date("His"))).rand(1000,9999).".".$ext;
      }else{
        /* if you sent name and multiple files. i rename */
        $imgName = $imageName.$i.".".$ext;
      }

     
    
      $path = $path.strtolower($imgName);
      $allTemp[$i] = $tmp;
      $allPath[$i] = $path;
      $imageNamesArray[$i] = $imgName;

        if(in_array($ext, $AccessfileType)){

        if ($maxSize <= (1024*1024*2)) {
           $errorStatus = 0;
        }
        else{
          $errorCode = "max size error";
          $errorStatus = 1;
          break;
        }
         
        }
        else{
          $errorCode = "you cant upload this folder";
          $errorStatus = 1;
          break;

        }
        
    }
    if($errorStatus == 1){
      return array($errorCode,$errorStatus);
    }else{  
      for($i = 0;$i<count($allTemp);$i++){
         if( !empty($allTemp[$i]) && !empty($allPath[$i]) ){
            if(!move_uploaded_file($allTemp[$i],$allPath[$i])){
              $errorStatus = 1;
            }
         }
      }
      if($errorStatus == 1){
        for($i = 0;$i<count($allTemp);$i++){
        if( !empty($allTemp[$i]) && !empty($allPath[$i]) ){
          unlink($allPath[$i]);
        }
       }
     }
     if($errorCode == "yok"){
       $errorCode = "Error !!!";
     }
      return array($errorStatus,$errorCode,$imageNamesArray);
    }
      
    }

}


 ?>
