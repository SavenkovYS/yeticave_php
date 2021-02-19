<?php require_once ($_SERVER['DOCUMENT_ROOT'] . '/app/set_price_helper.php'); ?>
<?php require_once ($_SERVER['DOCUMENT_ROOT'] . '/app/set_date_helper.php'); ?>
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
    <?php
    if(isset($lot)): ?>
        <section class="lot-item container">
            <h2><?=$lot['name']; ?></h2>
            <div class="lot-item__content">
                <div class="lot-item__left">
                    <div class="lot-item__image">
                        <img src="<?=$lot['img']; ?>" width="730" height="548" alt="<?=$lot['category_id']; ?>">
                    </div>
                    <p class="lot-item__category">Категория: <span><?=$lot['category_id']; ?></span></p>
                    <p class="lot-item__description"><?=$lot['description']; ?></p>
                </div>
                <div class="lot-item__right">
                    <?php if($is_auth): ?>
                        <div class="lot-item__state">
                            <div class="lot-item__timer timer">
                                <?=$lot['time_until_expire']; ?>
                            </div>
                            <div class="lot-item__cost-state">
                                <div class="lot-item__rate">
                                    <span class="lot-item__amount">Текущая цена</span>
                                    <span class="lot-item__cost"><?=set_price($lot['price']); ?></span>
                                </div>
                                <div class="lot-item__min-cost">
                                    Мин. ставка <span><?=set_price($lot['price'] + $lot['step']); ?></span>
                                </div>
                            </div>
                            <?php if($_SESSION['user']['id'] === $lot['user_id']): ?>
                            <h3>Это Ваш лот</h3>
                            <?php else: ?>
                            <form class="lot-item__form" action="<?="lot.php?id=" . $lot['id'];?>" method="POST">
                            <?php $classname = isset($errors['cost']) ? "form__item--invalid" : ""; ?>
                                <p class="lot-item__form-item <?=$classname; ?>">
                                    <label for="cost">Ваша ставка</label>
                                    <input id="cost" type="number" name="cost" placeholder="<?=set_price($lot['price'] + $lot['step']); ?>">
                                    <span class="form__error"><?php isset($errors['cost']) ? print($errors['cost']) : null ;?></span>
                                </p>
                                <button type="submit" class="button">Сделать ставку</button>
                            </form>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                    <div class="history">
                        <h3>История ставок (<span><?php isset($bets) ? print(count($bets)) : print('0'); ?></span>)</h3>
                        <table class="history__list">
                            <?php if(isset($bets)) foreach ($bets as $bet): ?>
                            <tr class="history__item">
                                <td class="history__name"><?=$bet['name']; ?></td>
                                <td class="history__price"><?=set_price($bet['value']); ?></td>
                                <td class="history__time"><?=set_date($bet['create_ts']); ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    <?php else: ?>
        <h1>Ничего не найдено</h1>
    <?php endif; ?>
</main>
