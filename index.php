<!DOCTYPE html>
<html lang="en">

<head>
    <title>Send Mail</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0">

    <link rel="stylesheet" href="css/dist/contact.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
</head>

<body>
    <div id="success-message"></div>

    <section class="section-contact">
        <div class="container">
            <div class="contact-form">
                <h2>Contact us</h2>
                <form class="form-box" id="sendEmail">
                    <div class="input-box w50">
                        <input type="text" id="name" required>
                        <span>Name</span>
                    </div>
                    <div class="input-box w50">
                        <input type="text" id="email" required>
                        <span>E-mail</span>
                    </div>
                    <div class="input-box w50">
                        <input type="text" id="subject" required>
                        <span>Subject</span>
                    </div>

                    <div class="input-box w100">
                        <textarea id="body" required></textarea>
                        <span>Write your message here...</span>
                    </div>
                    <div class="input-box w100">
                        <input class="button" onclick="sendEmail()" type="button" type="reset" value="Send message">
                    </div>
            </div>
        </div>
        </div>
    </section>



    <script src="http://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script type="text/javascript">
        function sendEmail() {
            var name = $("#name");
            var email = $("#email");
            var subject = $("#subject");
            var body = $("#body");

            if (isNotEmpty(name) && isNotEmpty(email) && isNotEmpty(subject) && isNotEmpty(body)) {
                $.ajax({
                    url: 'sendEmail.php',
                    method: 'POST',
                    dataType: 'json',
                    data: {
                        name: name.val(),
                        email: email.val(),
                        subject: subject.val(),
                        body: body.val()
                    },
                    success: function(response) {
                        if (response.status === "success") {
                            // If the email is sent successfully, display the success message
                            successMessage.text("Message Sent Successfully.");
                            // Reload the page after a short delay (e.g., 2 seconds)
                            setTimeout(function() {
                                window.location.reload();
                            }, 2000); // 2000 milliseconds (2 seconds)
                        } else {
                            // Handle the case where the email sending was not successful
                            successMessage.text("Message Sending Failed. Please try again.");
                        }
                        // Reset the form
                        $('#sendEmail')[0].reset();
                    },
                    error: function(xhr, status, error) {
                        // Handle errors during the AJAX request
                        console.log("AJAX Error: " + status, error);
                        successMessage.text("An error occurred while sending the email.");
                    }
                });
            }
        }

        function isNotEmpty(caller) {
            if (caller.val() == "") {
                caller.css('border', '1px solid red');
                return false;
            } else
                caller.css('border', '');

            return true;
        }
    </script>

</body>

</html>