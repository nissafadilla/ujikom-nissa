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

    <div class="bg-white min-h-[100vh] shadow-lg flex flex-col space-y-5 p-9 xl:flex xl:flex-row xl:justify-between">
        <div class="w-[20rem]">
            <div class="bg-[#CD6262] rounded-md flex flex-col space-y-5 p-6">
                <div class="w-full flex justify-center">
                    <h1 class="text-xl font-bold">Upload</h1>
                </div>
                <form class="gap-4" action="../service/upload_service.php" method="post" enctype="multipart/form-data">
                    <div class="flex flex-col space-y-5">
                        <div>
                            <label class="text-white" for="title">Title :</label>
                            <input class="border border-black rounded-lg w-full px-3" name="title" id="title" type="text" required>
                        </div>
                        <div>
                            <label class="text-white" for="description">Description :</label>
                            <input class="border border-black rounded-lg w-full px-3" name="description" id="description" type="text" required>
                        </div>
                        <div>
                            <label class="text-white" for="file">File :</label>
                            <input class="w-full" name="file" id="file" type="file" required>
                        </div>
                    </div>
                    <div class="mt-3">
                        <button class="bg-[#E9C874] px-[1rem] py-[0.2rem] rounded-lg text-white" type="submit" name="submit">Upload</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="bg-slate-100 w-[50rem] relative px-4 rounded-lg">
            <div class="flex flex-col pb-[3rem]">
                <div class="h-[4rem] w-full flex justify-center items-center">
                    <h1 class="text-xl font-bold">Upload</h1>
                </div>
                <div>
                    <table class="border border-black w-full">
                        <thead class="border border-black w-full">
                        <tr class="border border-black w-full">
                            <th class="border border-black w-[3rem]">#</th>
                            <th class="border border-black w-[15rem]">Foto</th>
                            <th class="border border-black">Judul Foto</th>
                            <th class="border border-black">Deskripsi</th>
                            <th class="border border-black">Tanggal</th>
                            <th class="border border-black">Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $no = 1;
                        $userId = $_SESSION['userid'];
                        $sql = mysqli_query($connection, "SELECT * FROM pictures WHERE user_id = '$userId'");
                        while ($data = mysqli_fetch_array($sql)) {
                            ?>
                            <tr class="border border-black w-full">
                                <td class="border border-black text-center"><?php echo $no++ ?></td>
                                <td class="border border-black text-center">
                                    <div class="w-full h-full flex justify-center">
                                        <img class="w-1/2 h-auto" src="../image/<?php echo $data['file_path']?>" alt="<?php echo $data['file_path']?>">
                                    </div>
                                </td>
                                <td class="border border-black text-center"><?php echo $data['title']?></td>
                                <td class="border border-black text-center"><?php echo $data['description']?></td>
                                <td class="border border-black text-center"><?php echo $data['upload_date']?></td>
                                <td class="border border-black text-center">
                                    <button class="bg-blue-600 hover:bg-blue-500 px-[1rem] py-[0.2rem] rounded-lg text-white" type="button" onclick="toggleModalEdit(<?php echo $data['id']; ?>)">
                                        Edit
                                    </button>

                                    <button class="bg-red-600 hover:bg-red-500 px-[1rem] py-[0.2rem] rounded-lg text-white" type="button" onclick="toggleModalDelete(<?php echo $data['id']; ?>)">
                                        Delete
                                    </button>

                                    <div class="bg-slate-100 rounded-lg absolute inset-0" id="exampleModalEdit<?php echo $data['id']; ?>" style="display: none;">
                                        <div class="relative w-full max-h-[100vh]">
                                            <div class="flex justify-start p-5">
                                                <button class="text-3xl cursor-pointer" onclick="toggleModalEdit(<?php echo $data['id']; ?>)">
                                                    <ion-icon name="close"></ion-icon>
                                                </button>
                                            </div>
                                            <form class="bg-slate-100 rounded-lg gap-4 relative w-full h-auto flex justify-start items-center p-5" action="../service/image_edit_service.php" method="post" enctype="multipart/form-data">
                                                <div class="bg-slate-100 p-5 w-[30rem] flex justify-center">
                                                    <img class="w-2/3 h-auto" src="../image/<?php echo $data['file_path']?>" alt="<?php echo $data['file_path']?>">
                                                </div>
                                                <div class="bg-slate-100 flex flex-col space-y-3 h-auto">
                                                    <div class="bg-slate-100 h-[19rem] w-[20rem] flex flex-col space-y-2">
                                                        <div class="flex flex-col justify-start">
                                                            <label class="text-left" for="id-edit">ID</label>
                                                            <input class="border border-black rounded-lg w-full py-2 px-3" type="text" id="id-edit" name="id-edit" value="<?php echo $data['id']?>" readonly>
                                                        </div>
                                                        <div class="flex flex-col justify-start">
                                                            <label class="text-left" for="title-edit">Judul</label>
                                                            <input class="border border-black rounded-lg w-full py-2 px-3" type="text" id="title-edit" name="title-edit" value="<?php echo $data['title']?>" required>
                                                        </div>
                                                        <div class="flex flex-col justify-start">
                                                            <label class="text-left" for="description-edit">Description</label>
                                                            <textarea class="border border-black rounded-lg w-full py-2 px-3" id="description-edit" name="description-edit" required><?php echo $data['description']?></textarea>
                                                        </div>
                                                        <div class="flex flex-col justify-start">
                                                            <label class="text-left" >File</label>
                                                            <input class="w-full" name="file" id="file" type="file">
                                                        </div>
                                                    </div>
                                                    <div class="flex justify-start">
                                                        <button class="bg-slate-600 hover:bg-slate-500 px-[1rem] py-[0.2rem] rounded-lg text-white" type="submit" name="submit">Submit</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                    <div class="bg-slate-100 rounded-lg absolute inset-0" id="exampleModalDelete<?php echo $data['id']; ?>" style="display: none;">
                                        <div class="bg-slate-100 flex rounded-lg justify-start p-5">
                                            <button class="text-3xl cursor-pointer" onclick="toggleModalDelete(<?php echo $data['id']; ?>)">
                                                <ion-icon name="close"></ion-icon>
                                            </button>
                                        </div>
                                        <form class="bg-slate-100 p-[5rem] flex flex-col self-start space-y-5" action="../service/image_delete_service.php" method="post" enctype="multipart/form-data">
                                            <div class="flex w-[15rem] gap-4">
                                                <input class="border border-black rounded-lg py-2 px-3" id="id-delete" name="id-delete" type="text" value="<?php echo $data['id']?>" readonly>
                                                <label class="whitespace-nowrap flex items-center" for="id-delete">Yakin ingin menghapus?</label>
                                            </div>
                                            <div class="flex justify-start">
                                                <button class="bg-slate-600 hover:bg-slate-500 px-[1rem] py-[0.2rem] rounded-lg text-white" type="submit" name="submit">Hapus</button>
                                            </div>
                                        </form>
                                    </div>

                                    <script>
                                        let modalVisibleEdit = false;

                                        function toggleModalEdit(id) {
                                            let modal = document.getElementById('exampleModalEdit' + id);
                                            if (modalVisibleEdit) {
                                                modal.style.display = 'none';
                                                modalVisibleEdit = false;
                                            } else {
                                                modal.style.display = 'block';
                                                modalVisibleEdit = true;
                                            }
                                        }

                                        let modalVisibleDelete = false;

                                        function toggleModalDelete(id) {
                                            let modal = document.getElementById('exampleModalDelete' + id);
                                            if (modalVisibleDelete) {
                                                modal.style.display = 'none';
                                                modalVisibleDelete = false;
                                            } else {
                                                modal.style.display = 'block';
                                                modalVisibleDelete = true;
                                            }
                                        }
                                    </script>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
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