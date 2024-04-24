<?php

session_start();
if (isset($_SESSION['status']) && $_SESSION['status'] == 'login') {
    echo "<script>location.href='../admin/index.php';</script>";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Website Gallery Photo</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
    <script>
        tailwind.config = {
            theme: {
                screens: {
                    'md': '768px'
                    'mdCustom01': '840px',
                }
            }
        }
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <style>
        #check:checked + label .close-icon {
            display: block;
        }
        #check:not(:checked) + label .close-icon {
            display: none;
        }
        #check:checked + label .menu-icon {
            display: none;
        }
        #check:not(:checked) + label .menu-icon {
            display: block;
        }
        #check:checked ~ .menu-nav {
            display: block;
        }
        #check:not(:checked) ~ .menu-nav {
            display: none;
        }
    </style>
</head>
<body class="bg-white font-[Poppins] min-h-[100vh] pt-[2rem] relative">

    <header class="bg-[#A34343] h-[4rem] px-9 py-4 absolute top-0 left-0 right-0">
        <div class="h-[2rem] relative flex justify-between items-center">
            <div>
                <a class="text-2xl text-white" href="../index.php">Gallery Photo</a>
            </div>
            <div class="md:hidden">
                <input class="hidden" type="checkbox" id="check">
                <label for="check">
                    <ion-icon class="text-3xl cursor-pointer menu-icon text-white" name="menu"></ion-icon>
                    <ion-icon class="text-3xl cursor-pointer close-icon text-white" name="close"></ion-icon>
                </label>
                <div class="bg-[#A34343] absolute top-[3rem] left-[-2.3rem] right-[-2.23rem] z-[9999] menu-nav">
                    <div class="m-4 h-min w-[95%] flex flex-col">
                        <a class="py-3 text-white" href="../index.php">Home</a>
                        <a class="py-3 text-white" href="login.php">Login</a>
                        <a class="py-3 text-white" href="register.php">Register</a>
                    </div>
                </div>
            </div>
            <div class="hidden md:block w-[16rem]">
                <div class="flex justify-between">
                    <a class="text-white" href="../index.php">Home</a>
                    <a class="text-white" href="login.php">Login</a>
                    <a class="text-white" href="register.php">Register</a>
                </div>
            </div>
        </div>
    </header>

    <div class="bg-white flex justify-center items-center h-screen">
        <div class="bg-[#CD6262] w-96 p-6 shadow-lg rounded-md flex flex-col space-y-5">
            <div class="w-full flex justify-center">
                <h1 class="text-xl font-bold text-white">Login</h1>
            </div>
            <form class="gap-4" action="../service/login_service.php" method="post">
                <div class="flex flex-col space-y-5">
                    <div>
                        <label class="text-white" for="username">Username :</label><br>
                        <input class="border border-black rounded-lg w-full px-3" name="username" id="username" type="text" required>
                    </div>
                    <div>
                        <label class="text-white" for="password">Password :</label><br>
                        <input class="border border-black rounded-lg w-full px-3" name="password" id="password" type="password" required>
                    </div>
                </div>
                <div class="mt-3">
                    <button class="bg-[#E9C874] px-[1rem] py-[0.2rem] rounded-lg" type="submit" name="submit">Login</button>
                </div>
            </form>
            <p>Not registered yet? <a class="underline" href="register.php">Register</a></p>
        </div>
    </div>

    <footer class="bg-[#A34343] w-full flex justify-center h-[3rem]">
        <div class="w-full flex justify-center items-center h-[3rem]">
            <p class="text-white">&copy; RPL 2 2024 | NISSA FADILLA</p>
        </div>
    </footer>

</body>
</html>