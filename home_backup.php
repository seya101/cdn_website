<?php

    // We need to use sessions, so you should always start sessions using the below code.

    session_start();

    // If the user is not logged in redirect to the login page...

    if (!isset($_SESSION['loggedin'])) {

        header('Location: index.php');

        exit;

    }



    // Database

    include("config.php");

?>

<!DOCTYPE html>

<html lang="ko">

<head>

    <meta charset="utf-8">

        <title>Home</title>

        <!-- Style -->

        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">

        <link href="css/style.css" rel="stylesheet" type="text/css">

        <!-- Bootstrap CDN-->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
        

        <!-- Script -->
        <script src="js/jquery.js"></script>

        <script src="js/loading.js"></script>

        <script src="js/search.js"></script> 

        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


</head>

<body class="loggedin">

   <!-- NAV -->
   <?php 
       require "assets/template-parts/nav.php";
   ?>

<!------------------------------------------------------------------------------------------------------->

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
                        //Check if image file corrupted
                        if (!imagecreatefromjpeg($upload_location) == true) {
                                  echo '
                                      <script>
                                      swal({
                                          title:"Image is corrupted!",
                                          text: "Please resave the image again then reupload.",
                                          icon: "error",
                                      });
                                      </script>
                                    ';

                        } else {

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
                        } //END CHECKING IF IMAGE FILE CORRUPTED
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
                          <script>

                           swal({
                             title: "Image already exists!",
                             text: "Do you want to replace? Once replace, you will not be able to recover this image file!",
                             icon: "warning",
                             buttons: true,
                             dangerMode: true,
                           })
                           .then((replace) => {
                             if (replace) {
                               swal("This Function is Underdeveloped! :) ");
                             } else {
                               swal("Your image file is safe!");
                             }
                           });
                          </script>
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


    // function replace() {
    //   // Insert record
    //     $query = "UPDATE images 
    //               SET     name = ='$name', image = '$image', author = '$user'
    //               WHERE  name = '$name'";

    //     mysqli_query($con,$query) or die(mysqli_error($con));
    //   }

    ?>

 <!---------------------------------------------------------------------------------------------------------->   



    <!-- Upload Image --> 

    <div class="btn-container">

      <div class="btn-vertical-center form-container">

        <form method="POST" enctype="multipart/form-data">

          <input id="file" type="file" name="file[]" multiple accept=".jpg, .png, .gif" />
           
            <select class="watermark-select"  name="image_upload" required="">

              <option value="">Select site watermark</option>

              <option value="none">None</option>

              <option value="mt-keeper">Mt-Keeper</option>

              <option value="freeworld">Freeworld</option>

              <option value="agora">Mt-Agora</option>

              <option value="totoroom1">Totoroom1</option>

              <option value="hubl003">Hubl003</option>

              <option value="hubl004">Hubl004</option>

              <option value="hubl005">Hubl005</option>

            </select>

          <input type="submit" name="but_upload" id="insert" value="Upload" class="btn btn-secondary font-weight-bold" />

        </form>

      </div>

    </div>
    <!-- End Upload Image --> 

    <!-- Note Card -->
    <div class="container">

      <div class="card shadow p-3 mb-5 bg-white rounded">

        <div class="card-body">

          <h6 class="card-subtitle mb-2 text-danger">Note:</h6>

          <li style="font-size: 12px;">Maximum Multiple Upload: 20 images</li>

          <li style="font-size: 12px;">GIF files are not allowed to have watermark</li>

        </div>

      </div>

    </div>
    <!-- End Note Card -->


     <!-- Search --> 
     
    <div class="btn-container">

        <input type="text" name="search_text" id="search_text" placeholder="Search" class="btn-vertical-center" style="border-radius: 20px;padding: 15px;width:50%;border:none;" />

    </div>
    

    <!-- Page Content -->

    <div class="cdn-images">

        <!-- Clipboard Script -->
        <script src="js/clipboard.js"></script>

        <script> new ClipboardJS('button') </script>

        
        <div id="result"></div>

        <div id="load_data"></div>

        <div id="load_data_message"></div>


    </div>

    <!-- MODAL -->
    <div id="modal-confirm" class="modal">

         <div class="modal-dialog">

           <div class="modal-content">

             <div class="modal-header">

                 <a href="#" data-dismiss="modal" aria-hidden="true" class="close">×</a>

                  <h3>Are you sure?</h3>

             </div>

             <div class="modal-body">

                  <p>You will <b>NOT</b> be able to retrieve this image.</p>

             </div>

             <div class="modal-footer">

               <a href="#" id="btnYes" class="btn confirm">Yes</a>

               <a href="#" data-dismiss="modal" aria-hidden="true" class="btn secondary">No</a>

             </div>

           </div>

         </div>

    </div>



    <!-- Script -->

    <script src="js/jquery.js"></script>

    <script src="js/search.js"></script>   

    <script>

        if ( window.history.replaceState ) {

            window.history.replaceState( null, null, window.location.href );

        }

    </script>

    <!-- BOOTSTRAP JS CDN -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    

</body>

</html>
