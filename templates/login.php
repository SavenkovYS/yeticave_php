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
    <?php $classname = isset($errors) ? "form--invalid" : ""; ?>
    <form class="form container <?=$classname; ?>" action="login.php" method="post">
        <?php isset($_GET['val']) === 'success' ? $success_text = 'Теперь Вы можете войти, используя свой email и пароль': null; ?>
        <?php if (isset($success_text)): ?>
        <h3><?=$success_text; ?></h3>
        <?php endif; ?>
        <h2>Вход</h2>
        <?php $classname = isset($errors['email']) ? "form__item--invalid" : "";
        $value = isset($form['email']) ? $form['email'] : ""; ?>
        <div class="form__item <?=$classname; ?>"> <!-- form__item--invalid -->
            <label for="email">E-mail*</label>
            <input id="email" type="text" name="email" placeholder="Введите e-mail" value="<?=$value; ?>" required>
            <span class="form__error"><?=$errors['email'] ;?></span>
        </div>
        <?php $classname = isset($errors['password']) ? "form__item--invalid" : ""; ?>
        <div class="form__item form__item--last <?=$classname; ?>">
            <label for="password">Пароль*</label>
            <input id="password" type="text" name="password" placeholder="Введите пароль" required>
            <span class="form__error"><?=$errors['password'] ;?></span>
        </div>
        <button type="submit" class="button">Войти</button>
    </form>
</main>
