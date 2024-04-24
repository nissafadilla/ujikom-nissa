<?php

session_start();
include '../config/connection.php';
if ($_SESSION['status'] != 'login') {
    echo "
        <script>
            location.href='../index.php';
        </script>
    ";
}

$userId = $_SESSION['userid'];
$pictureName = $_GET['picture'];
$pictureTitle = $_GET['pictureTitle'];
$pictureId = $_GET['pictureId'];
$description = $_GET['description'];
$uploadDate = $_GET['uploadDate'];
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
                    'lg': '1024px',
                    'xl': '1280px',
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
<body class="bg-white font-[Poppins] min-h-[100vh] pt-[8rem] relative">

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
                <div class="bg-slate-300 absolute top-[3rem] left-[-2.3rem] right-[-2.23rem] z-[9999] menu-nav">
                    <div class="m-4 h-min w-[95%] flex flex-col">
                        <a class="py-3" href="index.php">Home</a>
                        <a class="py-3" href="home.php">My Image</a>
                        <a class="py-3" href="upload.php">Upload</a>
                        <a class="py-3" href="../service/logout_service.php">Logout</a>
                    </div>
                </div>
            </div>
            <div class="hidden md:block w-[29rem]">
                <div class="flex justify-between">
                    <a class="text-white" href="index.php">Home</a>
                    <a class="text-white" href="home.php">My Image</a>
                    <a class="text-white" href="upload.php">Upload</a>
                    <a class="text-white" href="../service/logout_service.php">Logout</a>
                </div>
            </div>
        </div>
    </header>

    <div class="bg-white min-h-[100vh] xl:flex w-full p-9">
        <div class="lg:w-1/2 p-3">
            <div class="bg-slate-400 flex flex-col shadow-xl rounded-lg">
                <img class="w-full h-auto" src="../image/<?php echo $pictureName?>" alt="<?php echo $pictureTitle?>">
                <div class="bg-white rounded-bl-lg rounded-br-lg p-4">
                    <p><?php echo $description?></p>
                    <p class="text-xs mt-2"><?php echo $uploadDate?></p>
                </div>
            </div>
        </div>
        <div class="bg-slate-100 rounded-lg xl:w-1/2 p-9 flex flex-col space-y-[10rem]">
            <div class="flex flex-col space-y-4">
                <div>
                    <p class="text-xl font-bold pb-[1rem]">
                        Comment Section
                    </p>
                    <hr>
                </div>
                <div class="flex flex-col space-y-3">
                    <?php
                    $comment = mysqli_query($connection, "SELECT c.*, u.username FROM comments c INNER JOIN users u ON c.user_id = u.id WHERE c.picture_id='$pictureId'");

                    while ($row = mysqli_fetch_array($comment)) {
                        $username = $row['username'];
                        $commentText = $row['comment'];
                        $commentDate = $row['comment_date']?>

                        <div>
                            <div class="flex justify-start gap-4">
                                <p class="font-bold capitalize"><?php echo $username; ?></p>
                                <p><?php echo $commentText; ?></p>
                            </div>
                            <p class="text-xs"><?php echo $commentDate?></p>
                        </div>

                        <?php
                    }
                    ?>
                </div>
            </div>
            <div>
                <form action="../service/comment_service.php?picture=<?php echo $pictureName?>&pictureTitle=<?php echo $pictureTitle?>&pictureId=<?php echo $pictureId?>&description=<?php echo $description?>&uploadDate=<?php echo $uploadDate?>" method="post">
                    <div>
                        <label for="pic-id">Picture ID</label>
                        <input class="border border-black rounded-lg py-2 px-3" type="text" id="pic-id" value="<?php echo $pictureId?>" name="picture-id" readonly/>
                    </div>
                    <div>
                        <label for="comment-id">Comment</label>
                        <textarea class="border border-black rounded-lg w-full py-2 px-3" id="comment-id" name="comment" required></textarea>
                    </div>
                    <div>
                        <button class="bg-slate-600 hover:bg-slate-500 px-[1rem] py-[0.2rem] rounded-lg text-white"  type="submit" name="submit">Kirim</button>
                    </div>
                </form>
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