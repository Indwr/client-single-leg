
<div class="color-scheme-01">
    <!DOCTYPE HTML>
    <html lang="en">
        <head>
            <meta charset="utf-8">
            <meta name="HandheldFriendly" content="true" />
            <meta name="viewport" content="width=device-width, initial-scale=1.0" />
            <title><?php echo title; ?></title>
            <meta http-equiv='cache-control' content='no-cache'>
            <meta http-equiv='expires' content='0'>
            <meta http-equiv='pragma' content='no-cache'>
            <link href="<?php echo base_url('classic/register/'); ?>css/font-awesome.min.css" rel="stylesheet">
<!--            <link href="<?php // echo base_url('classic/register/');                                     ?>css/bootstrap.min.css" rel="stylesheet" media="screen">-->
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
            <link rel="stylesheet" href="<?php echo base_url('classic/register/'); ?>css/all_Jworld.css?v=3.7" media="all">
            <script src="<?php echo base_url('classic/register/'); ?>js/jquery-1.12.1.min.js"></script>
            <script src="<?php echo base_url('classic/register/'); ?>js/jquery-migrate-1.4.min.js"></script>
            <script src="<?php echo base_url('classic/register/'); ?>js/CustomJScript.js?v=2.1"></script>
            <style>
        body{background: url('<?php echo base_url('uploads/mainlogin-bg.jpg') ;?>');
                background-size: cover;
}
        .form-wrapper {
    width:100%;
    margin: 0 auto;
    background:#000;
    box-shadow: 1px 0px 7px #fff;
    color: #fff;
    background-size: cover;
    position: relative;
    padding: 20px;
    border-radius: 10px;
    margin: 10px;
}


                .form-control {
                    padding: 12px 20px;
                    background-color:#fff;
                    border-width: 2px;
                }
                .form-group label {
                    color:#000;
                    font-size: 16px;
                    font-weight: 600;
                    margin-bottom: 13px;
                }
                .form-control::placeholder{
                    color: #000;
                }
                .btn {
                    padding: 10px 15px;

                }
                .btn-gredient{
                    background: #00B4DB;  /* fallback for old browsers */
                    background: -webkit-linear-gradient(to right, #0083B0, #00B4DB);  /* Chrome 10-25, Safari 5.1-6 */
                    background:#007cc0; /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
                    border: 0;
                    color: #fff;
                    padding: 10px 15px;
                    font-size:20px;
                    line-height: 1.5;
                    border-radius:4px;
                    text-transform: uppercase;
                }
                .btn-gredient:focus,
                .btn-gredient:active,
                .btn-gredient:hover{
                    background: #00B4DB;  /* fallback for old browsers */
                    background: -webkit-linear-gradient(to right, #0083B0, #00B4DB);  /* Chrome 10-25, Safari 5.1-6 */
                    background: #007cc0; /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
                    border: 0;
                }
                .forgot-password{
                    color: #575f84;
                    font-weight: 600;
                }
                .columns{
                    min-height: 100vh;display: flex;align-items: center;justify-content: center;
                }
                .page-title {
                    color: #fff;
                    font-weight: bold;
                    font-size: 23px;
                    padding: 10px 0px;
                    text-transform: uppercase;
                    background: #d91f98;
                    border-radius: 10px;
                }
                .main-gredient{
                    background: #00B4DB;  /* fallback for old browsers */
                    background: -webkit-linear-gradient(to right, #0083B0, #00B4DB);  /* Chrome 10-25, Safari 5.1-6 */
                    background: linear-gradient(to right, #0083B0, #00B4DB); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
                }
                .book-content {
                    position: absolute;
                    width: 100%;
                    height: 100%;
                    justify-content: center;
                    align-items: center;
                    align-content: center;
                    display: flex;
                    background: rgba(53, 169, 157,0.2);
                }
                .book-content-inner{
                    padding: 30px;
                    background: #fff;
                    max-width: 450px;
                }

                .book-content-inner img {
                    max-width: 100%;
                    height: auto;
                }

                .clients-wrapper span{
                    display: flex;
                    align-items: center;
                    padding: 15px;
                    background-color: #fff;
                    height: 100px;
                    border-radius: 10px;
                    box-shadow: 0 0 2px rgba(0,0,0,0.14), 0 0 2px rgba(0,0,0,0.06);
                    margin-bottom: 30px;
                }
                .panel.panel-primary {
                    padding: 0px 20px;
                    position: relative;
                }
                .page-header.text-center {
                    position: relative;
                }
                .page-header img {
                    width: 100%;
                }
                a.forgot-password{
                     color: white;
                    background-color:#007cc0;
                    padding: 10px;
                    margin: 10px 0px 0px 0px;
                    margin-top: 24px;
                    display: block;
                    text-transform: uppercase;
                    border-radius: 10px;
                    font-size: 14px;
                }
                a.register-btn{
                    background: #575f84;
                    font-weight: 600;
                    color: #fff;
                    display:block;
                    padding: 11px;
                    border-radius: 10px;
                    text-transform: uppercase;
                    font-size: 14px;
                }
                @media screen and (max-width: 480px){
                    .btn-gredient{
                        padding: 7px;
                        font-size: 15px;
                    }
                    a.register-btn{
                        font-size: 13px;
                    }
                    a.forgot-password{
                        font-size: 13px;
                        margin-top: 9px;
                    }

                }
                .form-group label {
                    color: #fff;
                    font-size: 16px;
                    font-weight: 600;
                    margin-bottom: 13px;
                }
            </style>
        </head>
        <body>
            <div id="wrapper" class="joffice">
                <div id="main" class="main">
                    <div class="">


                        <div class="row no-gutters">
                        <div class="col-md-3 col-xl-5"></div>
                            <div class="col-12 col-md-6 col-xl-3 columns">
                                <div class="form-wrapper">
                                    <div class="page-header text-center">
                                         <img src="<?php echo base_url(logo); ?>" style="max-width: 160px;box-shadow: 0px 0px 10px #000;padding: 15px;border-radius: 10px;margin: 0;margin-bottom: 20px; ">
                                        <h1 class="page-title">Admin Login Area</h1>

                                    </div>
                                    <div class="panel panel-primary">

                                        <p style="color:red;text-align: center;"><?php echo $message; ?></p>
                                        <?php echo form_open(base_url('Jarvis/Management/login'), array('id' => 'loginForm')); ?>
                                        <form id="loginForm" method="post" action="/login.asp?ReturnURL=">
                                            <div class="panel-body">
                                                <div class="details password-form">

                                                    <div class="form-group">
                                                        <div class="label-area">
                                                            <label>User ID:</label>
                                                        </div>
                                                        <div class="row-holder">
                                                            <?php
                                                            echo form_input(array(
                                                                'type' => 'text',
                                                                'name' => 'user_id',
                                                                'class' => 'form-control',
                                                                'placeholder' => 'Enter Your User ID',
                                                                'required' => 'true',
                                                                'value' => 'admin',
                                                            ));
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="label-area">
                                                            <label>Password:</label>
                                                        </div>
                                                        <div class="row-holder">
                                                            <?php
                                                            echo form_input(array(
                                                                'type' => 'password',
                                                                'name' => 'password',
                                                                'class' => 'form-control',
                                                                'placeholder' => 'Enter Your Password',
                                                                'required' => 'true',
                                                                'value' => 'mlm_company',
                                                            ));
                                                            ?>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <button id="loginBtn" type="submit" class="btn btn-gredient btn-block" name="Submit" value="Login">Sign in </button>
                                                    </div>
                                                    
                                                </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
                <script language="JavaScript" type="text/javascript" src="<?php echo base_url('classic/register/'); ?>js/wz_tooltip.js"></script>
            </div>
        </body>
    </html>
</div>
