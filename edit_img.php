<?php

    // We need to use sessions, so you should always start sessions using the below code.
    session_start();
    
    // If the user is not logged in redirect to the login page...

    if (!isset($_SESSION['loggedin'])) {

        header('Location:index.php');

        exit;

    }

    // Database

    include("config.php");



    // Table for Image Information
    require 'tables/image_table.php';
    $img_name = $_SESSION['img_name'];
    $img_title  = $_SESSION['title'];
    $img_description  = $_SESSION['description'];
    $img_author  = $_SESSION['author'];
    $img_date  = $_SESSION['dateUploaded'];

?>

<!DOCTYPE html>

<html lang="ko">

<head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>CDN: Edit Image</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.0/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <link href="css/style.css" rel="stylesheet" type="text/css">

</head>

<body style="margin:auto;background-color: #DCDCDC;">

    <?php 

       //NAV
       require "assets/template-parts/nav.php";

       // Upload Function
       include "assets/includes/edit_img_inc.php";      

    ?>

    <div class="container" style="margin-top:80px;">

        <div class="card shadow mb-5 bg-white rounded" style="padding: 30px;">

            <h4 class="card-title"><i class="fas fa-pencil-alt"></i>&nbsp;Edit Image</h4>
            <hr>

        <form method="POST" enctype="multipart/form-data">

            <!-- Row -->
            <div class="row ">

                <!-- Image Col -->
                <div class="col-md-6 align-self-center">

                    <img class="img-fluid mx-auto d-block" src="images/<?php echo $img_name; ?>">

                </div>

                <!-- Information Col -->
                <div class="col-md-6">

                    <div class="row">
                        <!-- Image Name -->
                        <div class="col-12">

                            <h6>Image Name&nbsp;<span style="font-size:9px;">(Not editable)</span>:</h6>

                        </div>

                        <div class="col-12">

                            <input name="img_name" type="text" disabled="" readonly="" style="width:100%;" value="<?php echo $img_name; ?>">

                        </div>

                        <div class="col-6">
                            Uploaded by:
                            <input type="text" disabled="" readonly="" style="width:100%;" value="<?php echo $img_author; ?>">

                        </div>
                        <div class="col-6">
                            Date/Time Uploaded:
                            <input type="text" disabled="" readonly="" style="width:100%;" value="<?php echo $img_date; ?>">

                        </div>

                        <!-- Image Title -->
                        <div class="col-12" style="margin-top: 10px;">

                            <h6>Title&nbsp;<span style="font-size:9px;">(Optional)</span>:</h6>

                        </div>

                        <div class="col-12">

                            <input placeholder="Write something here..." value="<?php echo $img_title; ?>" type="text" name="title" style="width:100%;">

                        </div>

                        <!-- Image Description -->
                        <div class="col">

                            <h6>Description&nbsp;<span style="font-size:9px;">(Optional)</span>:</h6>

                        </div>

                        <div class="col-12">

                            <textarea placeholder="Write something here..." name="description" style="width:100%;height:200px;"><?php echo $img_description; ?></textarea>

                        </div>

                        <!-- Replace Image -->
                        <!-- <div class="col">

                            <h6 style="margin-top:24px;">Replace Image&nbsp;<span style="font-size:9px;">(Optional)</span>:</h6>

                        </div>

                        <div class="col-12">

                             <input id="file" type="file" name="file" multiple accept=".jpg, .png, .gif" style="width:100%;border:1px solid;margin:10px 0px;">

                        </div>

                        <div class="col-12">

                              <select name="image_upload" style="width:100%;border: 1px solid;padding: 5px;">

                              <optgroup label="Select site watermark">

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

                              </optgroup>

                            </select>

                        </div> -->

                        <!-- Update Information -->
                        <div class="col-12">

                            <input type="submit" name="edit_upload" value="Update" class="btn btn-secondary btn-block font-weight-bold" style="margin:5px 0px;"/>

                        </div>

                        <!-- Back Btn -->
                        <div class="col-12">

                            <a href="home.php" class="btn btn-danger btn-block text-white font-weight-bold" type="button" style="margin:5px 0px;">Back</a>

                        </div>
                    </div>

                </div>

            </div>

        </form>
        
    </div>

    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.0/js/bootstrap.bundle.min.js"></script>

</body>

</html>