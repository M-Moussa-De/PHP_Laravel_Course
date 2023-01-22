<?php

$images = scandir("uploads/");

foreach ($images as $image) {

    if ($image == "." || $image == "..") {
        continue;
    }

    echo "<a href='uploads/$image' download>$image</a><br>";
}
