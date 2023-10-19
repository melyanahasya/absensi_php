<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Codeigniter-3</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">


    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->


    <style>
        :root {
            /* Light theme */
            --c-light-text: #333;
            --c-light-background: #dedede;
            --c-light-interactive: mediumvioletred;
            /* Dark Theme */
            --c-dark-text: #fff;
            --c-dark-background: #333;
            --c-dark-interactive: palegreen;
        }

        * {
            margin: 0;
            padding: 0;
            --transi: all 400ms;
            user-select: none;
            text-decoration: none;
        }

        html,
        body {
            height: 100%;
            overflow-x: hidden;
        }

        body {

            display: flex;
            flex-direction: column;
        }

        .form-group {
            position: relative;
        }

        .password-toggle {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            right: 10px;
            cursor: pointer;
        }

        .btn {
            margin-top: 1rem;
            margin-left: 5.5rem;
        }

        .theme-container {
            display: flex;

            flex-direction: column;

            align-items: center;

            /* Make the light theme the default */
            --c-text: var(--light-text);
            --c-background: var(--c-light-background);
            --c-interactive: var(--c-light-interactive);
            color: var(--c-text);
            background-color: var(--c-background);
        }


        .theme-container .cat {
            position: absolute;
            transition: var(--transi);
            opacity: .9;
            z-index: 1;
        }

        .dark-mode-checkbox:checked~.theme-container .msg {
            display: none;
        }

        .theme-container .msg {
            position: absolute;
            transition: var(--transi);
            z-index: 2;
            margin-top: 4rem;
            opacity: 0;
            animation: fade 5s 1.6s ease-in-out forwards;

        }

        .theme-container .cat:where(:hover, :focus, :active)~.msg {
            opacity: 1 !important;


        }

        @keyframes fade {
            0% {
                opacity: 0;
            }

            50% {
                opacity: 1;
            }

            100% {
                opacity: 0;
            }
        }

        .theme-container .msg p {
            position: relative;
            margin-left: 22rem;
            font-size: 2rem;
            background: rgb(6, 255, 218);
            border-radius: 12px;
            padding: 10px;
        }

        @media (max-width:646px) {
            .theme-container .msg p {
                margin-left: 16rem;
                font-size: 1.6rem;
            }

            .contact-form {
                margin-right: 6rem;
            }

            .theme-container .msg {
                margin-top: 20%;
            }
        }
        
        @media (max-width: 600px) { 
              .btn {
                margin-top: 1rem;
                margin-left: -1rem;
            }
        }

        .dark-mode-checkbox:checked~.theme-container .cat {
            display: none;

        }

        .theme-container .contact-con {
            transition: var(--transi);
            display: flex;
            flex-direction: column;
            margin: auto;
            align-items: center;
            justify-content: center;
            border-radius: 50px;
            aspect-ratio: 1/1;
            width: 500px;
            box-shadow: 20px 20px 60px #acacac,
                -20px -20px 60px #ffffff;
            border: 1px solid #fff;
        }

        @media (max-width:501px) {
            .theme-container .contact-con {
                transition: var(--transi);
                border-radius: 0px !important;
            }

            .theme-container .msg p {
                margin-left: 0;
                font-size: 1.6rem;

            }

            .theme-container .msg {
                margin-top: 40%;
                transition: var(--transi);
            }

        }

        /* From uiverse.io by @alexruix */
        .input-group {
            position: relative;
            margin-top: 12px;
        }

        .input {
            border: solid 1.5px #9e9e9e;
            border-radius: 1rem;
            background: none;
            padding: 1rem;
            font-size: 1rem;
            transition: var(--transi);
        }

        .first {
            margin-bottom: 1em;
            margin-top: 2em;
        }

        .user-label {
            position: absolute;
            left: 15px;
            color: var(--c-light-text);
            pointer-events: none;
            transform: translateY(1rem);
            transition: 350ms cubic-bezier(0.4, 0, 0.2, 1);
            transition-timing-function: ease-in-out;
        }

        .input:focus,
        input:valid {
            outline: none;
            border: 1.5px solid #000000;
        }

        .input:focus~label,
        input:valid~label {
            transform: translateY(-50%) scale(0.8);
            background-color: var(--c-background);
            padding: 0 .2em;
            color: #000000;
            text-transform: uppercase;
            letter-spacing: 1.3px;
        }

        /* From uiverse.io by @alexmaracinaru */
        .btn {
            margin-top: 1rem;
            margin-right: 6rem;
        }

        .cta {
            border: none;
            background: none;
        }

        .cta span,
        .contact p {
            padding-bottom: 7px;
            letter-spacing: 4px;
            font-size: 13px;
            padding-right: 15px;
            text-transform: uppercase;
        }

        .contact p {
            font-size: 1.2rem;
        }

        .cta svg {
            transform: translateX(-8px);
            transition: all 0.3s ease;
        }

        .cta:hover svg {
            transform: translateX(0);
        }

        .cta:active svg {
            transform: scale(0.9);
        }

        .hover-underline-animation {
            position: relative;
            color: black;
            padding-bottom: 20px;
        }

        .hover-underline-animation:after {
            content: "";
            position: absolute;
            width: 100%;
            transform: scaleX(0);
            height: 1.5px;
            bottom: 0;
            left: 0;
            background-color: #000000;
            transform-origin: bottom right;
            transition: transform 0.25s ease-out;
            transition: transform 0.25s ease-out, -webkit-transform 0.25s ease-out;
        }

        .cta:hover .hover-underline-animation:after {
            transform: scaleX(1);
            transform-origin: bottom left;
        }

        .dark-mode-checkbox:checked~.theme-container {
            transition: var(--transi);
            /* Override the default theme */
            --c-text: var(--c-dark-text);
            --c-background: var(--c-dark-background);
            --c-interactive: var(--c-dark-interactive);
            background: #05012a;
        }

        .dark-mode-checkbox~.theme-container .link {
            margin-top: 2rem;
            border: 1px solid;
            padding: 10px;
            border-radius: 10px;
            text-transform: uppercase;
        }

        .dark-mode-checkbox:checked~.theme-container .link a {
            color: cyan;
        }

        .dark-mode-checkbox~.theme-container .link a {
            color: var(--c-light-text);
        }

        .dark-mode-checkbox:checked~.theme-container .hover-underline-animation {
            color: #ffffff;
        }

        .dark-mode-checkbox:checked~.theme-container .hover-underline-animation:after {
            background: -webkit-gradient(linear, left top, right top, from(#0ff), to(#04faa4));
            background: linear-gradient(90deg, #0ff, #04faa4);
        }

        .dark-mode-checkbox:checked~.theme-container #arrow-horizontal {
            background: -webkit-gradient(linear, left top, right top, from(#0ff), to(#04faa4));
            background: linear-gradient(90deg, #0ff, #04faa4);
            border-radius: 5px;
        }

        .dark-mode-checkbox:checked~.theme-container .contact-con {
            border-radius: 60px;
            -webkit-box-shadow: 50px 50px 100px #020011,
                -50px -50px 100px #080243;
            box-shadow: 50px 50px 100px #020011,
                -50px -50px 100px #080243;
            border: 1px solid #05012d;
        }

        .dark-mode-checkbox:checked~.theme-container .input:focus,
        .dark-mode-checkbox:checked~.theme-container input:valid {
            border: 1.5px solid var(--c-text);
        }

        .dark-mode-checkbox:checked~.theme-container input {
            color: var(--c-text);
        }

        .dark-mode-checkbox:checked~.theme-container .input:focus~label,
        .dark-mode-checkbox:checked~.theme-container input:valid~label {
            background: #05012a;
            color: var(--c-text);
        }

        .dark-mode-label {
            cursor: pointer;
            position: absolute;
            top: 10px;
            right: 10px;
            border: 1px solid var(--c-light-text);
            padding: 5px;
        }

        a {
            color: var(--c-interactive);
        }

        .dark-mode-checkbox:checked~.theme-container .dark-mode-label::before {
            content: "\2611";
        }

        .visually-hidden {
            position: absolute;
            overflow: hidden;
            clip: rect(0 0 0 0);
            width: 1px;
            height: 1px;
            margin: -1px;
            padding: 0;
            border: 0;
            white-space: nowrap;
        }

        /* Grow the content Area */
        .grow {
            -webkit-box-flex: 1;
            -ms-flex-positive: 1;
            flex-grow: 1;
            transition: var(--transi);
        }

        .footer footer {
            text-transform: uppercase;
            opacity: .7;
        }
    </style>
</head>

<body>


    <input type="checkbox" id="dark-mode" class="dark-mode-checkbox visually-hidden">

    <div class="theme-container grow">
        <label for="dark-mode" class="dark-mode-label">
            DARK MODE
        </label>

        <!-- Content here START -->
        <div class="cat">
            <img src="https://res.cloudinary.com/liquidtime/image/upload/v1653476648/cat-walk_meqsv9.gif" alt="">
        </div>

        <div class="contact-con">
            <div class="contact">
                <p>Sign up Admin</p>
                <form action="<?php echo base_url(); ?>Auth/register_admin" method="post" class="contact-form"
                    autocomplete="off">
                    <div class="input-group first">
                        <input required="" type="text" name="email" class="input">
                        <label class="user-label">Email</label>
                    </div>
                    <div class="input-group">
                        <input type="password" id="password" name="password" required class="input">
                        <i class="password-toggle fa fa-eye-slash" onclick="togglePasswordd()"></i>
                        <label for="password" class="user-label">Password</label>

                    </div>
                    <div class="input-group ">
                        <input id="username" required="" type="text" name="username" class="input">
                        <label class="user-label">Username</label>
                    </div>
                    <div class="input-group">
                        <input id="nama_depan" required="" type="text" name="nama_depan" class="input">
                        <label class="user-label">Nama depan</label>
                    </div>
                    <div class="input-group ">
                        <input id="nama_belakang" required="" type="text" name="nama_belakang" class="input">
                        <label class="user-label">Nama belakang</label>
                    </div>
                    <div class="input-group ">
                        <input id="role" required="" type="hidden" value="admin" name="role" class="input">
                    </div>
            </div>

            <div class="btn">
            <p style="margin-bottom: 5px;">*Validasi password minimal 8 karakter</p>
                <button type="submit" name="submit" class="cta" id="btn">
                    <span class="hover-underline-animation"> Register </span>
                    <svg id="arrow-horizontal" xmlns="http://www.w3.org/2000/svg" width="30" height="10"
                        viewBox="0 0 46 16">
                        <path id="Path_10" data-name="Path 10"
                            d="M8,0,6.545,1.455l5.506,5.506H-30V9.039H12.052L6.545,14.545,8,16l8-8Z"
                            transform="translate(30)"></path>
                    </svg>
                </button>    
            </div>
            </form>
        </div>

    </div>
    <script type="text/javascript">
        function togglePasswordd() {
            var passwordField = document.getElementById('password');
            var passwordToggle = document.querySelector('.password-toggle');

            if (passwordField.type === "password") {
                passwordField.type = "text";
                passwordToggle.classList.remove('fa-eye-slash');
                passwordToggle.classList.add('fa-eye');

            } else {
                passwordField.type = "password";
                passwordToggle.classList.add('fa-eye-slash');
                passwordToggle.classList.remove('fa-eye');

            }
        }
    </script>

</body>

</html>