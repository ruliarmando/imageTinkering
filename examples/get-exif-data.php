<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Rully Ramanda
 * Date: 04/06/13
 * Time: 14:15
 *
 * Membaca data exif suatu gambar
 */

$exif_data = exif_read_data('../img/Resident  Evil Outbreak File 2-e.jpg');

echo "<pre>";
print_r($exif_data);
echo "</pre>";