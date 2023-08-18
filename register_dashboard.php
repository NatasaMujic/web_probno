
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <script src="https://smtpjs.com/v3/smtp.js"></script>
    <link href="style.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <title>Register dashboard</title>
    <style>
        *{
            font-family: 'Montserrat', sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;

        }
      body{
          min-height: 100vh;
          overflow-x: hidden;
      }
        .content {
            display: none;
        }

      .yourEvents{
          position: relative;
          width: 70%;
          float:right;
          margin-top: 40px;
          margin-right: 40px;
      }


        .container-fluid {
            padding-right: 0;
            padding-left: 0;
        }

             .recentEvents{
                 display: grid;
                 grid-gap: 30px;
                 margin-top: 10px;
                 min-height: 500px;
                 padding: 20px;
                 box-shadow: 0 7px 25px rgba(0,0,0,0.8);
                 border-radius: 20px;

             }
             .recentEvents table thead{
                 font-size: 20px;
                 font-weight: 600;
             }
             .recentEvents table tr{
                 border-bottom: 1px solid rgba(0,0,0,0.1);
             }


    </style>
</head>
<div>

<?php
require("db_functions.php");

session_start();

if (!isset($_SESSION['user_id'])) {
    //redirection on the login page if the user is not logged in
    header("Location: login.php");
    exit();
}
else{
    $username = $_SESSION['firstName'] . " " . $_SESSION['lastName'];
}
?>

<div class="container-fluid">
    <div class="navigation">
        <ul>
            <li>
                <a href="#" class="link" data-target="content1">
                    <span class="title"><?php echo $username ?></span>
                </a>
            </li>
            <li>
                <a href="#" class="link" data-target="content2">
                    <span class="title">Create New Event</span>
                </a>
            </li>
            <li>
                <a href="#" class="link" data-target="content3">
                    <span class="title">Active Events</span>
                </a>
            </li>
            <li>
                <a href="#" class="link" data-target="content4">
                    <span class="title">Archived Events</span>
                </a>
            </li>
            <li>
                <a href="#" class="link" data-target="content5">
                    <span class="title">Your Account</span>
                </a>
            </li>
            <li>
                <a href='logout.php' class="link" data-target='content6'>
                    <span class='title'>Sign out</span>
                </a>
            </li>
        </ul>
    </div>
