<!DOCTYPE html>
<html>

<head>
    <title>New Inquiry</title>
</head>

<body>
    <h1>New Inquiry Received</h1>
    <p><strong>Name:</strong> {{ $inquiry->name }}</p>
    <p><strong>Email:</strong> {{ $inquiry->email }}</p>
    <p><strong>Phone:</strong> {{ $inquiry->phone }}</p>
    <p><strong>Message:</strong> {{ $inquiry->message }}</p>
</body>

</html>
