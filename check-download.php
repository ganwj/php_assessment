<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form method="post" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>">
        <input type="submit" name="download" value="Download" />
    </form>
</body>

</html>

<?php

function checkDownloadTimestamp()
{
    if (time() - $_SESSION["download-timestamp"] > 5) return true;

    return false;
}

function download()
{
    $_SESSION["download-timestamp"] = time();
    if (isset($_SESSION["download-count"])) {
        $_SESSION["download-count"] += 1;
    } else {
        $_SESSION["download-count"] = 1;
    }
}

function checkDownload(string $memberType)
{
    if (empty($_SESSION["download-count"])) {
        download();
        return "Your download is starting...";
    }

    if ($memberType == "member") {
        if ($_SESSION["download-count"] >= 2) {
            if (checkDownloadTimestamp()) {
                download();
                return "Your download is starting...";
            } else {
                return "Too many downloads";
            }
        } else {
            download();
            return "Your download is starting...";
        }
    } else if ($memberType == "nonmember") {
        if (checkDownloadTimestamp()) {
            download();
            return "Your download is starting...";
        } else {
            return "Too many downloads";
        }
    } else {
        return "Error. Only 'member' and 'nonmember' are accepted as arguments.";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo checkDownload("member") . "<br>";
}
?>