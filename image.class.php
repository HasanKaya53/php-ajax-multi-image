<?php


/**
 *
 */
class imageClass
{
  
  function uploadFile($filesImage,$imageName="",$saveFolder="default",$queryType=1){
    /* 
    işlem = 1 ise, resim yükleme
    işlem = 2 ise, PDF yükleme
    
    Resim Kayıt Yeri: '../../../../view/img/cekilisResimleri/
    PDF kayıt yeri : ../../../pdf/
     */
    
     if($saveFolder == "default"){
       $saveFolder = "img/";
     }

    
    if ($queryType == 1)
      $AccessfileType = array('jpeg', 'jpg', 'png');
    else if($queryType == 2)
      $AccessfileType = array('pdf');
    else
      die("plase set queryType");
    
    

    $allTemp = array();
    $allPath = array();
    $imageNamesArray = array();
    $errorStatus = 0; 
    $errorCode = "";

    if(is_array($filesImage['name'])){
      $filesImage = count($filesImage['name']);

    }
    
    

    for($i = 0; $i < $filesImage; $i++){
      $path = $saveFolder;

      $img = $filesImage['name'][$i];
      $tmp = $filesImage['tmp_name'][$i];
      $maxSize = $filesImage['size'][$i];
      $ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
      

      if (empty($imageName)){
        $imgName = trim(str_replace(" ","-",date("His"))).rand(1000,9999).".".$ext;
      }else{
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
          $errorCode = "Resim maxSize Geçersiz";
          $errorStatus = 1;
          break;
        }
         
        }
        else{
          $errorCode = "izin verilmeyen dosya türü";
          $errorStatus = 1;
          break;

        }
        
    }
    if($errorStatus == 1){
      return array($errorCode." ".$errorStatus);
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
