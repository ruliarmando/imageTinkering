<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Rully Ramanda
 * Date: 04/06/13
 * Time: 14:05
 *
 * Menampilkan thumbnail dari suatu gambar dengan ukuran tertentu
 */

require_once('../Thumbnail.php');

$tn = new Thumbnail(200, 200);
$tn->loadFile('../img/Resident  Evil Outbreak File 2-e.jpg');

header('Content-Type: '.$tn->getMime());
$tn->buildThumb();