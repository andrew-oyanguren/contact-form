<?php
  // Define Variables: set to empty values
  $name = "";
  $email = "";
  $message = "";

  // Define Error Message Variables: set to empty Values
  $nameError = "";
  $emailError = "";
  $messageError = "";
  $errorBorder = "";
  $formMessage = "";

  // Define conditional statement
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // add if statement to check if input feild is empty using empty() method
    if (empty($_POST["name"])) {
      $nameError = "* Name is required";
    } else {
      $name = test_input($_POST["name"]);
    }
    
    // check email and validate, and send email
    if (empty($_POST["email"])) {
      $emailError = "* Email is required";
    } else {
      $email = test_input($_POST["email"]);
      // create email variables
      $to = "aaoyanguren@outlook.com";
      $subject = "New Message from " .$name;
      $body = "";

      // set email body 
      $body .= "From: " .$name. "\r\n";
      $body .= "Email: " .$email. "\r\n";
      $body .= "Message: " .$message. "\r\n";

      // set headers, content-type, and version
      $headers = "MIME-Version: 1.0" . "\r\n";
      $header .= "Content-Type: text/html;charset=UTF-8" . "\r\n";
      // additional headers
      $headers .= "From: " .$name. "<" .$email. ">" . "\r\n";

      if(mail($to, $subject, $body, $headers)) {
        $formMessage = "Your email has been sent";
      } else {
        $formMessage = "Your email was not sent";
      }

      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailError = "Invalid email address";
      }
    }

    if (empty($_POST["message"])) {
      $messageError = "* Please leave a message";
    } else {
      $message = test_input($_POST["message"]);
    }
  
  }

  // Create function for filtering input data
  function test_input($data) {
    // strips whitespace
    $data = trim($data);
    // remove backslashes
    $data = stripslashes($data);
    // convert to html escaped code (security)
    $data = htmlspecialchars($data);
    return $data;
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact Form</title>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
  <link rel="stylesheet" href="./style.css">
</head>
<body>
  <header>
    <nav class="navbar navbar-light bg-light">
      <a class="navbar-brand" href="index.php">Company Logo</a>
    </nav>
  </header>

  <main>
    <div class="container-sm mt-5">
      <div class="row bg-light w-50 mx-auto rounded-lg">
        <div class="col">
          <h1 class="text-center p-2">Contact Us</h1>
        </div>
      </div>
      <div class="row mt-5">
        <div class="col d-flex flex-column align-items-center">
          <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <div class="form-group">
              <label for="name">Name:</label><br>
              <input class="form-control rounded-lg border-0" type="text" id="name" name="name" value="<?php echo $name;?>">
              <span class="error text-danger"><?php echo $nameError;?></span>
            </div>
            <div class="form-group">
              <label for="email">Email:</label><br>
              <input class="form-control rounded-lg border-0" type="email" id="email" name="email" value="<?php echo $email;?>">
              <span class="error text-danger"><?php echo $emailError;?></span>
            </div>
            <div class="form-group">
              <label for="message">Message:</label><br>
              <textarea class="form-control rounded-lg border-0" name="message" id="message" cols="22" rows="6"><?php echo $message;?></textarea>
              <span class="error text-danger"><?php echo $messageError;?></span>
            </div>
            <button class="btn btn-primary" type="submit">Submit</button>
          </form>
        </div>
      </div>
    </div>


  </main>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
</body>
</html>