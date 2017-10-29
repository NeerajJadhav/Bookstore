<?php
require_once 'core/init.php';

require 'register.html';
if(Input::exists()){
 $validate = new Validate();
 $validation = $validate->check($_POST,array(
    'username'=>array(
        'required'=>true,
        'min'=>5,
        'max'=>20,
        'unique'=> 'users'),
     'password'=>array(
         'required'=>true,
         'min'=>6,
     ),
     'password_again'=>array(
         'required'=> true,
         'matches'=>'password'
     ),
     'name'=>array(
         'required'=> true,
         'min'=>2,
         'max'=>120,
     ),
     'address_shipping'=>array(
         'required'=> true,
         'max'=>100,
     ),
     'phone'=>array(
         'required'=> true,
         'min'=>10,
         'max'=>10,
     ),
     'email'=>array(
         'required'=> true
     )

 ));



if ($validate->passed()) {
    $user = new User();
    $salt = Hash::salt(32);
    try {
        $user->create(array(
            'name' => Input::get('name'),
            'username' => Input::get('username'),
            'password' => Hash::make(Input::get('password'), $salt),
            'salt' => $salt,
            'joined' => date('Y-m-d H:i:s'),
            'group' => 1,
            'phone' => Input::get('phone'),
            'email'=> Input::get('email'),
            'address'=>Input::get('address_shipping')
        ));

        Session::flash('home', 'Welcome ' . Input::get('username') . '! Your account has been registered. You may now log in.');
        Redirect::to('index.php');
    } catch(Exception $e) {
        echo $e, '<br>';
    }
} else {
    foreach ($validate->errors() as $error) {
        $errorString = $error . PHP_EOL;
    }
    echo "<script>alert(".$errorString.")</script>";
}
}

?>