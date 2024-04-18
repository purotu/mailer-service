# Mailer Service

This service is responsible for sending emails to users. It uses the PHPMailer library to send emails. 

## Installation

1. Clone the repository to your local machine.
2. Run `composer install` to install the PHPMailer library.
3. Copy the `.env.example` file to `.env` and update the values with your email server settings.

## Send Email API
Endpoint: index.php (replace with your actual endpoint)

**Method:** POST

**Content-Type:** application/json

**Description:** This API endpoint is used to send an email.

**Request Body:**

### Parameters:

**fromEmail (required):** The email address of the sender.
**fromName (required):** The name of the sender.
**toEmail (required):** The email address of the recipient.
**toName (required):** The name of the recipient.
**subject (required):** The subject of the email.
**messageBody (required):** The body of the email in HTML format.

### Response:

1. __On success__, the API will return a JSON object with a message property:
2. __On error__, the API will return a JSON object with an error property:

### Error Messages:

__"Invalid JSON payload":__ The request body is not a valid JSON string.

__"Missing required information":__ One or more required parameters are missing from the request body.

__"Invalid email address":__ The fromEmail or toEmail parameter is not a valid email address.

__"Message could not be sent. Mailer Error: ...":__ An error occurred while trying to send the email. The error message from PHPMailer is included.

__"Message could not be sent. Connection Error: ...":__ A connection error occurred while trying to send the email. The error message from PHPMailer is included.

Please replace index.php with your actual endpoint.
