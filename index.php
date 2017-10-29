<?php
require_once 'core/init.php';

if(Session::exists('home')) {
    echo '<p>' . Session::flash('home'). '</p>';
}
include('index.html');
?>
<script>
    $('.megamenu').find('.color5').hide();
</script>
<?php
$user = new User(); //Current
if($user->isLoggedIn()) {
    ?>
    <script type="text/javascript">
        ($('.top_right_ul').find('.loger_left').html('<li><a href=\"logout.php\">Logout</a></li>'));
        ($('.top_right_ul').find('.contact_left').html('<li><a href=\"changepassword.php\">Change Password</a></li>'));
        $('.megamenu').find('.color5').show();
    </script>

<!--    <p>Hello, <a href="profile.php?user=--><?php //echo escape($user->data()->UserName);?><!--">--><?php //echo escape($user->data()->UserName); ?><!--</p>-->
<!---->
<!--    <ul>-->
<!--        <li><a href="update.php">Update Profile</a></li>-->
<!--        <li><a href="changepassword.php">Change Password</a></li>-->
<!--        <li><a href="logout.php">Log out</a></li>-->
<!--    </ul>-->

    <?php

    if($user->hasPermission('admin')) {
        ?>
        <script>
        ($('.top_left').html('<h6><span></span>You are a Administrator!</h6>'));</script>
        <?php
    }
    if(!$user->hasPermission('admin')){
      ?>
        <script>
        ($('.top_left').html('<h6><span></span>Texas State University, San Marcos</h6>'));

        </script>
    <?php
    }

} else {
    echo '<p>You need to <a href="login.php">login</a> or <a href="register.php">register.</a></p>';
}
//echo Hash::make('admin', '123');
//require 'login.php';

/*
 *
$rev = new Stock();
echo $rev->getStock(1);
*/