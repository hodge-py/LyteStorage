<!DOCTYPE html>
<html>
<head>
    <title>PHP and HTML Example</title>
</head>
<body>
    <h1>Welcome!</h1>
    <?php
        // PHP code goes here
        $user = "John Doe";
        echo "<p>Hello, " . htmlspecialchars($user) . "!</p>"; // Output HTML from PHP
    ?>
    <p>This is a mix of static HTML and dynamic PHP content.</p>
</body>
</html>
