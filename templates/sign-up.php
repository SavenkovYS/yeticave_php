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
    <?php if(isset($error)): ?>
    <?='Просим прощение - произошла ошибка'; ?>
    <?php else: ?>
    <?php $classname = isset($errors) ? "form--invalid" : ""; ?>
    <form class="form container <?=$classname; ?>" enctype="multipart/form-data" action="sign-up.php" method="post"> <!-- form--invalid -->
        <h2>Регистрация нового аккаунта</h2>
        <?php $classname = isset($errors['email']) ? "form__item--invalid" : "";
        $value = isset($form['email']) ? $form['email'] : "" ?>
        <div class="form__item <?=$classname; ?>"> <!-- form__item--invalid -->
            <label for="email">E-mail*</label>
            <input id="email" type="text" name="email" placeholder="Введите e-mail" value="<?=$value; ?>" required>
            <span class="form__error"><?php isset($errors['email']) ? print($errors['email']) : null ;?></span>
        </div>
        <?php $classname = isset($errors['password']) ? "form__item--invalid" : ""; ?>
        <div class="form__item <?=$classname; ?>">
            <label for="password">Пароль*</label>
            <input id="password" type="text" name="password" placeholder="Введите пароль" required>
            <span class="form__error">Введите пароль</span>
        </div>
        <?php $classname = isset($errors['name']) ? "form__item--invalid" : "";
        $value = isset($form['name']) ? $form['name'] : "" ?>
        <div class="form__item <?=$classname; ?>">
            <label for="name">Имя*</label>
            <input id="name" type="text" name="name" placeholder="Введите имя" value="<?=$value; ?>" required>
            <span class="form__error">Введите имя</span>
        </div>
        <?php $classname = isset($errors['message']) ? "form__item--invalid" : "";
        $value = isset($form['message']) ? $form['message'] : "" ?>
        <div class="form__item <?=$classname; ?>">
            <label for="message">Контактные данные*</label>
            <textarea id="message" name="message" placeholder="Напишите как с вами связаться" required><?=$value; ?></textarea>
            <span class="form__error">Напишите как с вами связаться</span>
        </div>
        <div class="form__item form__item--file form__item--last">
            <label>Аватар</label>
            <div class="preview">
                <button class="preview__remove" type="button">x</button>
                <div class="preview__img">
                    <img src="img/avatar.jpg" width="113" height="113" alt="Ваш аватар">
                </div>
            </div>
            <div class="form__input-file">
                <input class="visually-hidden" name="avatar" type="file" id="photo2" value="">
                <label for="photo2">
                    <span>+ Добавить</span>
                </label>
            </div>
        </div>
        <span class="form__error form__error--bottom">Пожалуйста, исправьте ошибки в форме.</span>
        <button type="submit" class="button">Зарегистрироваться</button>
        <a class="text-link" href="#">Уже есть аккаунт</a>
    </form>
</main>
<?php endif; ?>
