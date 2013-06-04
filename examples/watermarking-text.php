<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Rully Ramanda
 * Date: 04/06/13
 * Time: 14:17
 *
 * Membuat watermark gambar dengan menggunakan text
 */

$image = imagecreatefromjpeg('../img/Resident  Evil Outbreak File 2-e.jpg');
$color = imagecolorallocate($image, 255, 255, 255);
imagestring($image, 5, 90, 0, "Ruli Armando", $color);

header('Content-Type: image/jpg');
imagejpeg($image);