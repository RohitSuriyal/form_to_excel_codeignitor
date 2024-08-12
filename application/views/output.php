<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit Data to Google Sheets</title>
</head>

<body>
    <h1>Submit Data</h1>
    <form id="dataForm">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br><br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>
        <input type="submit" value="Submit">
    </form>

    <div id="responseMessage"></div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            $('#dataForm').on('submit', function(event) {
                event.preventDefault(); // Prevent the form from submitting normally

                $.ajax({
                    url: "<?php echo base_url('welcome/submit'); ?>", // The URL to send the request to
                    method: "POST",
                    data: $(this).serialize(), // Serialize the form data
                    success: function(response) {
                        // Handle success
                        $('#responseMessage').html('<p>Form submitted successfully!</p>');
                        Swal.fire({
                            title: 'Success!',
                            text: 'Form submitted successfully!',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $('#dataForm')[0].reset(); // Reset the form after the user clicks OK
                            }
                        });

                    },
                    error: function(xhr, status, error) {
                        // Handle error
                        $('#responseMessage').html('<p>An error occurred: ' + error + '</p>');
                    }
                });
            });
        });
    </script>
</body>

</html>