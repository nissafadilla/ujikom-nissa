<?php

session_start();
include 'config/connection.php';
if (isset($_SESSION['status']) && $_SESSION['status'] == 'login') {
    echo "<script>location.href='admin/index.php';</script>";
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
<body class="bg-white font-[Poppins] min-h-[100vh] pt-[4rem] relative">

    <header class="bg-[#A34343] h-[4rem] px-9 py-4 absolute top-0 left-0 right-0">
        <div class="h-[2rem] relative flex justify-between items-center">
            <div>
                <a class="text-2xl text-white" href="index.php">Gallery Photo</a>
            </div>
            <div class="md:hidden">
                <input class="hidden" type="checkbox" id="check">
                <label for="check">
                    <ion-icon class="text-3xl cursor-pointer menu-icon text-white" name="menu"></ion-icon>
                    <ion-icon class="text-3xl cursor-pointer close-icon text-white" name="close"></ion-icon>
                </label>
                <div class="bg-[#A34343] absolute top-[3rem] left-[-2.3rem] right-[-2.23rem] z-[9999] menu-nav">
                    <div class="m-4 h-min w-[95%] flex flex-col">
                        <a class="py-3 text-white" href="index.php">Home</a>
                        <a class="py-3 text-white" href="user/login.php">Login</a>
                        <a class="py-3 text-white" href="user/register.php">Register</a>
                    </div>
                </div>
            </div>
            <div class="hidden md:block w-[16rem]">
                <div class="flex justify-between">
                    <a class="text-white" href="index.php">Home</a>
                    <a class="text-white" href="user/login.php">Login</a>
                    <a class="text-white" href="user/register.php">Register</a>
                </div>
            </div>
        </div>
    </header>

    <div class="bg-white min-h-[100vh] p-9">
        <div class="bg-slate-100 rounded-lg relative p-10">
            <div class="relative">
                <img class="w-full h-[20rem] object-cover rounded-xl" src="image/20200925105849.png" alt="20200925105849">
                <div class="absolute inset-0 bg-black opacity-60 rounded-xl"></div>
                <div class="absolute inset-[3rem]">
                    <p class="text-5xl font-bold text-white">Gallery Photo Website</p>
                    <p class="text-white mt-8">  </p>
                </div>
            </div>
            <div class="mt-[5rem] relative min-h-[100vh] flex flex-wrap justify-center mdCustom01:justify-between gap-[4rem]">
                <?php
                $query = mysqli_query($connection, "SELECT * FROM pictures");
                while ($data = mysqli_fetch_array($query)) { ?>
                    <div class="p-4">
                        <div class="shadow-md">
                            <img class="w-[19rem] h-[10rem] rounded-t-lg" src="image/<?php echo $data['file_path'] ?>" alt="<?php echo $data['title']?>">
                            <div class="bg-white px-3 py-2">
                                <?php echo $data['description']?>
                            </div>
                            <div class="bg-white rounded-b-lg flex justify-around items-center h-[2rem]">
                                <p>
                                    <?php
                                    $pictureId = $data['id'];
                                    $like = mysqli_query($connection, "SELECT * FROM likes WHERE picture_id = '$pictureId'");
                                    echo mysqli_num_rows($like).' Like';
                                    ?>
                                </p>
                                <p>
                                    <?php
                                    $commentTotal = mysqli_query($connection, "SELECT * FROM comments WHERE picture_id='$pictureId'");
                                    echo mysqli_num_rows($commentTotal). ' Comment';
                                    ?>
                                </p>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <footer class="bg-[#A34343] w-full flex justify-center h-[3rem]">
        <div class="w-full flex justify-center items-center h-[3rem]">
            <p class="text-white">&copy; RPL 2 2024 | NISSA FADILLA</p>
        </div>
    </footer>

</body>
</html>