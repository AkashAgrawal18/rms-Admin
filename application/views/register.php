<?php include("head.php"); ?>
<?php include("header.php"); ?>
<style>
    .wrapper {
        position: relative;
        width: 430px;
        height: 530px;
    }

    section {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        overflow: hidden;
    }

    .form-wrapper {
        position: absolute;
        top: 0;
        left: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
        height: 100%;
        background: #fff;
        box-shadow: 0 0 10px rgba(0, 0, 0, .2);
    }

    .wrapper.animate-signUp .form-wrapper.sign-in {
        transform: rotate(7deg);
        animation: animateRotate .7s ease-in-out forwards;
        animation-delay: .3s;
    }

    .wrapper.animate-signIn .form-wrapper.sign-in {
        animation: animateSignIn 1.5s ease-in-out forwards;
    }

    @keyframes animateSignIn {
        0% {
            transform: translateX(0);
        }

        50% {
            transform: translateX(-500px);
        }

        100% {
            transform: translateX(0) rotate(7deg);
        }
    }

    .wrapper .form-wrapper.sign-up {
        transform: rotate(7deg);
    }

    .wrapper.animate-signIn .form-wrapper.sign-up {
        animation: animateRotate .7s ease-in-out forwards;
        animation-delay: .3s;
    }

    @keyframes animateRotate {
        0% {
            transform: rotate(7deg);
        }

        100% {
            transform: rotate(0);
            z-index: 1;
        }
    }

    .wrapper.animate-signUp .form-wrapper.sign-up {
        animation: animateSignUp 1.5s ease-in-out forwards;
    }

    @keyframes animateSignUp {
        0% {
            transform: translateX(0);
            z-index: 1;
        }

        50% {
            transform: translateX(500px);
        }

        100% {
            transform: translateX(0) rotate(7deg);
        }
    }

    /* h2 {
        font-size: 30px;
        color: #555;
        text-align: center;
    } */

    .input-group1 {
        position: relative;
        width: 320px;
        margin: 20px 0;
    }

    .input-group1 label {
        position: absolute;
        top: 50%;
        left: 5px;
        transform: translateY(-50%);
        font-size: 13px;
        color: #333;
        padding: 0 5px;
        pointer-events: none;
        transition: .5s;
    }

    .input-group1 input {
        width: 100%;
        height: 40px;
        font-size: 13px;
        color: #333;
        padding: 0 10px;
        background: transparent;
        border: 1px solid #333;
        outline: none;
        border-radius: 5px;
    }

    .input-group1 input:focus~label,
    .input-group1 input:valid~label {
        top: 0;
        font-size: 12px;
        background: #fff;
    }

    .forgot-pass {
        margin: -15px 0 15px;
    }

    .forgot-pass a {
        color: #333;
        font-size: 14px;
        text-decoration: none;
    }

    .forgot-pass a:hover {
        text-decoration: underline;
    }

    .btnlog {
        position: relative;
        top: 0;
        left: 0;
        width: 100%;
        height: 40px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, .4);
        font-size: 16px;
        color: #fff;
        font-weight: 500;
        cursor: pointer;
        border-radius: 5px;
        border: none;
        outline: none;
        background-color: #ac7c4f;
        border-color: #ac7c4f;
    }

    .sign-link {
        font-size: 14px;
        text-align: center;
        margin: 25px 0;
    }

    .sign-link p {
        color: #333;
    }

    .sign-link p a {
        color: red;
        text-decoration: none;
        font-weight: 600;
    }

    .sign-link p a:hover {
        text-decoration: underline;
    }
    @media (max-width:480px){
        .wrapper {
        position: relative;
        width: 350px;
        height: 450px;
    }
    }
</style>
<section style="background-image: url('assets/img/loginbg1.jpg');background-size:cover">
    <div class="wrapper">
        <div class="form-wrapper sign-up">
            <form method="post" id="rst_form">
                <h2>Register Now</h2>
                <div class="input-group1">
                    <input type="text" name="name"   required>
                    <label for="">Name</label>
                </div>
                <div class="input-group1">
                    <input type="text" name="mobile" id="mobile" maxlength="10" minlength="10" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)"   required>
                    <label for="">Phone Number</label>
                </div>
                <div class="input-group1">
                    <input type="email" name="email" id="email"  required>
                    <label for="">Email</label>
                </div>
                <div class="input-group1">
                    <input type="password" name="password"  required>
                    <label for="">Password</label>
                </div>
                <button type="submit" id="btn_rst" class="btnlog">Register</button>
                <div class="sign-link">
                    <p>Already have an account? <a href="<?php echo base_url('Register');?>" class="signIn-link">Login</a></p>
                </div>
            </form>
        </div>

        <div class="form-wrapper sign-in">
            <form action="<?php echo base_url('Register');  ?>" method="post">
                <h2>Login</h2>
                <div class="input-group1">
                    <input type="text" name="login_mobile" id="login_mobile" value="<?php echo set_value('login_mobile'); ?>" maxlength="10" minlength="10" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" required>
                    <label for="">Phone Number</label>
                </div>
                <div class="input-group1">
                    <input type="password" id="login_pass" name="login_pass" value="<?php echo set_value('login_pass'); ?>" required>
                    <label for="">Password</label>
                </div>
                <div class="forgot-pass">
                    <a href="<?php echo base_url('Forgot') ?>">Forgot Password?</a>
                </div>

                <button type="submit" class="btnlog">Login</button>

                <?php if ($this->session->flashdata('status')) echo $this->session->flashdata('status'); ?>
                <div class="sign-link">
                    <p>Don't have an account? <a href="#" class="signUp-link">Register Now</a></p>
                </div>
            </form>
        </div>
    </div>
</section>

<?php include("footer.php"); ?>
<?php include("script.php"); ?>
<?php $this->view('js/master_js'); ?>


<script>
    const wrapper = document.querySelector('.wrapper');
    const signUpLink = document.querySelector('.signUp-link');
    const signInLink = document.querySelector('.signIn-link');

    signUpLink.addEventListener('click', () => {
        wrapper.classList.add('animate-signIn');
        wrapper.classList.remove('animate-signUp');
    });

    signInLink.addEventListener('click', () => {
        wrapper.classList.add('animate-signUp');
        wrapper.classList.remove('animate-signIn');
    });
</script>
