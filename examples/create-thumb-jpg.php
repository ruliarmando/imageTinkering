<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Rully Ramanda
 * Date: 04/06/13
 * Time: 14:10
 *
 * Membuat thumbnail suatu gambar dan menyimpan nya di folder yang sama
 */

require_once('../Thumbnail.php');

$tn = new Thumbnail(200, 200);
$image = file_get_contents('../img/Resident  Evil Outbreak File 2-e.jpg');
$tn->loadData($image, 'image/jpeg');
$tn->buildThumb('../img/Resident  Evil Outbreak File 2-e-resampled.jpg');