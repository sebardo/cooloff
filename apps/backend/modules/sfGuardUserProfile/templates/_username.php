<?php 
$username = $sf_user->getAttribute('sf_guard_user[Username]');
echo input_tag('sf_guard_user[username]', $username? $username : null, array ('size' => 20)); 
?>