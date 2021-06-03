
<!DOCTYPE html>
<html lang="en">

<?php include('layout/head.php'); ?>
<body main-theme-layout="main-theme-layout-1">

<!-- Loader ends-->
<!-- page-wrapper Start-->
<div class="page-wrapper">
    <!-- Page Body Start-->
    <div class="container-fluid">
        <!-- sign up page start-->
        <div class="authentication-main">
            <div class="row">
                <div class="col-sm-12 p-0">
                    <div class="auth-innerright">
                        <div class="authentication-box">
                            <div class="text-center"><img class="utem-logo" src="../assets/images/endless-logo.png" alt="logo"></div>
                            <div class="card mt-4 p-4">
                                <h6 class="text-center">Register </h6>
                                <form class="theme-form" method="post" action="verify-signup.php">
                                    <div class="form-group">
                                        <label class="col-form-label" for="fullname">Name</label>
                                        <input class="form-control text-uppercase" type="text" id="fullname" name="fullname" required>
                                        <p id="name-help"></p>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-form-label" for="matric">Matrix Number</label>
                                        <input class="form-control text-uppercase" type="text" id="matric" name="matric_number" required>
                                        <p id="message"></p>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-form-label" for="email">Email</label>
                                        <input class="form-control" type="text" id="email" name="email" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-form-label" for="phone_number">Phone Number</label>
                                        <input class="form-control" type="text" id="phone_number" name="phone_number" required>
                                        <p id="phone-help"></p>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-form-label" for="password">Password</label>
                                        <input class="form-control" type="password" id="password" name="password" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-form-label" for="confirm_password">Confirm Password</label>
                                        <input class="form-control" type="password" id="confirm_password" name="confirm_password" required>
                                        <p id="password-help"></p>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-sm-4">
                                            <button class="btn btn-primary" type="submit" name="register">Sign Up</button>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="text-left mt-2 m-l-20">Are you already user?  <a class="btn-link text-capitalize" href="login.php">Login</a></div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- sign up page ends-->
    </div>
    <!-- Page Body End-->
</div>

<!-- Plugin used-->
</body>

<?php include('layout/script.php'); ?>
<script type="text/javascript">
    $(function (){
        // $("#register").attr('disabled', true);

        valid_phone = valid_name =  valid_password = valid_matric = false;

        $("#fullname").on("keyup", function() {
            if ( $(this).val().match('^[a-zA-Z]{3,16}$') ) {

                if($(this).val().length < 5){
                    valid_name = false;
                    $('#name-help').html('Invalid Name. You should insert your name and family name').css('color', 'red');
                }else{
                    $('#name-help').hide();
                    valid_name = true;
                }
            } else {
                valid_name = false;
                $('#name-help').html('Invalid Name').css('color', 'red');
            }
            checkBtn();
        });

        // $("#phone_number").on("keyup", function() {
        //     if ( $(this).val().match('^[0-9]{3,16}$') ) {
        //
        //         $('#phone-help').hide();
        //         valid_phone = true;
        //     } else {
        //         valid_phone = false;
        //         $('#phone-help').html('Invalid phone number. You should insert only a number.').css('color', 'red');
        //     }
        //     checkBtn();
        // });


        $("#matric").keyup(function (){

            v = $(this).val();
            if(v.length == 10){
                valid_matric = true;
                $('#message').hide();
            } else{
                valid_matric = false;
                $('#message').html('Matric Number should have 10 character.').css('color', 'red').show();

            }
            domain = "@"+'student.utem.edu.my';
            $("#email").val($(this).val()+domain);
            checkBtn();
        });

        $('#password, #confirm_password').on('keyup', function () {

            if ($('#password').val() == $('#confirm_password').val()) {

                if($('#password').val().length < 5){

                    valid_password = false;
                    $('#password-help').html('Password should have minimum 5 character.').css('color', 'red');
                }else {
                    $('#password-help').hide();
                    valid_password = true;
                }

            } else {
                valid_password = false;
                $('#password-help').html('Password Not Matching').css('color', 'red');
            }

            checkBtn();
        });


        function checkBtn(){
            $("#register").attr('disabled', false);

            console.log("matric " +valid_matric +" name :"+ valid_name +" password:"+  valid_password)
            if( valid_matric == true && valid_name == true && valid_password == true){
                $("#register").attr('disabled', false);
            }else{
                $("#register").attr('disabled', true);
            }
        }
    })
</script>
</html>