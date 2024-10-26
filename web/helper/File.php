<?php

class File
{
    private $dirTemp;
    private $dirImage;
    private $dirFile;
    private $table;

    public function __construct($table = '')
    {
        $this->table = !empty($table) ? $table : 'all';
        $this->dirTemp = ROOT . 'view' . DS . 'temp' . DS;
        $this->dirImage = GAL_PATH . $table . DS;
        $this->dirFile = $this->dirImage . 'files' . DS;
    }

    public function createImage($file, $folder, $new_name, $new_w, $new_h, $crop_x = -1, $crop_y = -1)
    {
        list($lwidth, $lheight, $ltype, $lattr) = getimagesize($file);
        $thumb_w = $new_w;
        $thumb_h = $new_h;
        $src_img = imagecreatefromstring(file_get_contents($file));
        $old_x = imagesx($src_img);
        $old_y = imagesy($src_img);

        if ($crop_x == -1 && $crop_y == -1) {
            $percent = ($new_w * 100) / $old_x;
            $thumb_h = ceil(($percent * $old_y) / 100);
            if ($thumb_h < $new_h) {
                $percent = ($new_h * 100) / $old_y;
                $thumb_w = ceil(($percent * $old_x) / 100);
                $thumb_h = $new_h;
            }
        }

        $dst_img = imagecreatetruecolor($thumb_w, $thumb_h);
        imagecopyresampled($dst_img, $src_img, 0, 0, $crop_x, $crop_y, $new_w, $new_h, $old_x, $old_y);

        $ext = image_type_to_extension($ltype);
        $new_filename = $new_name . $ext;
        $destination = $folder . $new_filename;

        imagejpeg($dst_img, $destination, 100);

        imagedestroy($dst_img);
        imagedestroy($src_img);

        return file_exists($destination) ? $new_filename : false;
    }

    public function uploadFile($source = null, $isJson = true, $genName = true)
    {
        $result = ['success' => 0];

        if (isset($source['name'])) {
            $this->createFolder($this->dirFile, DS);
            $ext = $this->getExtension($source['name']);
            $temp = $source['tmp_name'];
            $new_name = $genName ? mt_rand(1, 99999999) . '.' . $ext : $source['name'];

            if (is_uploaded_file($temp)) {
                $destination = $this->dirFile . $new_name;

                if (move_uploaded_file($temp, $destination)) {
                    $result = [
                        'success' => 1,
                        'code' => $new_name,
                        'name' => $new_name,
                        'url' => URL_GAL . $this->table . '/files/'
                    ];
                }
            }
        }

        return $isJson ? json_encode($result) : $result;
    }

    public function uploadImage($source = null, $wimage = 0, $himage = 0, $wthumb = 0, $hthumb = 0, $auto = false)
    {
        $json = ['success' => 0];

        if (isset($source['name'])) {
            $dir_thumb = $this->dirImage . 'thumbs' . DS;
            $dir_image = $this->dirImage . 'images' . DS;
            $temp = $source['tmp_name'];
            $new_name = mt_rand(1, 99999999);
            $new_upload = $this->createImage($temp, $this->dirTemp, $new_name, $wimage, $himage);

            if ($new_upload) {
                list($new_w, $new_h, $ltype) = getimagesize($this->dirTemp . $new_upload);

                if ($new_h > $himage || $new_w > $wimage || $auto) {
                    $this->createFolder($dir_thumb, DS);
                    $this->createFolder($dir_image, DS);

                    $this->createImage($this->dirTemp . $new_upload, $dir_image, 'IM_' . $new_name, $wimage, $himage);
                    $this->createImage($this->dirTemp . $new_upload, $dir_thumb, 'TH_' . $new_name, $wthumb, $hthumb);

                    unlink($this->dirTemp . $new_upload);
                }

                $json = [
                    'success' => 1,
                    'code' => $new_name,
                    'name' => $new_upload,
                    'width' => $new_w,
                    'height' => $new_h,
                    'image' => $new_upload,
                    'url' => URL_GAL . $this->table . '/'
                ];
            }
        }

        return json_encode($json);
    }

    public function cropImage($width, $height)
    {
        $dir_thumb = $this->dirImage . 'thumbs' . DS;
        $dir_image = $this->dirImage . 'images' . DS;

        $code = !empty($_POST['code']) ? $_POST['code'] : '';
        $image = !empty($_POST['img']) ? $_POST['img'] : '';

        $new_name = pathinfo($image, PATHINFO_FILENAME);
        $new_image = $this->createImage($this->dirTemp . $image, $dir_image, 'IM_' . $new_name, $_POST['w'], $_POST['h'], $_POST['x'], $_POST['y']);

        if ($new_image) {
            unlink($this->dirTemp . $image);
            $new_thumb = $this->createImage($dir_image . $new_image, $dir_thumb, 'TH_' . $new_name, $width, $height);

            if ($new_thumb) {
                echo "
                <script>
                parent.setImage('$code','$image','" . URL_GAL . $this->table . '/' . "');
                parent.jQuery.fancybox.close();
                </script>
                ";
            }
        } else {
            echo 'Error: No se pudo recortar la imagen!';
        }
    }

    public function originalImage($code, $image)
    {
        $dir_thumb = $this->dirImage . 'thumbs' . DS;
        $dir_image = $this->dirImage . 'images' . DS;
        $nameimg = pathinfo($image, PATHINFO_FILENAME);

        copy($this->dirTemp . $image, $dir_image . 'IM_' . $nameimg);
        copy($this->dirTemp . $image, $dir_thumb . 'TH_' . $nameimg);

        unlink($this->dirTemp . $image);

        return "
            <script>
			parent.setImage('$code','$image','" . URL_GAL . $this->table . '/' . "');
			parent.jQuery.fancybox.close();
			</script>
            ";
    }

    public function displayCrop($code = '', $imagen = '', $width = 0, $height = 0)
    {
        list($lwidth, $lheight, $ltype, $lattr) = getimagesize($this->dirTemp . $imagen);

        $data = [
            'action' => $this->table . '/jcrop',
            'code' => $code,
            'image' => $imagen,
            'new_w' => $lwidth,
            'new_h' => $lheight,
            'wimage' => $width,
            'himage' => $height,
            'tabla' => $this->table,
        ];

        echo Load::view('jcrop' . DS . 'index', $data);
    }

    public function deleteImage($image)
    {
        $output = false;
        $dir_thumb = $this->dirImage . 'thumbs' . DS;
        $dir_image = $this->dirImage . 'images' . DS;

        if ($image) {
            @unlink($dir_image . 'IM_' . $image);
            $output = @unlink($dir_thumb . 'TH_' . $image);
        }

        return $output;
    }

    public function download($filename, $type = 'pdf')
    {
        $filePath = DOC_PATH . $filename;
        header('Content-Type: application/' . $type);
        header('Content-disposition: attachment;filename=' . $filename);
        readfile($filePath);
    }

    public function createFolder($folder, $sep = '/')
    {
        $arrayDir = explode($sep, $folder);
        $string = '';

        $i = 0;
        foreach ($arrayDir as $dir) {
            $separ = ($i > 0) ? $sep : '';
            $string .= $separ . $dir;

            if (!@is_dir($string)) {
                @mkdir($string, 0755);
                $error = 'Importante: Directorio creado correctamente!';
            } else {
                $error = 'Error: Directorio ya existe!';
            }
            $i++;
        }

        return $error;
    }

    public function getExtension($filename)
    {
        preg_match('/^(.*)\.([^.]+)$/', $filename, $matches);
        $file_extension = strtolower($matches[2]);
        return $file_extension;
    }
}
