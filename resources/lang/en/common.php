<?php

$username ='Account';
$password ='Password';
$captcha ='Verification Code';

return [

    /*
    |------------------------------------------------- -------------------------
    | Pagination Language Lines
    |------------------------------------------------- -------------------------
    |
    | The following language lines are used by the paginator library to build
    | the simple pagination links. You are free to change them to anything
    | you want to customize your views to better match your application.
    |
    */

    /* validation name */

    'Validate_Login' => [
                                'username' => $username,
                                'password' => $password,
                                'captcha' => $captcha,
                            ],

    'Validate_Register' => [
                                'username' => $username,
                                'email' =>'email',
                                'name' =>'name',
                                'password' => $password,
                                'group' =>'group',
                            ],

    'Validate_Group' => [
                                'name' =>'group name',
                            ],

    'Validate_Role' => [
                                'name' =>'role name',
                            ],
    'Validate_ChangePassword' => [
                                        'password' => $password,
                                    ],

    /* Feedback */
    'LoginSuccess' =>'Login successful',
    'LogoutSuccess' =>'Logout successfully',
    'LoginFail' =>'Login failed, please check whether the account or password is correct',
    'RegisterSuccess' =>'Registered successfully',
    'ServiceError' =>'Server error, please contact site staff. ',
    'Unauthorized' =>'Access is prohibited',
    'InsertSuccess' =>'Add success',
    'InsertFail' =>'Adding failed, please contact site personnel. ',
    'UpdateSuccess' =>'Update success',
    'UpdateFail' =>'Update failed, please contact site personnel. ',
    'DeleteSuccess' =>'Delete success',
    'DeleteFail' =>'Delete failed, please contact site personnel. ',
    'ChangePasswordSuccess' =>'Change password successfully',
    'ChangePasswordFail' =>'Failed to change password',
];