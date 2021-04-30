<?php include "header.php";

?>
<div class="page-content" id="pgcont">

    <div class="sitecontent">
        <div class="site_updates_container">
            <h1 style="margin: 4px;">Site Activity</h1>
            <div class="site_updates_content">
                <div class="site_updates_text">Whenever a new blog post is made or a new file is uploaded, a notification will appear in this box.
                </div>
            </div>
        </div>
        <div class="zim-news">
            <?php
            if (isset($_SESSION["admin"]) && $_SESSION["admin"] == 1) {
                echo '<a class="new_blog_link" href="new_blog.php">new blog post</a>';
            }

            //Get the blog posts
            $dbResponse = $conn->query("SELECT * FROM `blogposts` ORDER BY `blogID` DESC LIMIT 5;");

            //make them all fancy and shit
            while ($row = $dbResponse->fetch_assoc()) {
                echo "<div class='blog_box'>";
                echo "<h1 class='blogtitle'>" . $row["blogName"] . "</h1>";
                echo "<img class='blogimg' src='../file_uploads/blogs/" . $row["blogImg"] . "' />";
                echo "<p class='blogtext'>" . $row["blogPost"] . "</p><br>";
                echo "</div>";
            }

            ?>
        </div>
    </div>
</div>

</div>
</body>

</html>