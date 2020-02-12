<!DOCTYPE HTML>
<html lang=en>

<head>
  <title> logout </title>
  <style>
    body {
      background-color: rgb(146, 168, 209);
      font-size: 1em;
      color: rgb(245, 195, 194);
      font-weight: bolder;
    }

    h1 {
      text-align: right;

    }

    p {

      font-size: 3em;
      align-items: center;
      display: flex;
      flex-direction: column;
      text-align: center;
    }
  </style>
</head>

<body>
  <?php
  session_start();
  //if someone tries to access without logging-in, it redirects to the login page
  if ($_SESSION['session'] != true) {
    header("Location: login.php");
  }
  //if the user submits 'logout' button,
  //the session is destroyed and the user cannot go back to the pages (such as viewfile, uploader ..) unless s/he login again.
  if (isset($_POST['logout'])) {
    session_unset();
    $_SESSION['session'] = false;
    session_destroy();
    header("Location: login.php");
    exit;
  }



  ?>
  <h1>
    <?php echo date("F  j  Y");
    echo "<br>";
    echo date('l'); ?> </h1>
  <form action="logout.php" method="post">
    <br>
    <p>
      Are you sure?
      <input name="logout" type="submit" value="Log out"> </p>
  </form>

</body>

</html>