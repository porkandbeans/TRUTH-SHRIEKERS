<a href="view_file.php?file=<?php echo $file; ?>">
    <div class="gallery_item">
        <div class="filename">
            <?php

            if (strlen($file) > 10) {
                echo substr($file, 0, 10) . "...";
            } else {
                echo $file;
            }


            ?></div>
        <div class="fileimg">
            <?php
            $images = ["png", "bmp", "jpg", "jpeg"];
            foreach ($images as $ext) {
                if ($pathinfo == $ext) {
                    echo "<img class='gallery_icon' src='../file_uploads/" . $file . "'></img>";
                }
            }
            if ($pathinfo == "txt") {
            ?>
                <img class="gallery_icon" src="../images/txt.png"></img>
            <?php
            } elseif ($pathinfo == "jpg") {
            }
            ?>
        </div>
    </div>
</a>