<?php
$connection = mysqli_connect("localhost", "root", "", "stay_free");
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}

if (isset($_POST['insert'])) {
    $first = $_POST['firstname'];
    $last = $_POST['lastname'];
    $email = $_POST['email'];
    $session = $_POST['session'];
    $day= $_POST['day'];

    // Assuming you have a table named "therapists" that stores therapist information
    $query = "SELECT NtMail FROM nominaltherapist WHERE NtFirstName = '$first' AND NtLastName = '$last'";
    $result = mysqli_query($connection, $query);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            // Therapist found, fetch their email
            $row = mysqli_fetch_assoc($result);
            $therapistEmail = $row['NtMail'];

            // Now you can use the $therapistEmail to fetch session and patient email if needed

            // For example, if you have a table named "sessions" that stores session information
            
                // Get the next Wednesday after the present day
            $next = date('Y-m-d', strtotime($day));
            $query = "INSERT INTO connect_p_t_plan (PlanId, PatientId, NtId, ttime, Dayy, start_datee, end_date) VALUES (1, '$email', '$therapistEmail', '$session','$day','$next','$next')";

            // Now you have the therapist's email, sessions, and patient emails
            // You can use the $therapistEmail, $sessions, and $patientsEmails as needed
            if (mysqli_query($connection, $query)) {
                //echo "Sign-up successful!"; // Or redirect to a success page
                 header("Location: payment/");
            } else {
                echo "Error: " . mysqli_error($conn);
            }
        } else {
            echo "Therapist not found.";
        }
    } else {
        echo "Error executing the query: " . mysqli_error($connection);
    }
}
mysqli_close($connection);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Standard Plan</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            background-color:  #b874a1;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background-color: whitesmoke;
            box-shadow: 1px 1px 2px 1px gray;
            padding: 50px 80px 20px 38px;
            width: 100%;
            max-width: 400px;
            border-radius:30px;
        }

        .container label, .container input, .container select {
            display: block;
            margin-bottom: 10px;
        }

        .container input[type="text"], .container select {
            width: 100%;
            padding: 8px;
            border-radius: 10px;
        }

        .container select {
            margin-bottom: 20px;
        }

        .container input[type="submit"] {
            background-color: #714077;
            color: white;

            border: none;
            padding: 10px 20px;
            cursor: pointer;
        }

        .container input[type="submit"]:hover {
            background-color: #ee7ae4;
        }
    </style>
</head>
<body>

    <center>
        <form action="" method="post">
            <div class="container">
                <h2>Standard Choicing</h2>
                <label>Name</label>
                <input type="text" name="name" placeholder="Enter your name" required>
                <label>Email-ID</label>
                <input type="email" name="email" placeholder="Enter your Email-ID" required>
                <label name="session">Select Preferred Session Time</label>
                <select name="session" required>
                <option value="">---select---</option>
                    <option value="09:00:00 to 11:00:00">9:00-11:00AM</option>
                    <option value="14:00:00 to 16:00:00">2:00-4:00PM</option>
                    <option value="18:00:00 to 20:00:00">6:00-8:00PM</option>
                </select>
                <!-- <input type="text" name="session_input" required placeholder="Enter your preferred session time"> -->
                <label name="day">Select Preferred Session Day</label>
                <select name="day" required>
                    <option value="">---select---</option>
                    <option value="monday">Monday</option>
                    <option value="tuesday">Tuesday</option>
                    <option value="wednesday">Wednesday</option>
                    <option value="thursday">Thursday</option>
                    <option value="friday">Friday</option>
                    <option value="saturday">Saturday</option>
                    <option value="sunday">Sunday</option>
                </select><br>
                <label>To confirm enter therapist first name</label>  
                <input type="text" name="firstname" placeholder="Enter chosen therapist" required>
                <label>To confirm enter therapist last name</label> 
                <input type="text" name="lastname" placeholder="Enter chosen therapist" required>                          
                <input type="submit" name="insert"class="insert" value="INSERT DATA" />
                <script>
                    document.getElementById('insert').addEventListener('click', function() {
                      var userInput = prompt('Successfully booked session .Kindly check your mail for payment');
                      if (userInput) {
                        alert('enter ,' + userInput + '! Thanks for your response');
                      }
                    });
                  </script>
            </div>
        </form>
    </center>

    <!--[if lt IE 7]>
        <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="#">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->
</body>
</html>

