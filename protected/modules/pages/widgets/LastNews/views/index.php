<div class="centered">
    <div class="wide_line">
        <span>Новости</span>

    </div>

    <ul class="news">
        <?php foreach($news as $n): ?>
            <li>
                <span class="date"><?php echo $n->created ?></span>
                <a href="<?php echo $n->viewUrl ?>" class="title"><?php echo $n->title ?></a>
                <p><?php echo $n->short_description ?></p>
            </li>
        <?php endforeach; ?>
    </ul>

    <div class="all_news">
        <a href="<?=$n->category->viewUrl?>">Все новости</a>
    </div>
</div>