<!doctype html>
<html lang=en>

<head>
  <title> Uploader </title>
  <style>
    form {
      text-align: center;

    }

    body {
      background-color: rgb(245, 195, 194);
      display: flex;

      flex-direction: column;
      font-size: 1.5em;
      color: rgb(146, 168, 209);
      font-weight: bolder;
      margin: 8px;
    }

    div {
      text-align: center;
      align-items: center;
      width: 400px;
      border: 15px solid white;
      padding: 50px;
      margin: auto;

    }

    p {
      display: block;
      font-size: 1.33em;
      text-align: right;
      font-weight: bolder;
      color: rgb(146, 168, 209);
    }
  </style>
</head>

<body>
  <p>
    <?php
    session_start();
    //setting up the timezone on the upper right corner
    date_default_timezone_set("America/Chicago");
    echo date("F  j  Y");
    echo "<br>";
    echo date('l');

    ?> </p>
  <form>
    <?php
    //if someone tries to access without logging-in, it redirects to the login page
    if ($_SESSION['session'] != true) {
      header("Location: login.php");
    }

    //when 'upload files' button is submitted - (the explanation continues below)
    if (isset($_POST["upload"])) {
      $input = $_SESSION['input'];
      $target_dir = "/srv/uploads/$input/";
      $target_file = $target_dir . $_FILES["uploadedFile"]["name"];
      //the upload fails when the size of the file is bigger the 500000 bytes . the user is redirected to sizefail.php 
      if ($_FILES["uploadedFile"]['size'] > 500000) {
        header("Location: sizefail.php");
      }
      //if the file already exists, the error message pops up
      if (file_exists($target_file)) {
        echo "Sorry, the file already exists.";
      } 
      //if the file is small enough to be uploaded, and it is unique from already uplaoded files,
      // it is uploaded in their own directory.
      // the user is redirected to the viewfile.php and s/he can see the uploaded files under the file list.
      else if (move_uploaded_file($_FILES["uploadedFile"]["tmp_name"], $target_file)) {
        header("Location: viewfile.php");
        exit;
      } else {
        echo "Try again";
      }
    }

    //button that redirects to the viewfile.php
    if (isset($_POST["viewfile"])) {
      header("Location: viewfile.php");
    }
    //button that directs to the logout.php
    if (isset($_POST["logout"])) {
      header("Location: logout.php");
    }
    ?> </form>

  <form enctype="multipart/form-data" action="uploader.php" method="POST">
    <div>
      <label for="uploadedFile">Choose a file to upload</label> <input name="uploadedFile" type="file" id="uploadedFile" />

      <input name="upload" type="submit" value="Click here to upload" />
    </div>
  </form>
  <form action="uploader.php" method="POST">
    <input name="viewfile" type="submit" value="go back to the File Lists">
    <input name="logout" type="submit" value="Log out">
  </form>
</body>

</html>