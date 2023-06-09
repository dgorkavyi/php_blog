<header class="masthead" style="background-image: url('/public/images/home-bg.jpg')">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <div class="site-heading">
                    <h1>Мій блог</h1>
                    <span class="subheading">Простий блог на РНР - розроблено на самописному міні фреймворку</span>
                </div>
            </div>
        </div>
    </div>
</header>
<div class="container">
    <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
            <?php if (empty($list)): ?>
                <p>Пости відсутні</p>
            <?php else: ?>
                <?php foreach ($list as $val): ?>
                    <div class="post-preview">
                        <a href="/post/<?php echo $val['id']; ?>">
                            <h2 class="post-title"><?php echo htmlspecialchars($val['title'], ENT_QUOTES); ?></h2>
                            <h5 class="post-subtitle"><?php echo htmlspecialchars($val['description'], ENT_QUOTES); ?></h5>
                        </a>
                        <p class="post-meta">Номер поста: <?php echo $val['id']; ?></p>
                        <p class="post-meta">Додано: <?php echo $val['date']; ?></p>
                    </div>
                    <hr>
                <?php endforeach; ?>
                <div class="clearfix">
                    <?php echo $pagination->get(); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>