<?php
    // Iterate over each cookie in the $_COOKIE superglobal
    foreach ($_COOKIE as $key => $value) {
        // Set the cookie's expiration to one hour ago
        setcookie($key, '', time() - 3600, '/');
    }

    echo "<script>location.href='index.php';</script>";
?>
