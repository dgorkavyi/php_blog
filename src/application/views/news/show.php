<div class="news-wrapper">
    <?php foreach ($news as $post) { ?>
        <div class="news-block">
            <p class="news-title"><?=$post['title']?></p>
            <p class="news-content"><?=$post['content']?></p>
            <p class="news-date"><?=$post['date']?></p>
        </div>
        <hr>
    <?php } ?>
</div>