# summer2019-module2group-457104-466273

Jiwoo Seo 457104
Soohoon Oh 466273


File Sharing Server
    http://ec2-52-14-212-154.us-east-2.compute.amazonaws.com/~jiwooseo/login.php 


Login details
    you can either type in cytron, cole, sproull for the username,
    but you can also create your own username! (type in random username in login page to be directed to addUser page)


Creative Portion
  1) Users can add/create a new username
      When the user submits an invalid username, the user can create a new username.
      Users receive the error message when they attemp to use the already existing username.

  2) Users are redirected to the login page.
      When someone tries to jump into the server without login process (by manipulating URLs), they are redirected to the login page.

      suppose someone types in   <http://ec2-xxx-xxx/~jiwooseo/viewfile.php> to jump into the viewfile server.
        Then s/he is redirected to the login page.

  2-1) If you log out from one page, all the other pages on your internet windows are automatically logged-out.

  3) The date is shown on the top-right corner.