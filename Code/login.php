<?php
$message = [];

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);
    $pass = $_POST['pass'];
    $pass = filter_var($pass, FILTER_SANITIZE_STRING);

    include '../components/connect.php';

    $select_tutor = $conn->prepare("SELECT * FROM `tutors` WHERE email = ? LIMIT 1");
    $select_tutor->execute([$email]);
    $row = $select_tutor->fetch(PDO::FETCH_ASSOC);

    if ($select_tutor->rowCount() > 0) {
        if (password_verify($pass, $row['password'])) {
            setcookie('tutor_id', $row['id'], time() + 60 * 60 * 24 * 30, '/');
            header('location:dashboard.php');
            exit();
        } else {
            $message[] = 'Incorrect email or password!';
        }
    } else {
        $message[] = 'Incorrect email or password!';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        * {
            font-family: -apple-system, BlinkMacSystemFont, "San Francisco", Helvetica, Arial, sans-serif;
            font-weight: 300;
            margin: 0;
        }

        $primary: rgb(182, 157, 230);
        .session {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            width: 100vw;
            background: #808080;
        }

        h4 {
            font-size: 24px;
            font-weight: 600;
            color: #000;
            opacity: .85;
        }

        label {
            font-size: 12.5px;
            color: #FFFFFF;;
            opacity: .8;
            font-weight: 400;
        }

        form {
            padding: 40px 30px;
            background: #333333;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            padding-bottom: 20px;
            width: 500px;
        }

        form h4 {
            margin-bottom: 20px;
            color: #FFFFFF;
        }

        form h4 span {
            color: #FFFFFF;
            font-weight: 700;
        }

        form p {
            line-height: 155%;
            margin-bottom: 5px;
            font-size: 14px;
            color: #FFFFFF;
            opacity: .65;
            font-weight: 400;
            max-width: 200px;
            margin-bottom: 40px;
        }

        a.discrete {
            color: #FFFFFF;;
            font-size: 14px;
            border-bottom: solid 1px rgba(#000, .0);
            padding-bottom: 4px;
            margin-left: auto;
            font-weight: 300;
            transition: all .3s ease;
            margin-top: 40px;
        }

        a.discrete:hover {
            border-bottom: solid 1px rgba(#000, .2);
        }
        
        input {
            font-size: 20px;
            padding: 20px 0px;
            height: 70px;
            border: none;
            border-bottom: solid 2px rgba(0, 0, 0, 1);
            background: #808080;
            width: 280px;
            box-sizing: border-box;
            transition: all .3s linear;
            color: #FFFFFF;
            font-weight: 400;
            -webkit-appearance: none;
        }

        input:focus {
            border-bottom: solid 1px $primary;
            outline: 0;
            box-shadow: 0 2px 6px -8px #808080;
            color: #FFFFFF;
        }

        .floating-label {
            position: relative;
            margin-bottom: 15px;
            width: 75%;
            margin-left: 10px;
            color : #FFFFFF;
        }

        .floating-label label {
            position: relative;
            top: calc(1% - 7px);
            left: 2px;
            opacity: 0;
            transition: all .3s ease;
            padding-left: 44px;
            color :#FFFFFF;
        }

        .floating-label input {
            width: calc(100% - 44px);
            display: flex;
            margin-top: 10px;
            color: #FFFFFF;
        }

        .floating-label input:not(:placeholder-shown) {
            color: #FFFFFF;
            padding: 28px 0px 12px 0px;
        }

        .floating-label input:not(:placeholder-shown) + label {
            color: #FFFFFF;
            transform: translateY(-10px);
            opacity: .7;
        }

        .floating-label input:valid:not(:placeholder-shown) + label {
            color: #FFFFFF;
            opacity: 1;
        }

        .floating-label input:valid:not(:placeholder-shown) + label {
            color: #FFFFFF;
            fill: $primary;
        }

        .floating-label input:not(:valid):not(:focus) + label + .icon {
            color: #FFFFFF;
            animation-name: shake-shake;
            animation-duration: .3s;
        }

        .floating-label input::placeholder {
        color: white;
    }

        $displacement: 3px;

        @keyframes shake-shake {
            0% {
                transform: translateX(-$displacement);
            }

            20% {
                transform: translateX($displacement);
            }

            40% {
                transform: translateX(-$displacement);
            }

            60% {
                transform: translateX($displacement);
            }

            80% {
                transform: translateX(-$displacement);
            }

            100% {
                transform: translateX(0px);
            }
        }

        .session {
            display: flex;
            flex-direction: row;
            width: auto;
            height: auto;
            margin: auto auto;
            background: #FFFFFF;
            border-radius: 4px;
            box-shadow: 0px 2px 6px -1px rgba(0, 0, 0, .12);
        }

        .left {
            width: 800px;
            height: 655px;
            min-height: 200%;
            position: relative;
            background-image: url("https://scientific-publishing.webshop.elsevier.com/wp-content/uploads/2022/08/what-background-study-how-to-write-1200x801.jpg");
            background-size: cover;
            border-top-left-radius: 4px;
            border-bottom-left-radius: 4px;
        }

        .right {
            width: 500px;
            padding: 40px 30px;
            background-color: #333333;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            padding-bottom: 20px;
            border-top-right-radius: 4px;
            border-bottom-right-radius: 4px;
        }
    </style>
    
</head>

<body>
    <div class="session">
        <div class="left">
            <!-- Left content -->
        </div>
        <div class="right">
            <!-- Right content -->
            <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <h4 style="font-size: 24px; font-weight: 600; color: #ffffff; opacity: .85; margin-bottom: 20px;">SmartHope</h4>
                <h4 style="font-size: 24px; font-weight: 600; color: #ffffff; opacity: .85;">Please login into your account</h4>
                <?php if (!empty($message)) : ?>
                    <p style="line-height: 155%; margin-bottom: 5px; font-size: 16px; color: #ffffff; opacity: .65; font-weight: 400; max-width: 300px; margin-bottom: 40px;"><?php echo implode('<br>', $message); ?></p>
                <?php endif; ?>
                <div class="floating-label">
                     <input type="email" name="email" id="email" placeholder="Email" required style="font-size: 20px; color: #FFFFFF; padding: 20px 0px; height: 70px; border: none; border-bottom: solid 2px rgba(0, 0, 0, 1); background: #808080; width: 280px; box-sizing: border-box; transition: all .3s linear; color: #FFFFFF; font-weight: 400; -webkit-appearance: none;::placeholder { color: white; opacity: 1; }">
               </div>
                <div class="floating-label">
                    <input type="password" name="pass" id="pass" placeholder="Password" required style="font-size: 20px; color: #FFFFFF; padding: 20px 0px; height: 70px; border: none; border-bottom: solid 2px rgba(0, 0, 0, 1); background: #808080; width: 280px; box-sizing: border-box; transition: all .3s linear; color: #FFFFFF; font-weight: 400; -webkit-appearance: none;">
                </div>
                <button type="submit" name="submit" style="-webkit-appearance: none; width: auto; min-width: 100px; border-radius: 24px; text-align: center; padding: 15px 40px; margin-top: 5px; background-color: #65008d; color: #000000; font-size: 14px; margin-left: 200px; font-weight: 500; box-shadow: 0px 2px 6px -1px rgba(0, 0, 0, .13); border: none; transition: all .3s ease; outline: 0;">Login</button>
            </form>
        </div>
    </div>
</body>

</html>
