<?php
session_start();
    // Database
    include("../../config.php");

    // If button is submit
    if(isset($_POST['replace'])) {
      

            // If input file is not empty
            if(!empty($_FILES['img']['name'])) {

                //FILES
                $name = $_FILES['img']['name'];

                // File Folder
                $target_dir = "../../images/";

                // File Location
                $target_file = $target_dir . basename($_FILES["img"]["name"]);
                $upload_location = $target_dir . $name;

                // Get the name og the uploader 
                $user = $_SESSION['name'];

                // Valid file extensions
                $extensions_arr = array("jpg","jpeg","png","gif");

                // Select file type
                $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

                // Convert to base64 
                    $image_base64 = base64_encode(file_get_contents($_FILES['img']['tmp_name']) );

                    $image = 'data:image/'.$imageFileType.';base64,'.$image_base64;

                // Check if File type is allowed
                if(in_array($imageFileType,$extensions_arr) ){ 

                      // Move the file in a folder
                      if(move_uploaded_file($_FILES['img']['tmp_name'],$upload_location)) { 
                        
                          // MT_KEEPER WATERMARK
                          if($_POST['image_upload'] == 'mt-keeper') {
                          
                            $watermark_image = imagecreatefrompng('../img/keeper-logo.png');

                            if($imageFileType == 'jpg' || $imageFileType == 'jpeg') {
                              $img = imagecreatefromjpeg($upload_location);
                            }

                            elseif($imageFileType == 'png') {
                              $img = imagecreatefrompng($upload_location);
                            }

                            $watermark_image_width = imagesx($watermark_image); 
                            $watermark_image_height = imagesy($watermark_image);  


                            imagecopy($img, $watermark_image, (imagesx($img) - $watermark_image_width) / 2, (imagesy($img) - $watermark_image_height) / 2, 0, 0, $watermark_image_width, $watermark_image_height); 

                            imagepng($img, $upload_location); 

                            imagedestroy($img);

                              // Insert record
                              if(file_exists($upload_location)) {

                              $query = "UPDATE images 
                                        SET image ='$name', image = '$image' 
                                        WHERE image ='$name' ";


                              mysqli_query($con,$query) or die(mysqli_error($con));
                                  
                              // Upload file
                              $_SESSION['replace_success'] = "";
                              header("Location:../../home.php?successfullyreplaced");
                              exit();


                              } else {
                                $_SESSION['replace_error'] = "";
                                header("Location:../../home.php?errorreplace");
                                exit();                            
                                }
                          } // END MT_KEEPER WATERMARK

                          // FREEWORLD WATERMARK
                          elseif($_POST['image_upload'] == 'freeworld') {
                           
                            $watermark_image = imagecreatefrompng('../img/freeworld-logo.png');

                            if($imageFileType == 'jpg' || $imageFileType == 'jpeg') {
                              $img = imagecreatefromjpeg($upload_location);
                            }

                            elseif($imageFileType == 'png') {
                              $img = imagecreatefrompng($upload_location);
                            }

                            $watermark_image_width = imagesx($watermark_image); 
                            $watermark_image_height = imagesy($watermark_image);  


                            imagecopy($img, $watermark_image, (imagesx($img) - $watermark_image_width) / 2, (imagesy($img) - $watermark_image_height) / 2, 0, 0, $watermark_image_width, $watermark_image_height); 

                            imagepng($img, $upload_location); 

                            imagedestroy($img);


                            // Insert record
                              if(file_exists($upload_location)) {

                              $query = "UPDATE images 
                                        SET image ='$name', image = '$image' 
                                        WHERE image ='$name' ";


                              mysqli_query($con,$query) or die(mysqli_error($con));
                                  
                              // Upload file
                              $_SESSION['replace_success'] = "";
                              header("Location:../../home.php?successfullyreplaced");
                              exit();


                              } else {
                                $_SESSION['replace_error'] = "";
                                header("Location:../../home.php?errorreplace");
                                exit();                            
                                }
                          } // END MT_KEEPER WATERMARK

                          // MT_AGORA WATERMARK
                          elseif($_POST['image_upload'] == 'agora') {
                          
                            $watermark_image = imagecreatefrompng('../img/mt-agora-logo.png');

                            if($imageFileType == 'jpg' || $imageFileType == 'jpeg') {
                              $img = imagecreatefromjpeg($upload_location);
                            }

                            elseif($imageFileType == 'png') {
                              $img = imagecreatefrompng($upload_location);
                            }

                            $watermark_image_width = imagesx($watermark_image); 
                            $watermark_image_height = imagesy($watermark_image);  


                            imagecopy($img, $watermark_image, (imagesx($img) - $watermark_image_width) / 2, (imagesy($img) - $watermark_image_height) / 2, 0, 0, $watermark_image_width, $watermark_image_height); 

                            imagepng($img, $upload_location); 

                            imagedestroy($img);


                            // Insert record
                              if(file_exists($upload_location)) {

                              $query = "UPDATE images 
                                        SET image ='$name', image = '$image' 
                                        WHERE image ='$name' ";


                              mysqli_query($con,$query) or die(mysqli_error($con));
                                  
                              // Upload file
                              $_SESSION['replace_success'] = "";
                              header("Location:../../home.php?successfullyreplaced");
                              exit();


                              } else {
                                $_SESSION['replace_error'] = "";
                                header("Location:../../home.php?errorreplace");
                                exit();                            
                                }
                          } // END MT_KEEPER WATERMARK

                          // TOTOROOM1 WATERMARK
                          elseif($_POST['image_upload'] == 'totoroom1') {
                          
                            $watermark_image = imagecreatefrompng('../img/totoroom-logo.png');

                            if($imageFileType == 'jpg' || $imageFileType == 'jpeg') {
                              $img = imagecreatefromjpeg($upload_location);
                            }

                            elseif($imageFileType == 'png') {
                              $img = imagecreatefrompng($upload_location);
                            }

                            $watermark_image_width = imagesx($watermark_image); 
                            $watermark_image_height = imagesy($watermark_image);  


                            imagecopy($img, $watermark_image, (imagesx($img) - $watermark_image_width) / 2, (imagesy($img) - $watermark_image_height) / 2, 0, 0, $watermark_image_width, $watermark_image_height); 

                            imagepng($img, $upload_location); 

                            imagedestroy($img);


                            // Insert record
                              if(file_exists($upload_location)) {

                              $query = "UPDATE images 
                                        SET image ='$name', image = '$image' 
                                        WHERE image ='$name' ";


                              mysqli_query($con,$query) or die(mysqli_error($con));
                                  
                              // Upload file
                              $_SESSION['replace_success'] = "";
                              header("Location:../../home.php?successfullyreplaced");
                              exit();


                              } else {
                                $_SESSION['replace_error'] = "";
                                header("Location:../../home.php?errorreplace");
                                exit();                            
                                }
                          } // END MT_KEEPER WATERMARK

                          // HUBL001 WATERMARK
                          elseif($_POST['image_upload'] == 'hubl001') {
                          
                            $watermark_image = imagecreatefrompng('../img/hubl001.png');

                            if($imageFileType == 'jpg' || $imageFileType == 'jpeg') {
                              $img = imagecreatefromjpeg($upload_location);
                            }

                            elseif($imageFileType == 'png') {
                              $img = imagecreatefrompng($upload_location);
                            }

                            $watermark_image_width = imagesx($watermark_image); 
                            $watermark_image_height = imagesy($watermark_image);  


                            imagecopy($img, $watermark_image, (imagesx($img) - $watermark_image_width) / 2, (imagesy($img) - $watermark_image_height) / 2, 0, 0, $watermark_image_width, $watermark_image_height); 

                            imagepng($img, $upload_location); 

                            imagedestroy($img);


                            // Insert record
                              if(file_exists($upload_location)) {

                              $query = "UPDATE images 
                                        SET image ='$name', image = '$image' 
                                        WHERE image ='$name' ";


                              mysqli_query($con,$query) or die(mysqli_error($con));
                                  
                              // Upload file
                              $_SESSION['replace_success'] = "";
                              header("Location:../../home.php?successfullyreplaced");
                              exit();


                              } else {
                                $_SESSION['replace_error'] = "";
                                header("Location:../../home.php?errorreplace");
                                exit();                            
                                }
                          } // END HUBL001 WATERMARK

                          // HUBL003 WATERMARK
                          elseif($_POST['image_upload'] == 'hubl003') {
                          
                            $watermark_image = imagecreatefrompng('../img/hubl003.png');

                            if($imageFileType == 'jpg' || $imageFileType == 'jpeg') {
                              $img = imagecreatefromjpeg($upload_location);
                            }

                            elseif($imageFileType == 'png') {
                              $img = imagecreatefrompng($upload_location);
                            }

                            $watermark_image_width = imagesx($watermark_image); 
                            $watermark_image_height = imagesy($watermark_image);  


                            imagecopy($img, $watermark_image, (imagesx($img) - $watermark_image_width) / 2, (imagesy($img) - $watermark_image_height) / 2, 0, 0, $watermark_image_width, $watermark_image_height); 

                            imagepng($img, $upload_location); 

                            imagedestroy($img);


                            // Insert record
                              if(file_exists($upload_location)) {

                              $query = "UPDATE images 
                                        SET image ='$name', image = '$image' 
                                        WHERE image ='$name' ";


                              mysqli_query($con,$query) or die(mysqli_error($con));
                                  
                              // Upload file
                              $_SESSION['replace_success'] = "";
                              header("Location:../../home.php?successfullyreplaced");
                              exit();


                              } else {
                                $_SESSION['replace_error'] = "";
                                header("Location:../../home.php?errorreplace");
                                exit();                            
                                }
                          } // END HUBL003 WATERMARK

                          // HUBL004 WATERMARK
                          elseif($_POST['image_upload'] == 'hubl004') {
                          
                            $watermark_image = imagecreatefrompng('../img/hubl004.png');

                            if($imageFileType == 'jpg' || $imageFileType == 'jpeg') {
                              $img = imagecreatefromjpeg($upload_location);
                            }

                            elseif($imageFileType == 'png') {
                              $img = imagecreatefrompng($upload_location);
                            }

                            $watermark_image_width = imagesx($watermark_image); 
                            $watermark_image_height = imagesy($watermark_image);  


                            imagecopy($img, $watermark_image, (imagesx($img) - $watermark_image_width) / 2, (imagesy($img) - $watermark_image_height) / 2, 0, 0, $watermark_image_width, $watermark_image_height); 

                            imagepng($img, $upload_location); 

                            imagedestroy($img);


                            // Insert record
                              if(file_exists($upload_location)) {

                              $query = "UPDATE images 
                                        SET image ='$name', image = '$image' 
                                        WHERE image ='$name' ";


                              mysqli_query($con,$query) or die(mysqli_error($con));
                                  
                              // Upload file
                              $_SESSION['replace_success'] = "";
                              header("Location:../../home.php?successfullyreplaced");
                              exit();


                              } else {
                                $_SESSION['replace_error'] = "";
                                header("Location:../../home.php?errorreplace");
                                exit();                            
                                }
                          } // END HUBL004 WATERMARK

                          // HUBL005 WATERMARK
                          elseif($_POST['image_upload'] == 'hubl005' ) {
                            $watermark_image = imagecreatefrompng('../img/hubl005.png');

                            if($imageFileType == 'jpg' || $imageFileType == 'jpeg') {
                              $img = imagecreatefromjpeg($upload_location);
                            }

                            elseif($imageFileType == 'png') {
                              $img = imagecreatefrompng($upload_location);
                            }

                            $watermark_image_width = imagesx($watermark_image); 
                            $watermark_image_height = imagesy($watermark_image);  


                            imagecopy($img, $watermark_image, (imagesx($img) - $watermark_image_width) / 2, (imagesy($img) - $watermark_image_height) / 2, 0, 0, $watermark_image_width, $watermark_image_height); 

                            imagepng($img, $upload_location); 

                            imagedestroy($img);


                            // Insert record
                              if(file_exists($upload_location)) {

                              $query = "UPDATE images 
                                        SET image ='$name', image = '$image' 
                                        WHERE image ='$name' ";


                              mysqli_query($con,$query) or die(mysqli_error($con));
                                  
                              // Upload file
                              $_SESSION['replace_success'] = "";
                              header("Location../../home.php?successfullyreplaced");
                              exit();


                              } else {
                                $_SESSION['replace_error'] = "";
                                header("Location../../home.php?errorreplace");
                                exit();                            
                                }
                          } // END HUBL005 WATERMARK

                          // MOAMOA1 WATERMARK
                          elseif($_POST['image_upload'] == 'moamoa1' ) {
                            $watermark_image = imagecreatefrompng('../img/moamoa1.png');

                            if($imageFileType == 'jpg' || $imageFileType == 'jpeg') {
                              $img = imagecreatefromjpeg($upload_location);
                            }

                            elseif($imageFileType == 'png') {
                              $img = imagecreatefrompng($upload_location);
                            }

                            $watermark_image_width = imagesx($watermark_image); 
                            $watermark_image_height = imagesy($watermark_image);  


                            imagecopy($img, $watermark_image, (imagesx($img) - $watermark_image_width) / 2, (imagesy($img) - $watermark_image_height) / 2, 0, 0, $watermark_image_width, $watermark_image_height); 

                            imagepng($img, $upload_location); 

                            imagedestroy($img);


                            // Insert record
                              if(file_exists($upload_location)) {

                              $query = "UPDATE images 
                                        SET image ='$name', image = '$image' 
                                        WHERE image ='$name' ";


                              mysqli_query($con,$query) or die(mysqli_error($con));
                                  
                              // Upload file
                              $_SESSION['replace_success'] = "";
                              header("Location:../../home.php?successfullyreplaced");
                              exit();


                              } else {
                                $_SESSION['replace_error'] = "";
                                header("Location:../../home.php?errorreplace");
                                exit();                            
                                }
                          } // END MOAMOA1 WATERMARK

                          // HUB-01 WATERMARK
                          elseif($_POST['image_upload'] == 'hub01net' ) {
                            $watermark_image = imagecreatefrompng('../img/hub01net.png');

                            if($imageFileType == 'jpg' || $imageFileType == 'jpeg') {
                              $img = imagecreatefromjpeg($upload_location);
                            }

                            elseif($imageFileType == 'png') {
                              $img = imagecreatefrompng($upload_location);
                            }

                            $watermark_image_width = imagesx($watermark_image); 
                            $watermark_image_height = imagesy($watermark_image);  


                            imagecopy($img, $watermark_image, (imagesx($img) - $watermark_image_width) / 2, (imagesy($img) - $watermark_image_height) / 2, 0, 0, $watermark_image_width, $watermark_image_height); 

                            imagepng($img, $upload_location); 

                            imagedestroy($img);


                            // Insert record
                              if(file_exists($upload_location)) {

                              $query = "UPDATE images 
                                        SET image ='$name', image = '$image' 
                                        WHERE image ='$name' ";


                              mysqli_query($con,$query) or die(mysqli_error($con));
                                  
                              // Upload file
                              $_SESSION['replace_success'] = "";
                              header("Location:../../home.php?successfullyreplaced");
                              exit();

                              } else {
                                $_SESSION['replace_error'] = "";
                                header("Location:../../home.php?errorreplace");
                                exit();                            
                                }
                          } // END HUB-01 WATERMARK

                          // NO WATERMARK
                          elseif($_POST['image_upload'] == 'none' ) {
                          
                            // Insert record
                              if(file_exists($upload_location)) {

                              $query = "UPDATE images 
                                        SET image ='$name', image = '$image' 
                                        WHERE image ='$name' ";


                              mysqli_query($con,$query) or die(mysqli_error($con));
                                  
                              // Upload file
                              $_SESSION['replace_success'] = "";
                              header("Location:../../home.php?successfullyreplaced");
                              exit();
                              
                              } else {
                                $_SESSION['replace_error'] = "";
                                header("Location:../../home.php?errorreplace");
                                exit();                            
                                }
                          } // END NO WATERMARK

                      } else {
                        $_SESSION['replace_moving_file'] = "";
                        header("Location:../../home.php?errorreplacemoving");
                        exit();
                      } //END MOVING THE FILE IN A FOLDER
                  
                } else {
                    $_SESSION['replace_not_img'] = "";
                    header("Location:../../home.php?errorreplacenotimg");
                    exit();
                } // END CHECKING IF FILE TYPE IS ALLOWED

            } else {
                $_SESSION['replace_empty'] = "";
                header("Location:../../home.php?errorreplaceempty");
                exit();
            } // END FOR INPUT FILE IS NOT EMPTY

    } //END FOR BUTTON IS SUBMIT


    
  ?>


  

