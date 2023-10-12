
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Images Manager</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <?php
    require_once __DIR__ . '/lib/flash.php';
    require_once __DIR__ . '/lib/functions.php';
        $imageDirectory = './uploads/';
        $images = scandir($imageDirectory);

        // Xóa ảnh
        // Viết code xóa ảnh
        if (isset($_POST["delete_image_confirm"])) {
            $imageToDelete = $_POST["image_name"];
            unlink($imageDirectory.$imageToDelete);
            header("Location: index.php");
        }

        // Sửa tên ảnh
        //Viết code sửa tên ảnh
        if (isset($_POST["update_image_name"])) {
            $newimagename = $_POST["new_image_name"];
            $oldimagename = $_POST["image_name"];

            $newimagenamePath = $imageDirectory.$newimagename;
            $oldimagenamePath = $imageDirectory.$oldimagename;

            if (rename($oldimagenamePath, $newimagenamePath)){
                header("Location: index.php");
                exit;
            }
            echo "close_edit_form();";
        }

        // Upload File ảnh
        if (isset($_POST["upload_image"])) {
            define("ALLOWED_FILES", [
                'image/png' => 'png',
                'image/jpg' => 'jpg',
                // viết thêm code
            ]);
            // 2.Cấu hình dung lượng file lớn nhất được upload
            define("MAX_SIZE", 5 * 1024 * 1024); //  5MB
            // 3. Cấu hình thư mục upload ảnh
            define("UPLOAD_DIR", __DIR__ . '/uploads');

            // 4. Nhạn dữ liệu từ  form
            $is_post_request = strtolower($_SERVER['REQUEST_METHOD']) === 'post';
            $has_file = isset($_FILES['file']);


            // 5. Kiểm tra file có tồn tại không, loại method
            // Viết code
            if (!$is_post_request || !$has_file) {
                redirect_with_message("File không tồn tại!", FLASH_ERROR);
            }

            // 6. Kiểm tra file
            $status = $_FILES['file']['error'];
            $filename = $_FILES['file']['name'];
            $tmp = $_FILES['file']['tmp_name'];


            // 6.1 Kiểm tra file upload có thành công không
            // Viết code
            if ($status !== UPLOAD_ERR_OK) {
                redirect_with_message(get_message($status), FLASH_ERROR);
            }

            // 6.2 Kiểm tra dung lượng file
            // Viết code
            $file_Size = filesize($tmp);
            if ($file_Size > MAX_SIZE) {
                redirect_with_message("File quá dung lượng", FLASH_ERROR);
            }

            // 6.3 Kiểm tra loại file upload
            // Viết code
            $mime_type = get_mime_type($tmp);
            if (!in_array($mime_type,array_keys(ALLOWED_FILES))) {
                redirect_with_message("Không đúng định dạng file", FLASH_ERROR);
            }

            // 7. Chuyển file từ folder tạm sang folder lưu chính
            // Viết code
            $upload_file = pathinfo($filename, PATHINFO_FILENAME).".".ALLOWED_FILES[$mime_type];
            $file_path = UPLOAD_DIR."/".$upload_file;
            $success = move_uploaded_file($tmp, $file_path);


            // 8. Hoàn thành điều hướng về index.php
            header("Location: index.php");
        }

    ?>
    <!--Title-->
    <div class="flex justify-center mt-8">
        <h1 class="text-3xl font-bold uppercase text-blue-600">Images Manager</h1>
    </div>

    <!-- Images Gallery-->
    <div class="container mx-auto px-5 py-2 lg:px-32 lg:pt-8">
        <div class="flex justify-end">
            <a>
                <button type="button" class="px-6 py-2 rounded border-2 border-green-500 bg-green-500
                text-white text-lg hover:bg-white hover:text-green-500 font-bold" onclick="upload_file_form()"> Thêm mới hình ảnh</button>
            </a>
        </div>
        <div class="w-full mt-8">
            <div class="-m-1 flex flex-wrap md:-m-2">

            <?php
            foreach ($images as $image) {
                if ($image !== '.' && $image !== '..') {
            ?>
                <div class="flex w-1/4 flex-wrap">
                    <div class="w-full p-1 md:p-2">
                        <img
                            alt="gallery"
                            class="block h-full w-full rounded-lg object-cover object-center"
                            src="<?php echo $imageDirectory . $image ?>" />
                    </div>
                    <div class="w-full p-2 flex justify-between">
                        <div class="text-left pl-4 text-gray-500 text-lg">
                            <?php echo $image ?>
                        </div>
                        <div>
                            <div class="flex justify-end gap-2">
                                <div>
                                    <button type="button" onclick="edit_file_name('<?php echo $image?>')" class="text-lg text-blue-500 hover:text-black">
                                        <i class="fa-regular fa-pen-to-square"></i>
                                    </button>
                                </div>
                                <div>
                                    <form method="post" action="">
                                        <input type="hidden" name="image_name" value="<?php echo $image?>" />
                                        <button type="button" name="delete_image" class="text-lg text-red-500 hover:text-black" onclick="deleteImage()">
                                            <i class="fa-regular fa-trash-can"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            <?php
                }
            }
            ?>
            </div>
        </div>
    </div>
    <div class="absolute w-full h-screen bg-black/50 top-0 left-0 hidden" id="edit_form">
        <div class="flex justify-center items-center">
            <div class="w-1/3 bg-white p-8 mt-36 rounded">
                <div class="edit-form">
                    <div class="grid grid-cols-2 gap-4">
                        <div class="col-span-1">
                            <img
                                id="edit_image_src"
                                alt="gallery"
                                class="block h-full w-full rounded-lg object-cover object-center"
                                src="./uploads/sample_1.png" />
                        </div>
                        <div class="col-span-1">
                            <form method="post" action="">
                                <h3 class="text-center font-bold text-blue-600 uppercase text-lg"> Sửa tên</h3>
                                <div class="mt-2 w-full">
                                    <p class="text-left font-bold text-base text-gray-600"> Tên cũ:</p>
                                    <input class="px-2 py-1 border border-gray-400 rounded w-full mt-1 focus:outline-blue-500"
                                           type="text" name="image_name" id="editImageName" value="sample_1.png" readonly/>
                                </div>

                                <div class="mt-2 w-full">
                                    <p class="text-left font-bold text-base text-gray-600"> Tên mới:</p>
                                    <input class="px-2 py-1 border border-gray-400 rounded w-full mt-1 focus:outline-blue-500"
                                           type="text" name="new_image_name" id="newImageName" value="sample_1.png" required/>
                                </div>
                                <div class="flex justify-end gap-2 mt-4">
                                    <button type="button" class="px-5 py-2 bg-gray-500 text-white text-base border border-gray-500
                                                       hover:text-gray-500 hover:bg-white rounded" onclick="close_edit_form()">Hủy</button>
                                    <button type="submit" class="px-5 py-2 bg-orange-500 text-white text-base border border-orange-500
                                                       hover:text-orange-500 hover:bg-white rounded " name="update_image_name">Cập nhật</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="absolute w-full h-screen bg-black/50 top-0 left-0 hidden" id="upload_form">
        <div class="flex justify-center items-center">
            <div class="w-1/3 bg-white p-8 mt-36 rounded">
                <div class="edit-form">
                    <div class="grid grid-cols-1 gap-4">

                        <div class="col-span-1">
                            <form method="post" action="#" enctype="multipart/form-data">
                                <h3 class="text-center font-bold text-blue-600 uppercase text-lg"> Thêm File</h3>

                                <div class="mt-2 w-full">
                                    <div>
                                        <label for="file">Select a file:</label>
                                        <input type="file" id="file" name="file"/>
                                    </div>
                                </div>
                                <div class="flex justify-end gap-2 mt-4">
                                    <button type="button" class="px-5 py-2 bg-gray-500 text-white text-base border border-gray-500
                                                       hover:text-gray-500 hover:bg-white rounded" onclick="close_edit_form()">Hủy</button>
                                    <button type="submit" class="px-5 py-2 bg-orange-500 text-white text-base border border-orange-500
                                                       hover:text-orange-500 hover:bg-white rounded " name="upload_image">Cập nhật</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="absolute w-full h-screen bg-black/50 top-0 left-0 hidden" id="delete_form">
        <div class="flex justify-center items-center">
            <div class="w-1/3 bg-white p-8 mt-36 rounded">
                <div class="edit-form">
                    <div class="grid grid-cols-2 gap-4">
                        <div class="col-span-1">
                            <img
                                    id="edit_image_src"
                                    alt="gallery"
                                    class="block h-full w-full rounded-lg object-cover object-center"
                                    src="./uploads/sample_1.png" />
                        </div>
                        <div class="col-span-1">
                            <form method="post" action="">
                                <h3 class="text-center font-bold text-blue-600 uppercase text-lg"> Xóa ảnh</h3>
                                <input type="hidden" name="image_name" value="<?php echo $image?>" />
                                <div class="flex justify-end gap-2 mt-4">
                                    <button type="button" class="px-5 py-2 bg-gray-500 text-white text-base border border-gray-500
                                                       hover:text-gray-500 hover:bg-white rounded" onclick="close_edit_form()">Hủy</button>
                                    <button type="submit" class="px-5 py-2 bg-orange-500 text-white text-base border border-orange-500
                                                       hover:text-orange-500 hover:bg-white rounded " name="delete_image_confirm">Cập nhật</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        let imgDir = '<?php echo $imageDirectory ?>';
        function edit_file_name(filename){
            console.log(filename);
            document.getElementById("edit_form").style.display="inline-block";
            document.getElementById("edit_image_src").src= imgDir + filename;
            document.getElementById("editImageName").value= filename;
            document.getElementById("newImageName").value= "";

        }
        function close_edit_form(){
            document.getElementById("edit_form").style.display="none";
            document.getElementById("upload_form").style.display="none";
            document.getElementById("delete_form").style.display="none";
        }

        function upload_file_form(){
            document.getElementById("upload_form").style.display="inline-block";
        }

        function deleteImage(){
            document.getElementById("delete_form").style.display="inline-block";
        }

    </script>


</body>
</html>