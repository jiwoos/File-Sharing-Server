<!DOCTYPE HTML>
<html lang=en>

<head>
    <title> adding user process </title>
    <style>
        body {
            background-color: rgb(245, 195, 194);
            display: flex;
            flex-direction: column;
            color: rgb(146, 168, 209);
            font-weight: bolder;
            text-align: center;
        }

        p {
            font-size: 2.5em;
            text-align: center;

        }

        h1 {
            text-align: right;
            font-size: 2em;
            font-weight: bolder;
        }
    </style>
</head>

<body>
    <h1>
        <?php
        //setting up the timezone on the upper right corner
        date_default_timezone_set("America/Chicago");
        echo date("F  j  Y");
        echo "<br>";
        echo date('l');
        ?> </h1>
    <?php
    session_start();
    //if someone tries to access by manipulating URL, s/he is redirected to the login page
    if ($_SESSION['add'] != true) {
        header("Location: login.php");
    }

    //a user has to type in a unique username to create one.
    if (isset($_POST['addUser'])) {
        $filePath = sprintf("/srv/uploads/%s", htmlentities($_POST['new']));

        //if the new username already exists, the error message pops up
        if (file_exists($filePath)) {
            echo "the username  ♬ " . htmlentities($_POST['new']) . " ♬ already exists";
        }
         //it adds the new username to the users.txt file
        if (!file_exists($filePath)) {
            $userFile = fopen("/srv/users.txt", "a");
            $txt = htmlentities($_POST["new"]);
            fwrite($userFile, "\n" . $txt);
            $filePath = "/srv/uploads/$txt";

            //make a new directory in srv/uploads 
            mkdir($filePath, 0700);

            fclose($userFile);
            header("Location: login.php");
        }
    }
    //the button that redirects to the login page in case the user wants to try login again
    if (isset($_POST["login"])) {
        header("Location: login.php");
    }
    ?>



    <form action="addingUserPro.php" method="post">
        <p>
            Type in new username: <br>
            <input name="new" type="text">
            <input name="addUser" type="submit" value="Add"> <br> <br>
            <input name="login" type="submit" value="Go back to the login page">
    </form>
</body>

</html>