</div>

    <div id="content1" class="content">
        <h1>Welcome registered user!</h1>
        <?php
        $username = $_SESSION['firstName'];
        echo "Welcome back, $username!";
        ?>
    </div>

    <div id="content2" class="content">
        <div class="yourEvents">
            <?php

            if (isset($_POST['eventName']) && isset($_POST['image']) && isset($_POST['shortText']) && isset($_POST['eventAddress']) && isset($_POST['eventCity']) && isset($_POST['eventState']) && isset($_POST['eventDate']) && isset($_POST['eventAllowComment']))
                createNewEvent($_POST['eventName'],$_POST['image'],$_POST['shortText'],$_POST['eventAddress'],$_POST['eventCity'],$_POST['eventState'],$_POST['eventDate'],$_POST['eventAllowComment'],$_SESSION['user_id'], $con);
            ?>

            <h2>Create new event</h2>
            <br>
            <form class="forma" method="post" action=""  enctype="multipart/form-data">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputText">Event Name</label>
                        <input type="text" class="form-control" id="eventName" name="eventName" placeholder="Event Name">
                    </div>
                    <div class="form-group col-md-6">
                        <label class="form-label" for="customFile">Choose image for your event</label>
                        <input type="file" class="form-control"  id="image" name="image" />
                    </div>
                </div>
                <div form="row">
                    <div class="form-outline">
                        <label class="form-label" for="textAreaExample2">Short Event Description</label>
                        <textarea class="form-control" id="shortText" name="shortText" rows="4" placeholder="Less than 500 characters!"></textarea>
                    </div>
                </div>
                <div form="row">
                    <div class="form-group">
                        <label for="inputAddress">Address</label>
                        <input type="text" class="form-control" id="eventAddress" name="eventAddress" placeholder="1234 Main St">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputCity">City</label>
                        <input type="text" class="form-control" id="eventCity" name="eventCity">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputState">State</label>
                        <input type="text" class="form-control" id="eventState" name="eventState">

                    </div>
                    <div class="form-group col-md-2">
                        <label for="inputDate">Date</label>
                        <input type="date" class="form-control"  id="eventDate" name="eventDate">
                    </div>

                </div>
                <div class="form-row">
                    <div class="form-group  col-md-2">
                        <label for="inputAllowComment">Allow comments</label>
                        <input type="checkbox" class="form-control" id="eventAllowComment" name="eventAllowComment">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Create</button>

            </form>
            <br><br>

        </div>
    </div>

    <div id="content3" class="content">
        <div class="yourEvents">
            <form class="form-contact">
                <h2>Create invitations for your guests</h2>
                <br>
                <div class="form-group">
                    <label for="guestName">Guest Name</label>
                    <input type="text" class="form-control" id="guestName" placeholder="Name">
                </div>
                <div class="form-group">
                    <label for="guestLastName">Guest Last Name</label>
                    <input type="text" class="form-control" id="guestLastName" placeholder="Last Name">
                </div>
                <div class="form-group">
                    <label for="message">Your message</label>
                    <textarea class="form-control" id="message" rows="3">Message for Guest</textarea>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <br>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                </div>

                <br>
                <button type="submit" class="btn btn-primary" id="submit">Submit</button>
            </form>
        </div>
    </div>

    <div id="content4" class="content">
        <div class="yourEvents">
            <h2>List of your events</h2>
            <div class="details">
                <div class="recentEvents">
                    <table>
                        <thead>
                        <tr>
                            <td>Event Name</td>
                            <td>Date and Time</td>
                            <td>Location</td>
                            <td>Options</td>
                        </tr>
                        </thead>

                        <tbody>
                        <tr>
                            <td>Immersive Disney Animation</td>
                            <td>May 14, 11pm - May 15, 6am CEST</td>
                            <td>2732 Newton Street, Saint Cloud Minnesota</td>
                            <td><a href="#" class="updateLink">Update</a></td>
                            <td><a href="#" class="deleteLink">Delete</a></td>
                        </tr>

                        <tr>
                            <td>Dino Trek</td>
                            <td>June 14, 11pm - June 15, 6am</td>
                            <td>52 Bridge Avenue, Merryville Louisiana</td>
                            <td><a href="#" class="updateLink">Update</a></td>
                            <td><a href="#" class="deleteLink">Delete</a></td>
                        </tr>

                        <tr>
                            <td>Much Ado About Nothing</td>
                            <td>June 17, 18pm - June 17, 20pm</td>
                            <td>3311 Sycamore Road, White Mountain Alaska</td>
                            <td><a href="#" class="updateLink">Update</a></td>
                            <td><a href="#" class="deleteLink">Delete</a></td>
                        </tr>

                        <tr>
                            <td>Cu At Boettcher</td>
                            <td>June 17, 18pm - June 17, 20pm</td>
                            <td>1729 South Street, Midland Texas</td>
                            <td><a href="#" class="updateLink">Update</a></td>
                            <td><a href="#" class="deleteLink">Delete</a></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div id="content5" class="content">
        <div class="yourEvents">
            <form class="form-signup text-center" id="registerForm" method="post" action="register_dashboard.php">
                <div class="logo">
                    <img src="colorfull_logo.png">
                </div>
                <h2>Update your account data</h2>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <span id="nameError"></span>
                            <input type="text" class="form-control" id="firstname1" name="firstname1" placeholder="First Name">
                        </div>
                        <div class="col-md-6">
                            <span id="lastNameError"></span>
                            <input type="text" class="form-control" id="lastname1" name="lastname1" placeholder="Last Name">
                        </div>

                        <div class="col-md-12">
                            <input type="text" class="form-control" id="orgname1" name="orgname1" placeholder="Organization name (not necessary)">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <span id="emailError"></span>
                    <input type="email" class="form-control" id="email1" name="email1" placeholder="Email Address">
                </div>
                <div class="form-group">
                    <span id="passwordError"></span>
                    <input type="password" class="form-control" id="password1" name="password1" placeholder="Password">
                </div>
                <div class="form-group">
                    <span id="password2Error"></span>
                    <input type="password" class="form-control" id="password21" name="confirm_password1" placeholder="Confirm password">
                </div>

                <a href='update.php?username=<?php echo $_SESSION["firstName"]; ?>' style='text-decoration: none; background-color: #2c919a; padding: 10px; color: #fff; border-radius: 5px;'>Update</a>
            </form>
        </div>
    </div>

    <div id="content6" class="content">
        <?php //include("logout.php"); ?>
    </div>



</div>
<?php
//php for creating registered user and entry data into database
include("db_config.php");

