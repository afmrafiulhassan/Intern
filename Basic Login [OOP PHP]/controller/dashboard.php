<?php
session_start();
if ($_SESSION['username'] != true) {
    header('Location: ../signin.html');
}

?>

<html>

<head>
    <title>ReformedTech</title>
</head>

<body>
    <h2 align="center">welcome to this system</h2>
    <table align="center">
        <tr>
            <td>
                Name:
            </td>
            <td>
                <?php echo $_SESSION['username']; ?>
            </td>
        </tr>
    </table>
    <button type="submit" name="logout" value=""><a href="logout.php">Logout</a></button>
</body>

</html>