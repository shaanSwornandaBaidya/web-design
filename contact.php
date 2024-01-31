<?php
// Include common file for database connection or any other common functionality
require("common.php");

// Initialize error variables
$nameErr = $emailErr = $feedbackMessageErr = $successMessage ='';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate name
    if (empty($_POST['name'])) {
        $nameErr = "Please fill in your name";
    } else {
        $name = $_POST["name"];
        if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
            $nameErr = "Only letters and white space allowed";
        }
    }

    // Validate email
    if (empty($_POST['email'])) {
        $emailErr = "Please fill in your email address";
    } else {
        $email = $_POST["email"];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
        }
    }

    // Validate feedback message
    if (empty($_POST["feedbackMessage"])) {
        $feedbackMessageErr = "Feedback message is required";
    } else {
        $feedbackMessage = $_POST["feedbackMessage"];
    }

    // If no errors, insert data into database
    if (empty($nameErr) && empty($emailErr) && empty($feedbackMessageErr)) {
        // Prepare and execute SQL statement
        $sql = "INSERT INTO feedback (name, email, feedbackMessage) VALUES ('$name', '$email', '$feedbackMessage')";
        if ($con->query($sql) === TRUE) {
            $successMessage = 'Thank you for your reponse. Your response has been recorded.';
        } else {
            echo "Error: " . $sql . "<br>" . $con->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
     <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Contact | Life Style Store</title>
        <style type="text/css">
            .p1{
                text-align: justify;
                line-height: 2;
                width: 70%;
            }
        </style>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>
</head>
<body>
<?php
include 'header.php';
?>
<div class="container" id="content">
    <div class="row">
    <div class="col-lg">
        <img src="img/contact.png" style="float: right;">
        <h1>Get in Touch</h1>
        <p id="p1">Hi there, we are here to help you. Please feel free to contact us in case you have any queries regarding the products, payment or order delivery.With respect to payment, we will be accepting prepaid orders only, in order to avoid cash payment and hence maintain social distancing. With respect to delay in order delivery, please note that we are trying our best to deliver your order on time, but your order may be delayed due to the current situation (or unforseen circumstances). However, we ensure that your order will be delivered soon.In case you have any other queries, please fill the form below, and our team will get in touch with you within 24 hours.You can also contact the number given below to get in touch with our customer care executive immediately.</p>
    </div><br>
    <div class="col-lg">
        <div style="float: right;">
            <h1>COMPANY INFORMATION</h1><br>
            <p id="p1">Bengaluru, India - 560011</p><br>
            <p id="p1">Phone : +91 9302385479</p><br>
            <p id="p1">Email : support@lifestylestore.com</p>
        </div>
        <h1>FEEDBACK</h1>
        <div style="float: left;">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" >
            <div class="form-group">
                <input type="text" name="name" placeholder="Name" autofocus="on" class="form-control"  pattern="^[A-Za-z\s]{1,}[\.]{0,1}[A-Za-z\s]{0,}$">
                <span class="error" style="color: red;"><?php echo isset($nameErr) ? $nameErr : ''; ?></span>
            </div>
            <div class="form-group">
                <input type="email" name="email" placeholder="Email" class="form-control"
                pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" >
                <span class="error" style="color: red;"><?php echo isset($emailErr) ? $emailErr : ''; ?></span>
            </div>
            <div class="form-group">
                <textarea rows="5" cols="60" name="feedbackMessage" placeholder="Feedback"></textarea>
                <span class="error" style="color: red;"> <br><?php echo isset($feedbackMessageErr) ? $feedbackMessageErr : ''; ?></span>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>

            <span style="color: green;"> <br><?php echo isset($successMessage) ? $successMessage : ''; ?></span>
        </form>
    </div>
    </div>
</div>
</div>
<?php
include 'includes/footer.php';
?>
</body>
</html>