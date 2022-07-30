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

    // Table for users Information
    require 'tables/account_table.php';

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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.0/css/bootstrap.min.css">
        

        <!-- Script -->
        <script src="js/jquery.js"></script>

        <script src="js/loading.js"></script>

        <script src="js/search.js"></script> 

        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


</head>

<body class="loggedin">

   
   <?php 
      //NAV
      require "assets/template-parts/nav.php";

      // Replace success/error message
      include "assets/includes/replace_msg_inc.php";

      // Upload Function
      include "assets/includes/upload_file_inc.php";

      //Modal for replace uploaded img 
      include "assets/modals/modal_replace.php";

   ?>


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

              <option value="hubl001">Hubl001</option>

              <option value="hubl003">Hubl003</option>

              <option value="hubl004">Hubl004</option>

              <option value="hubl005">Hubl005</option>

              <option value="moamoa1">Moamoa1</option>

              <option value="hub01net">Hub-01</option>

            </select>

          <input type="submit" name="but_upload" id="insert" value="Upload" class="btn btn-secondary font-weight-bold" />

        </form>

      </div>

    </div>
    <!-- End Upload Image --> 

    <!-- Note Card -->
    <div class="container">

      <div class="card shadow bg-white rounded">

        <div class="card-body">

          <div class="table-responsive">

              <table class="table">

                  <thead>

                      <tr>

                          <th colspan="2" class="card-subtitle mb-2 text-danger">Note:</th>

                      </tr>

                  </thead>

                  <tbody>

                      <tr>

                          <td>

                              <ul>

                                <li style="font-size: 12px;">Maximum Multiple Upload: 20 images</li>

                                <li style="font-size: 12px;">GIF files are not allowed to have watermark</li>

                                <li style="font-size: 12px;">Click image if you want to edit</li>

                              </ul>

                          </td>

                          <td>

                              <ul>

                                <li style="font-size: 12px;">Cannot multiple replace images</li>

                                <li style="font-size: 12px;">After replacing an image, it takes several seconds to see the updated image</li>

                                <li style="font-size: 12px;">When searching, type the specific name of the image </li>

                              </ul>

                          </td>

                      </tr>

                  </tbody>

              </table>

          </div>

        </div>

      </div>

    </div>


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

    



    <!-- Script -->

    <script src="js/jquery.js"></script>

    <script src="js/search.js"></script>   

    <script>

        if ( window.history.replaceState ) {

            window.history.replaceState( null, null, window.location.href );

        }

    </script>

    <script type="text/javascript">
      $("#btnReplace").click(function() {
        $("#modal-confirm").modal();
      });
    </script>

    <!-- BOOTSTRAP & JQUERY JS CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.0/js/bootstrap.bundle.min.js"></script>

    

</body>

</html>
