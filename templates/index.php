<?php require_once ($_SERVER['DOCUMENT_ROOT'] . '/app/set_price_helper.php'); ?>
<main class="container">
    <section class="promo">
        <h2 class="promo__title">Нужен стафф для катки?</h2>
        <p class="promo__text">На нашем интернет-аукционе ты найдёшь самое эксклюзивное сноубордическое и горнолыжное снаряжение.</p>
        <ul class="promo__list">
            <li class="promo__item promo__item--boards">
                <a class="promo__link" href="all-lots.html">Доски и лыжи</a>
            </li>
            <li class="promo__item promo__item--attachment">
                <a class="promo__link" href="all-lots.html">Крепления</a>
            </li>
            <li class="promo__item promo__item--boots">
                <a class="promo__link" href="all-lots.html">Ботинки</a>
            </li>
            <li class="promo__item promo__item--clothing">
                <a class="promo__link" href="all-lots.html">Одежда</a>
            </li>
            <li class="promo__item promo__item--tools">
                <a class="promo__link" href="all-lots.html">Инструменты</a>
            </li>
            <li class="promo__item promo__item--other">
                <a class="promo__link" href="all-lots.html">Разное</a>
            </li>
        </ul>
    </section>
    <section class="lots">
        <div class="lots__header">
            <h2>Открытые лоты</h2>
        </div>
        <ul class="lots__list">
            <?php foreach($lots as $keys => $value): ?>
            <li class="lots__item lot">
                <div class="lot__image">
                    <img src="<?=$value['img']; ?>" width="350" height="260" alt="<?=$value['category']; ?>">
                </div>
                <div class="lot__info">
                    <span class="lot__category"><?=$value['category_id']; ?></span>
                    <h3 class="lot__title">
                        <a class="text-link" href="<?="lot.php?id=" . $value['id']; ?>"><?=$value['name']; ?></a>
                    </h3>
                    <div class="lot__state">
                        <div class="lot__rate">
                            <span class="lot__amount">Стартовая цена</span>
                            <span class="lot__cost"><?=set_price($value['price']); ?> <b class="rub">р</b></span>
                        </div>
                        <div class="lot__timer timer">
                            <?=$value['time_until_expire']; ?>
                        </div>
                    </div>
                </div>
            </li>
            <?php endforeach; ?>
        </ul>
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
    </section>
</main>
