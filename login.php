<!DOCTYPE HTML>
<html lang=en>

<head>
    <title> file share </title>
    <style>
        h1 {
            text-align: center;
            font-size: 3em;
            color: rgb(146, 168, 209);
        }

        body {
            background-color: rgb(245, 195, 194);
            display: flex;
            flex-direction: column;
            text-align: center;
            color: rgb(146, 168, 209);
        }

        form {
            margin: auto;
        }

        div {
            width: 300px;
            border: 15px solid white;
            padding: 50px;
            margin: 20px;
        }

        p {

            text-align: right;
            font-size: 2em;
            font-weight: bolder;
        }
    </style>
</head>

<body>
    <p>
        <?php
        //setting up the time zone on the upper right corner
        date_default_timezone_set("America/Chicago");
        echo date("F  j  Y");
        echo "<br>";
        echo date('l');
        ?> </p>

    <h1> File Sharing </h1>
    <?php
    session_start();
        // the session starts - it will continue until the user submits the logout button.
    echo "\r\n";
    
    //when the user types in his/her username, -
    if (isset($_POST['login'])) {
        $_SESSION['input'] = htmlentities( $_POST['input']);
        $input = $_SESSION['input'];
        $userFile = fopen("/srv/users.txt", "r");
        $match = false;

        //if the user types nothing and submits the login button,
        //s/he is redirected to the current page.
        $validity = $_POST['input'];
        if ($validity == "") {
            header("Location: login.php");
            exit;
        }
        //the input is compared with the list of usernames that is listed in /srv/users.txt
        //if the input matches with one of the usernames in txt file,
        //the user is directed to the viewfile.php
        while (!feof($userFile)) {
            $name = (fgets($userFile));
            if (trim($name) == $input) {
                $match = true;
                $_SESSION['input'] = $input;
                $_SESSION['session'] = true;
                header("Location: viewfile.php");
                fclose($userFile);
                exit;
            }
        }

        //if nothing matches (input is not in users.txt),
        //users are directed to a page where they can create a new username.
        if ($match == false) {
            $_SESSION['add'] = true;
            header("Location:addUser.php");
        }

        //users can delete his/her account by submitting the button 'deactivate'
        //users are directed to a page where they can delete their username.
        
    }
    if (isset($_POST['deactivate'])) {
        $_SESSION['deactivate'] = true;
        header("Location: deleteUser.php");
    }



    ?>




    <form action="login.php" method="post">
        <div><input name="input" type="text" placeholder="enter username">
            <input name="login" type="submit" value="Log In"> </div>
            <input name="deactivate" type="submit" value="Deactivate your account">
    </form>

</body>

</html>