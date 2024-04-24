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
                <div class="bg-[#A34343] absolute top-[3rem] left-[-2.3rem] right-[-2.23rem] z-[9999] menu-nav">
                    <div class="m-4 h-min w-[95%] flex flex-col">
                        <a class="py-3 text-white" href="index.php">Home</a>
                        <a class="py-3 text-white" href="home.php">My Image</a>
                        <a class="py-3 text-white" href="upload.php">Upload</a>
                        <a class="py-3 text-white" href="../service/logout_service.php">Logout</a>
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

    <div class="bg-white min-h-[100vh] p-9">
        <div class="bg-slate-100 rounded-lg relative p-10">
            <div class="relative">
                <img class="w-full h-[20rem] object-cover rounded-xl" src="../image/20200925105849.png" alt="20200925105849">
                <div class="absolute inset-0 bg-black opacity-60 rounded-xl"></div>
                <div class="absolute inset-[3rem]">
                    <p class="text-5xl font-bold text-white">Gallery Photo Website</p>
                    <p class="text-white mt-8">Web galeri adalah situs web khusus yang menampilkan foto, gambar, video, dan karya seni digital lainnya, biasanya dalam format galeri yang mudah dinavigasi. Pengguna dapat menambahkan karya-karya mereka, memberikan deskripsi, dan berinteraksi dengan pengunjung melalui komentar, suka, dan berbagi. Ini adalah platform online yang digunakan oleh fotografer, seniman, dan kreator konten visual untuk memamerkan karya mereka kepada publik.</p>
                </div>
            </div>
            <div class="mt-[5rem] relative min-h-[100vh] flex flex-wrap justify-center mdCustom01:justify-between gap-[4rem]">
                <?php
                $query = mysqli_query($connection, "SELECT * FROM pictures");
                while ($data = mysqli_fetch_array($query)) {
                    $pictureId = $data['id'];
                    $pictureDate = $data['upload_date'];?>
                    <div class="p-4 rounded-lg">
                        <div class="shadow-md">
                            <div>
                                <a href="comment.php?picture=<?php echo $data['file_path'] ?>&pictureTitle=<?php echo $data['title']?>&pictureId=<?php echo $pictureId?>&description=<?php echo $data['description']?>&uploadDate=<?php echo $pictureDate?>">
                                    <img class="w-[19rem] h-[10rem]" src="../image/<?php echo $data['file_path'] ?>" alt="<?php echo $data['title']?>" width="100">
                                </a>
                            </div>
                            <div class="bg-white px-3 py-2">
                                <?php echo $data['description']?>
                            </div>
                            <div class="bg-white rounded-bl-lg rounded-br-lg flex justify-around items-center h-[3rem]">
                                <p class="w-[5rem]">
                                    <?php
                                    $checkLike = mysqli_query($connection, "SELECT * FROM likes WHERE picture_id='$pictureId' AND user_id='$userId'");

                                    if (mysqli_num_rows($checkLike) == 1) { ?>
                                        <a class="flex justify-evenly" href="../service/like_service_index.php?pictureId=<?php echo $data['id']?>" type="submit" name="cancel-like-index">
                                            <svg aria-label="Unlike" class="x1lliihq x1n2onr6 xxk16z8" fill="currentColor" height="24" role="img" viewBox="0 0 48 48" width="24">
                                                <title>
                                                    Unlike
                                                </title>
                                                <path d="M34.6 3.1c-4.5 0-7.9 1.8-10.6 5.6-2.7-3.7-6.1-5.5-10.6-5.5C6 3.1 0 9.6 0 17.6c0 7.3 5.4 12 10.6 16.5.6.5 1.3 1.1 1.9 1.7l2.3 2c4.4 3.9 6.6 5.9 7.6 6.5.5.3 1.1.5 1.6.5s1.1-.2 1.6-.5c1-.6 2.8-2.2 7.8-6.8l2-1.8c.7-.6 1.3-1.2 2-1.7C42.7 29.6 48 25 48 17.6c0-8-6-14.5-13.4-14.5z">
                                                </path>
                                            </svg>
                                            <?php
                                            $like = mysqli_query($connection, "SELECT * FROM likes WHERE picture_id = '$pictureId'");
                                            echo mysqli_num_rows($like).' Like';
                                            ?>
                                        </a>
                                    <?php } else { ?>
                                        <a class="flex justify-evenly" href="../service/like_service_index.php?pictureId=<?php echo $data['id']?>" type="submit" name="like-index">
                                            <svg aria-label="Like" class="x1lliihq x1n2onr6 xyb1xck" fill="currentColor" height="24" role="img" viewBox="0 0 24 24" width="24">
                                                <title>
                                                    Like
                                                </title>
                                                <path d="M16.792 3.904A4.989 4.989 0 0 1 21.5 9.122c0 3.072-2.652 4.959-5.197 7.222-2.512 2.243-3.865 3.469-4.303 3.752-.477-.309-2.143-1.823-4.303-3.752C5.141 14.072 2.5 12.167 2.5 9.122a4.989 4.989 0 0 1 4.708-5.218 4.21 4.21 0 0 1 3.675 1.941c.84 1.175.98 1.763 1.12 1.763s.278-.588 1.11-1.766a4.17 4.17 0 0 1 3.679-1.938m0-2a6.04 6.04 0 0 0-4.797 2.127 6.052 6.052 0 0 0-4.787-2.127A6.985 6.985 0 0 0 .5 9.122c0 3.61 2.55 5.827 5.015 7.97.283.246.569.494.853.747l1.027.918a44.998 44.998 0 0 0 3.518 3.018 2 2 0 0 0 2.174 0 45.263 45.263 0 0 0 3.626-3.115l.922-.824c.293-.26.59-.519.885-.774 2.334-2.025 4.98-4.32 4.98-7.94a6.985 6.985 0 0 0-6.708-7.218Z">
                                                </path>
                                            </svg>
                                            <?php
                                            $like = mysqli_query($connection, "SELECT * FROM likes WHERE picture_id = '$pictureId'");
                                            echo mysqli_num_rows($like).' Like';
                                            ?>
                                        </a>
                                    <?php } ?>
                                </p>
                                <p class="w-[9rem]">
                                    <a class="flex justify-evenly" href="comment.php?picture=<?php echo $data['file_path'] ?>&pictureTitle=<?php echo $data['title']?>&pictureId=<?php echo $pictureId?>&description=<?php echo $data['description']?>&uploadDate=<?php echo $pictureDate?>">
                                        <svg aria-label="Comment" class="x1lliihq x1n2onr6 x5n08af" fill="currentColor" height="24" role="img" viewBox="0 0 24 24" width="24">
                                            <title>
                                                Comment
                                            </title>
                                            <path d="M20.656 17.008a9.993 9.993 0 1 0-3.59 3.615L22 22Z" fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="2">
                                            </path>
                                        </svg>
                                        <?php
                                        $commentTotal = mysqli_query($connection, "SELECT * FROM comments WHERE picture_id='$pictureId'");
                                        echo mysqli_num_rows($commentTotal). ' Comment';
                                        ?>
                                    </a>
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
