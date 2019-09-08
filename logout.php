<?php

session_start();

unset($_SESSION);

session_destroy();

echo "<a href='index.php'>Volver al inicio index.php</a>";