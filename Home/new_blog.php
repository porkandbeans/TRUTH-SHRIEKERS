<?php include "header.php";

if (!isset($_SESSION["admin"]) || $_SESSION["admin"] != 1) {
    header("Location: index.php?error=notallowed");
    exit();
}

?>

<div class="blog_form">
    Publish a new blog
    <form action="../db_scripts/post_blog.php" method="post">
        <input style="width: 80%" placeholder="blog title"><br>
        <textarea class="blog_txtarea" placeholder="Start writing the blog post here!"></textarea><br>
        Upload a picture for the blog: <input type=file><br>
        Or use a URL: <input placeholder="http://www..."><br>
        one or neither, not both!
    </form>
</div>