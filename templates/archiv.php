<div class='archiv'>
    <?php
        foreach($archive_files as $archive_file) {
            if (@$archive_file['gallery_link'] != '')
                echo "<a href='$archive_file[gallery_link]' target='_blank'>";
            echo "<img src ='img/events/$archive_file[filename]' /><br/>";
            if ($archive_file['gallery_link'] != '')
                echo "</a>";
        }
    ?>
</div>
