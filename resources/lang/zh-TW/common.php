<?php

$username   =   '帳號';
$password   =   '密碼';
$captcha    =   '驗證碼';

return [

    /*
    |--------------------------------------------------------------------------
    | Pagination Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used by the paginator library to build
    | the simple pagination links. You are free to change them to anything
    | you want to customize your views to better match your application.
    |
    */

    /* validation 名稱 */

    'Validate_Login'    =>  [
                                'username'  =>  $username,
                                'password'  =>  $password,
                                'captcha'   =>  $captcha,
                                'captcha_api'=>  $captcha,
                            ],

    'Validate_Register' =>  [
                                'username'  =>  $username,
                                'email'     =>  '電子信箱',
                                'name'      =>  '名稱',
                                'password'  =>  $password,
                                'group'     =>  '群組',
                            ],

    'Validate_Group'    =>  [
                                'name'      =>  '群組名稱',
                                'permission'=>  '群組權限',
                            ],

    'Validate_Role'    =>  [
                                'name'      =>  '角色名稱',
                            ],
    'Validate_ChangePassword'   =>  [
                                        'password'  =>  $password,
                                    ],
    'Validate_Experience'   =>  [
                                    'job_content'   =>  '工作內容',
                                    'job_title'     =>  '工作職稱',
                                    'job_company'   =>  '工作公司',
                                    'job_start_date'=>  '工作開始日期',
                                    'job_end_date'  =>  '工作結束日期',
                                    'status'        =>  '狀態',
                                ],

    /* 反饋信息 */
    'LoginSuccess'      =>  '登入成功',
    'LogoutSuccess'     =>  '登出成功',
    'LoginFail'         =>  '登入失敗，請檢查帳號或密碼是否正確',
    'RegisterSuccess'   =>  '註冊成功',
    'ServiceError'      =>  '伺服器錯誤，請聯繫站點人員。',
    'Unauthorized'      =>  '禁止訪問',
    'InsertSuccess'     =>  '新增成功',
    'InsertFail'        =>  '新增失敗，請聯繫站點人員。',
    'UpdateSuccess'     =>  '更新成功',
    'UpdateFail'        =>  '更新失敗，請聯繫站點人員。',
    'DeleteSuccess'     =>  '刪除成功',
    'DeleteFail'        =>  '刪除失敗，請聯繫站點人員。',
    'ChangePasswordSuccess' =>  '變更密碼成功',
    'ChangePasswordFail'    =>  '變更密碼失敗',
];
