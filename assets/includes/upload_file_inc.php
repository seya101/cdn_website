    <?php 

    // If button is submit
    if(isset($_POST['but_upload'])) { 

        for ($i=0; $i < count($_FILES['file']['name']); $i++) {

            // If input file is not empty
            if(!empty($_FILES['file']['name'][$i])) {

                //FILES
                $name = $_FILES['file']['name'][$i];

                // File Folder
                $target_dir = "images/";

                // File Location
                $target_file = $target_dir . basename($_FILES["file"]["name"][$i]);
                $upload_location = $target_dir . $name;

                // Get the name og the uploader 
                $user = $_SESSION['name'];

                // Valid file extensions
                $extensions_arr = array("jpg","jpeg","png","gif");

                // Select file type
                $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

                // Convert to base64 
                    $image_base64 = base64_encode(file_get_contents($_FILES['file']['tmp_name'][$i]) );

                    $image = 'data:image/'.$imageFileType.';base64,'.$image_base64;

                // Check if File type is allowed
                if(in_array($imageFileType,$extensions_arr) ){ 
                  
                  // Check if the file is already exists
                  if(!file_exists($target_file)){ 

                      // Move the file in a folder
                      if(move_uploaded_file($_FILES['file']['tmp_name'][$i],$upload_location)) { 
                        
                          // MT_KEEPER WATERMARK
                          if($_POST['image_upload'] == 'mt-keeper') {
                          
                            $watermark_image = imagecreatefrompng('assets/img/keeper-logo.png');

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
                            $query = "INSERT INTO images(name,image,author,dateUploaded) VALUES ('".$name."','".$image."','".$user."',now())";
                            mysqli_query($con,$query) or die(mysqli_error($con));
                                
                            // Upload file
                            echo '
                                <script>
                                swal({
                                    title:"Success!",
                                    text: "Image(s) had been uploaded",
                                    icon: "success",
                                });
                                </script>
                              ';
                            } else {
                              echo '
                                  <script>
                                  swal({
                                      title:"Something Wrong!",
                                      text: "There is some error, try again",
                                      icon: "error",
                                  });
                                  </script>
                                ';
                            }
                          } // END MT_KEEPER WATERMARK

                          // FREEWORLD WATERMARK
                          elseif($_POST['image_upload'] == 'freeworld') {
                           
                            $watermark_image = imagecreatefrompng('assets/img/freeworld-logo.png');

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
                            $query = "INSERT INTO images(name,image,author,dateUploaded) VALUES ('".$name."','".$image."','".$user."',now())";
                            mysqli_query($con,$query) or die(mysqli_error($con));
                                
                            // Upload file
                            echo '
                                <script>
                                swal({
                                    title:"Success!",
                                    text: "Image(s) had been uploaded",
                                    icon: "success",
                                });
                                </script>
                              ';
                            } else {
                              echo '
                                  <script>
                                  swal({
                                      title:"Something Wrong!",
                                      text: "There is some error, try again",
                                      icon: "error",
                                  });
                                  </script>
                                ';
                            }
                          } // END MT_KEEPER WATERMARK

                          // MT_AGORA WATERMARK
                          elseif($_POST['image_upload'] == 'agora') {
                          
                            $watermark_image = imagecreatefrompng('assets/img/mt-agora-logo.png');

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
                            $query = "INSERT INTO images(name,image,author,dateUploaded) VALUES ('".$name."','".$image."','".$user."',now())";
                            mysqli_query($con,$query) or die(mysqli_error($con));
                                
                            // Upload file
                            echo '
                                <script>
                                swal({
                                    title:"Success!",
                                    text: "Image(s) had been uploaded",
                                    icon: "success",
                                });
                                </script>
                              ';
                            } else {
                              echo '
                                  <script>
                                  swal({
                                      title:"Something Wrong!",
                                      text: "There is some error, try again",
                                      icon: "error",
                                  });
                                  </script>
                                ';
                            }
                          } // END MT_KEEPER WATERMARK

                          // TOTOROOM1 WATERMARK
                          elseif($_POST['image_upload'] == 'totoroom1') {
                          
                            $watermark_image = imagecreatefrompng('assets/img/totoroom-logo.png');

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
                            $query = "INSERT INTO images(name,image,author,dateUploaded) VALUES ('".$name."','".$image."','".$user."',now())";
                            mysqli_query($con,$query) or die(mysqli_error($con));
                                
                            // Upload file
                            echo '
                                <script>
                                swal({
                                    title:"Success!",
                                    text: "Image(s) had been uploaded",
                                    icon: "success",
                                });
                                </script>
                              ';
                            } else {
                              echo '
                                  <script>
                                  swal({
                                      title:"Something Wrong!",
                                      text: "There is some error, try again",
                                      icon: "error",
                                  });
                                  </script>
                                ';
                            }
                          } // END MT_KEEPER WATERMARK

                          // HUBL001 WATERMARK
                          elseif($_POST['image_upload'] == 'hubl001') {
                          
                            $watermark_image = imagecreatefrompng('assets/img/hubl001.png');

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
                            $query = "INSERT INTO images(name,image,author,dateUploaded) VALUES ('".$name."','".$image."','".$user."',now())";
                            mysqli_query($con,$query) or die(mysqli_error($con));
                                
                            // Upload file
                            echo '
                                <script>
                                swal({
                                    title:"Success!",
                                    text: "Image(s) had been uploaded",
                                    icon: "success",
                                });
                                </script>
                              ';
                            } else {
                              echo '
                                  <script>
                                  swal({
                                      title:"Something Wrong!",
                                      text: "There is some error, try again",
                                      icon: "error",
                                  });
                                  </script>
                                ';
                            }
                          } // END HUBL001 WATERMARK

                          // HUBL003 WATERMARK
                          elseif($_POST['image_upload'] == 'hubl003') {
                          
                            $watermark_image = imagecreatefrompng('assets/img/hubl003.png');

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
                            $query = "INSERT INTO images(name,image,author,dateUploaded) VALUES ('".$name."','".$image."','".$user."',now())";
                            mysqli_query($con,$query) or die(mysqli_error($con));
                                
                            // Upload file
                            echo '
                                <script>
                                swal({
                                    title:"Success!",
                                    text: "Image(s) had been uploaded",
                                    icon: "success",
                                });
                                </script>
                              ';
                            } else {
                              echo '
                                  <script>
                                  swal({
                                      title:"Something Wrong!",
                                      text: "There is some error, try again",
                                      icon: "error",
                                  });
                                  </script>
                                ';
                            }
                          } // END HUBL003 WATERMARK

                          // HUBL004 WATERMARK
                          elseif($_POST['image_upload'] == 'hubl004') {
                          
                            $watermark_image = imagecreatefrompng('assets/img/hubl004.png');

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
                            $query = "INSERT INTO images(name,image,author,dateUploaded) VALUES ('".$name."','".$image."','".$user."',now())";
                            mysqli_query($con,$query) or die(mysqli_error($con));
                                
                            // Upload file
                            echo '
                                <script>
                                swal({
                                    title:"Success!",
                                    text: "Image(s) had been uploaded",
                                    icon: "success",
                                });
                                </script>
                              ';
                            } else {
                              echo '
                                  <script>
                                  swal({
                                      title:"Something Wrong!",
                                      text: "There is some error, try again",
                                      icon: "error",
                                  });
                                  </script>
                                ';
                            }
                          } // END HUBL004 WATERMARK

                          // HUBL005 WATERMARK
                          elseif($_POST['image_upload'] == 'hubl005' ) {
                            $watermark_image = imagecreatefrompng('assets/img/hubl005.png');

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
                            $query = "INSERT INTO images(name,image,author,dateUploaded) VALUES ('".$name."','".$image."','".$user."',now())";
                            mysqli_query($con,$query) or die(mysqli_error($con));
                                
                            // Upload file
                            echo '
                                <script>
                                swal({
                                    title:"Success!",
                                    text: "Image(s) had been uploaded",
                                    icon: "success",
                                });
                                </script>
                              ';
                            } else {
                              echo '
                                  <script>
                                  swal({
                                      title:"Something Wrong!",
                                      text: "There is some error, try again",
                                      icon: "error",
                                  });
                                  </script>
                                ';
                            }
                          } // END HUBL005 WATERMARK

                          // MOAMOA1 WATERMARK
                          elseif($_POST['image_upload'] == 'moamoa1' ) {
                            $watermark_image = imagecreatefrompng('assets/img/moamoa1.png');

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
                            $query = "INSERT INTO images(name,image,author,dateUploaded) VALUES ('".$name."','".$image."','".$user."',now())";
                            mysqli_query($con,$query) or die(mysqli_error($con));
                                
                            // Upload file
                            echo '
                                <script>
                                swal({
                                    title:"Success!",
                                    text: "Image(s) had been uploaded",
                                    icon: "success",
                                });
                                </script>
                              ';
                            } else {
                              echo '
                                  <script>
                                  swal({
                                      title:"Something Wrong!",
                                      text: "There is some error, try again",
                                      icon: "error",
                                  });
                                  </script>
                                ';
                            }
                          } // END MOAMOA1 WATERMARK

                          // HUB-01 WATERMARK
                          elseif($_POST['image_upload'] == 'hub01net' ) {
                            $watermark_image = imagecreatefrompng('assets/img/hub01net.png');

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
                            $query = "INSERT INTO images(name,image,author,dateUploaded) VALUES ('".$name."','".$image."','".$user."',now())";
                            mysqli_query($con,$query) or die(mysqli_error($con));
                                
                            // Upload file
                            echo '
                                <script>
                                swal({
                                    title:"Success!",
                                    text: "Image(s) had been uploaded",
                                    icon: "success",
                                });
                                </script>
                              ';
                            } else {
                              echo '
                                  <script>
                                  swal({
                                      title:"Something Wrong!",
                                      text: "There is some error, try again",
                                      icon: "error",
                                  });
                                  </script>
                                ';
                            }
                          } // END HUB-01 WATERMARK

                          // NO WATERMARK
                          elseif($_POST['image_upload'] == 'none' ) {
                          
                            // Insert record
                            if(file_exists($upload_location)) {
                            $query = "INSERT INTO images(name,image,author,dateUploaded) VALUES ('".$name."','".$image."','".$user."',now())";
                            mysqli_query($con,$query) or die(mysqli_error($con));
                                
                            // Upload file
                            echo '
                                <script>
                                swal({
                                    title:"Success!",
                                    text: "Image(s) has been uploaded",
                                    icon: "success",
                                });
                                </script>
                              ';
                            } else {
                              echo '
                                  <script>
                                  swal({
                                      title:"Something Wrong!",
                                      text: "There is some error, try again",
                                      icon: "error",
                                  });
                                  </script>
                                ';
                            }
                          } // END NO WATERMARK

                      } else {
                        echo '
                            <script>
                            swal({
                                title:"Something Wrong!",
                                text: "Please ask for developer assistance",
                                icon: "error",
                            });
                            </script>
                          ';
                      } //END MOVING THE FILE IN A FOLDER

                  } else {
                     echo '
                        <div role="alert" class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                        <span><strong>Oopss! File already exists... </strong></span>
                        <button type="button" class="btn btn-info" href="#btnReplace" data-toggle="modal">Replace</button>
                        <button type="button" class="btn btn-danger" data-dismiss="alert" aria-label="Close" >Cancel</button>
                        </div>

                        
                        ';
                    } //END CHECK IF FILE ALREADY EXISTS
                  
                } else {
                    echo '
                        <script>
                        swal({
                            title:"Opss!",
                            text: "Only .jpg/jpeg, .png and gif image file allowed to upload",
                            icon: "error",
                        });
                        </script>
                      ';
                } // END CHECKING IF FILE TYPE IS ALLOWED

            } else {
                echo '
                    <script>
                    swal({
                        title:"Opss!",
                        text: "Please select Image",
                        icon: "error",
                    });
                    </script>
                  ';
            } // END FOR INPUT FILE IS NOT EMPTY
        } //END FOR LOOP
        

    } //END FOR BUTTON IS SUBMIT

    ?>

  


  

