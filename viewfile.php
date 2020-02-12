<!doctype html>
<html lang=en>

<head>
  <title> view file </title>
  <style>
    body {
      background-color: rgb(146, 168, 209);
      margin: 8px;
    }

    h1 {
      text-align: center;
      color: rgb(245, 195, 194);
      display: flex;
      align-items: center;
      flex-direction: column;
    }

    div {
      width: 300px;
      border: 15px solid white;
      margin: 20px;
      display: flex;
      align-items: center;
      flex-direction: column;
      margin: auto;

    }

    p {
      text-align: right;
      font-size: 2em;
      color: rgb(245, 195, 194);
      font-weight: bolder;
      display: block;
    }

    h2 {
      align-items: center;
      text-align: center;
      font-weight: lighter;
      color: dimgray;
      font-size: 1em;
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
    echo date('l');  ?> </p>

  <div>
    <h1> View Shared Files </h1>
  </div>

  <form action="viewfile.php" method="post">
    <h2>
      <?php
      //if someone tries to access without logging-in, it redirects to the login page
      if ($_SESSION['session'] != true) {
        header("Location: login.php");
      }
      //a button that directs to the uploading page.
      if (isset($_POST["upload"])) {
        header("Location: uploader.php");
      }
      //a button that directs to the logout page.
      if (isset($_POST["logout"])) {
        header("Location: logout.php");
      }
      //it shows the list of files that is stored in the user's directory.
      //$input is the username
      $input = $_SESSION['input'];
      $path = "/srv/uploads/$input";
      $handle = opendir("/srv/uploads/$input");
      echo "Here is the list of files of  ♬" . $input . " ♬"; ?> 

   
      <?php
      //code continued from above (seperated to change the color/size of the font)
      if ($handle) {
        while (($entry = readdir($handle)) !== false) {
          if ($entry != '.' && $entry != '..') {
            $_SESSION['entry'] = $entry;
            echo "</br>";
            echo "<a href='viewer.php?filename=$entry'>$entry</a>";
          }
        }
        closedir($handle);
      }
      //$submit1 is to view file. users have to copy & paste the name of the files into the text box.
      if (isset($_POST["submit1"])) {
        //if the user types nothing in, it redirects to the current page.
        $validity = htmlentities($_POST['file']);
        if ($validity == "") {
          header("Location: viewfile.php");
          exit;
        }


        $filePath = sprintf("/srv/uploads/%s/%s", $input, htmlentities($_POST['file']));
        //the user is directed to the viewer.php where s/he can see files.
        if (file_exists($filePath)) {
          $file = htmlentities($_POST['file']);
          $_SESSION['filename'] = $file;
          header("Location: viewer.php");
          exit;
        }
        //if the file does not exist, the error message pops up.
        else if (!file_exists($filePath)) {
          echo "<br>";
          echo "<br>";
          echo "<br>";
          echo "<br>";
          echo "<br>";
          echo "♨the file could not be found -- display failed♨";
        }
      }




      //delete
      if (isset($_POST["submit2"])) {
        $filePath = sprintf("/srv/uploads/%s/%s", $input, htmlentities($_POST['file']));
        echo "<br>";
        echo "<br>";
        echo "<br>";
        echo "<br>";
        echo "<br>";
        //if the file that the user intends to delete does not exist, the error message pops up.
        if (!file_exists($filePath)) {
          echo "♨the file could not be found-- deletion failed♨";
        }
        //if it exists, the file is deleted from the directory and the list of the files.
        //the user is redirected to the current page and can see that the file no longer exists on their list.
        if (file_exists($filePath)) {
          $fileName = htmlentities($_POST['file']);
          unlink($filePath);
          header('Location: viewfile.php');
        }
      }

      ?>
      <br> <br>
      <input name="file" type="text" placeholder="copy & paste the name of the file" maxlength="80" size="100">
      <input name="submit1" type="submit" value="view">
      <input name="submit2" type="submit" value="delete">

      <br> <br> <br> <br> <br>
      <input name="upload" type="submit" value="upload files">
      <input name="logout" type="submit" value="Log out">
    </h2>
  </form>
</body>


</html>