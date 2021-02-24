<?php require_once ($_SERVER['DOCUMENT_ROOT'] . '/app/set_price_helper.php'); ?>
<main>
    <nav class="nav">
        <ul class="nav__list container">
            <li class="nav__item">
                <a href="all-lots.html">Доски и лыжи</a>
            </li>
            <li class="nav__item">
                <a href="all-lots.html">Крепления</a>
            </li>
            <li class="nav__item">
                <a href="all-lots.html">Ботинки</a>
            </li>
            <li class="nav__item">
                <a href="all-lots.html">Одежда</a>
            </li>
            <li class="nav__item">
                <a href="all-lots.html">Инструменты</a>
            </li>
            <li class="nav__item">
                <a href="all-lots.html">Разное</a>
            </li>
        </ul>
    </nav>
    <div class="container">
        <section class="lots">
            <h2>Результаты поиска по запросу «<span><?php echo $search ?? '';?></span>»</h2>
            <ul class="lots__list">
                <?php if(count($lots)) : foreach ($lots as $lot): ?>
                <li class="lots__item lot">
                    <div class="lot__image">
                        <img src="<?=$lot['img']; ?>" width="350" height="260" alt="Сноуборд">
                    </div>
                    <div class="lot__info">
                        <span class="lot__category"><?=$lot['category']; ?></span>
                        <h3 class="lot__title"><a class="text-link" href="<?='lot.php?id=' . $lot['id']; ?>"><?=$lot['name']; ?></a></h3>
                        <div class="lot__state">
                            <div class="lot__rate">
                                <span class="lot__amount">Стартовая цена</span>
                                <span class="lot__cost"><?=set_price($lot['price']); ?><b class="rub">р</b></span>
                            </div>
                            <div class="lot__timer timer">
                                16:54:12
                            </div>
                        </div>
                    </div>
                </li>
                <?php endforeach; ?>
                <?php else: ?>
                    <h2>По Вашему запросу ничего не найдено</h2>
                <?php endif; ?>
            </ul>
        </section>
        <?php if ($pages_count > 1): ?>
            <ul class="pagination-list">
                <li class="pagination-item pagination-item-prev"><a <?= $cur_page == 1 ? '' : 'href="/?page=' . ($cur_page - 1) . '"'; ?>>Назад</a></li>
                <?php foreach ($pages as $page): ?>
                    <li class="pagination-item <?= $page == $cur_page ? 'pagination-item-active' : "";?>">
                        <a <?= $page == $cur_page ? '' : 'href="/?page=' . $page . '"'?>><?=$page; ?></a>
                    </li>
                <?php endforeach; ?>
                <li class="pagination-item pagination-item-next"><a <?= $cur_page == count($pages) ? '' : 'href="/?page=' . ($cur_page + 1) . '"'; ?>>Вперед</a></li>
            </ul>
        <?php endif; ?>
    </div>
</main>