$host = 'localhost';
$db_name = 'event';
$username = 'root';
$password = '';
$pdo = new PDO("mysql:host=$host;dbname=$db_name;charset=utf8", $username, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Provera da li su svi potrebni podaci dostavljeni
    if (isset($_POST["firstname"]) && isset($_POST["lastname"]) && isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["confirm_password"])) {
        $firstName = $_POST["firstname"];
        $lastName = $_POST["lastname"];
        $orgName = $_POST["orgname"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $confirmPassword = $_POST["confirm_password"];


        if (empty($firstName) || empty($lastName) || empty($email) || empty($password) || empty($confirmPassword)) {
            echo "All fields required!.";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "Email is not valid!.";
        } elseif ($password !== $confirmPassword) {
            echo "Passwords do not match!.";
        } else {

            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

            $stmt = $pdo->prepare("INSERT INTO registered_user (first_name, last_name, organization_name, email, password) VALUES (:firstName, :lastName, :orgName, :email, :hashedPassword)");
            $stmt->execute([
                'firstName' => $firstName,
                'lastName' => $lastName,
                'orgName' => $orgName,
                'email' => $email,
                'hashedPassword' => $hashedPassword
            ]);
            // get ID of registered user for making events
            $registeredUserId = $pdo->lastInsertId();
            $_SESSION['firstName'] = $firstName;

                echo "<div style='display: flex; flex-direction: column; align-items: center; justify-content: center; height: 100vh;'>";
                echo "<h1 style='text-align: center;'>Welcome " . $firstName . "</h1>";
                echo "<div style='text-align: center;'>";
                echo "<p>Your data:</p>";
                echo "<p>Name: " . $firstName . "<br>Last Name: " . $lastName . "<br>Organization Name: " . $orgName . "<br>Email: " . $email . "<br>Password: " . $password . "</p>";
                echo "<a href='delete.php?firstName=$firstName' style='text-decoration: none; background-color: #f00; padding: 10px; color: #000; border-radius: 5px;'>Delete Your Account</a>";
                echo "<a href='logout.php' style='text-decoration: none; background-color: #f8c870; padding: 10px; color: #000; border-radius: 5px;'>Logout</a>";

                echo "</div>";
        }
    } else {
        echo "Some data is not correct!.";
    }
}


//php for creating events and entry data into database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["eventName"]) && isset($_FILES["image"]) && isset($_POST["shortText"]) && isset($_POST["eventAddress"]) && isset($_POST["eventCity"]) && isset($_POST["eventState"]) && isset($_POST["eventDate"]) && isset($_POST["eventAllowComment"]) && isset($_POST["eventBlocked"])) {

        $eventName = $_POST["eventName"];
        $image = $_FILES["image"]["name"];
        $image_tmp = $_FILES["image"]["tmp_name"];
        $shortText = $_POST["shortText"];
        $eventAddress = $_POST["eventAddress"];
        $eventCity = $_POST["eventCity"];
        $eventState = $_POST["eventState"];
        $eventDate = $_POST["eventDate"];
        $eventAllowComment = $_POST["eventAllowComment"];
        $eventBlocked = $_POST["eventBlocked"];

        if (empty($eventName) || empty($image) || empty($shortText) || empty($eventAddress) || empty($eventCity) || empty($eventState) || empty($eventDate)) {
            echo "All fields required!";
        } else {

            // Kreiranje PDO objekta
            $pdo = new PDO("mysql:host=$host;dbname=$db_name", $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                // Pomeranje privremene slike na odredište
                move_uploaded_file($image_tmp, "C:/wamp64/www/web_programming_project/new_event_pictures" . $image);
            } else {
                echo "Image upload failed.";
            }

            $stmt = $pdo->prepare("INSERT INTO new_event (event_name, image, description, address, city, state, date, allow_comments, blocked) VALUES (:eventName, :image, :shortText, :eventAddress, :eventCity, :eventState, :eventDate, :eventAllowComment, :eventBlocked)");
            $stmt->execute([
                'eventName' => $eventName,
                'image' => $image_tmp,
                'shortText' => $shortText,
                'eventAddress' => $eventAddress,
                'eventCity' => $eventCity,
                'eventState' => $eventState,
                'eventDate' => $eventDate,
                'eventAllowComment' => $eventAllowComment,
                'eventBlocked' => $eventBlocked,
               // 'userId' => $registeredUserId

            ]);
        }
    } else {
        echo "Some data is not correct!";
    }
}



?>


<!--JavaScript for dashboard links-->
<script>

  var links = document.getElementsByClassName('link');
  for (var i = 0; i < links.length; i++) {
  links[i].addEventListener('click', function(event) {
  event.preventDefault();

  var target = this.getAttribute('data-target');
  var contents = document.getElementsByClassName('content');

  for (var j = 0; j < contents.length; j++) {
    contents[j].style.display = 'none';
  }

  document.getElementById(target).style.display = 'block';
  });
}

  const guestName=document.getElementById("guestName");
  const guestLastName=document.getElementById("guestLastName");
  const message=document.getElementById("message");
  const email=document.getElementById("email");
  const submit=document.getElementsByClassName("form-contact")[0];

  submit.addEventListener('submit',(e)=> {
      e.preventDefault();

      Email.send({
          SecureToken : "3bb974eb-a9f7-418c-afeb-9c6d31cbb331",
          To : 'mujicnatasa99@gmail.com',
          From : "mujicnatasa99@gmail.com",
          Subject : "This is the subject",
          Body : "And this is the body"
      }).then(
          message => alert(message)
      );

  });

</script>
</body>
</html>
<?php
