<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Rully Ramanda
 * Date: 04/06/13
 * Time: 14:20
 *
 * Membuat watermark gambar dengan menggunakan gambar png
 */

$image = imagecreatefromjpeg('../img/Resident  Evil Outbreak File 2-e-resampled.jpg');
$iWidth = imagesx($image);
$watermark = imagecreatefrompng('../img/16x16_apply.png');
$wmWidth = imagesx($watermark);
$wmHeight = imagesy($watermark);
$xPos = $iWidth - $wmWidth;
imagecopymerge($image, $watermark, $xPos, 0, 0, 0,$wmWidth, $wmHeight, 100);

header('Content-Type: image/jpg');
imagepng($image);