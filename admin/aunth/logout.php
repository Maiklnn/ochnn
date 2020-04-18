<?php
setcookie('user_name', "", (time()+1), '/', '', 0);
setcookie('id_hash', "", (time()+1), '/', '', 0);
setcookie('admin', "", (time()+1), '/', '', 0);
setcookie('id_user', "", (time()+1), '/', '', 0);
setcookie('user_name_p', "", (time()+1), '/', '', 0);
setcookie('id_hash_p', "", (time()+1), '/', '', 0);

header("Location: http://$_SERVER[SERVER_NAME]");
?>