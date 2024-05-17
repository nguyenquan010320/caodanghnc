<?php

if(isset($_FILES['file']['name'])){

   /* Getting file name */
   $filename = $_FILES['file']['name'];

   /* Location */
   $location = "fileupload/".$filename;
   $imageFileType = pathinfo($location,PATHINFO_EXTENSION);
   $imageFileType = strtolower($imageFileType);

   $randomLocation = "fileupload/".date('YmdHis').substr(str_shuffle(str_repeat($x='ABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(10/strlen($x)) )),1,10).'.'.$imageFileType;

   /* Valid extensions */
   $valid_extensions = array("jpg","jpeg","jpe","jif","jfif","jfi","png","gif","webp","tiff","tif","psd","bmp","dib","heif","heic","ind","indd","indt","jp2","j2k","jpf","jpx","jpm","mj2","svg","svgz","pdf","doc","docx","xls","xlsx","ppt","pptx");

   $response = 0;
   /* Check file extension */
   if(in_array(strtolower($imageFileType), $valid_extensions)) {
      /* Upload file */
      // if(move_uploaded_file($_FILES['file']['tmp_name'],$location)){
      if(move_uploaded_file($_FILES['file']['tmp_name'],$randomLocation)){
         $response = $randomLocation;
      }
   }

   echo $response;
   exit;
}

echo 0;