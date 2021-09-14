<?php
    if(! file_exists("../blog/blogLog.json")){
        echo "No blogs..!";exit;
    }
    $blogFileRead = json_decode(file_get_contents("../blog/blogLog.json"), true);
    $blogFileRead = array_slice($blogFileRead, 0, 5);
    foreach ($blogFileRead as $key => $value) {
?>
        <hr />
        <div class="post-item clearfix py-2">
            <img src="/blog/<?php echo $value['name']; ?>/blogImage.jpg" alt="<?php echo $value['name']; ?>" class="mt-2">
            <h4><a href="/blog/<?php echo $value['name']; ?>/"><?php echo $value['title']; ?></a></h4>
            <time datetime="<?php echo $value['datetime']; ?>"><?php echo $value['datetime']; ?></time>
        </div>        
<?php
    }
?>