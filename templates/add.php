<?php if($is_auth): ?>
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
  <form enctype="multipart/form-data" class="form form--add-lot container <?=classname; ?>" action="add.php" method="post"> <!-- form--invalid -->
    <h2>Добавление лота</h2>
    <div class="form__container-two">
      <?php $classname = isset($errors['Название']) ? "form__item--invalid" : "";
      $value = isset($lot['lot-name']) ? $lot['lot-name'] : ""; ?>
      <div class="form__item <?=$classname; ?>"> <!-- form__item--invalid -->
        <label for="lot-name">Наименование</label>
        <input id="lot-name" type="text" name="lot-name" value="<?=$value; ?>" placeholder="Введите наименование лота" required>
        <span class="form__error"><?php isset($errors['Название']) ? print("Введите наименование лота"): "" ?></span>
      </div>
      <?php $classname = isset($errors['Категория']) ? "form__item--invalid" : "";
      $value = isset($lot['Категория']) ? $lot['Категория'] : ""; ?>
      <div class="form__item <?=$classname; ?>">
        <label for="category">Категория</label>
        <select id="category" name="category" value="<?=$value; ?>" required>
          <option>Выберите категорию</option>
          <option>Доски и лыжи</option>
          <option>Крепления</option>
          <option>Ботинки</option>
          <option>Одежда</option>
          <option>Инструменты</option>
          <option>Разное</option>
        </select>
        <span class="form__error"><?php isset($errors['Категория']) ? print("Выберите категорию"): "" ?></span>
      </div>
    </div>
    <?php $classname = isset($errors['Описание']) ? "form__item--invalid" : "";
    $value = isset($lot['Описание']) ? $lot['Описание'] : ""; ?>
    <div class="form__item form__item--wide <?=$classname; ?>">
      <label for="message">Описание</label>
      <textarea id="message" name="message" placeholder="Напишите описание лота" value="<?=$value; ?>" required></textarea>
      <span class="form__error"><?php isset($errors['Описание']) ? print("Напишите описание лота"): "" ?></span>
    </div>
    <div class="form__item form__item--file"> <!-- form__item--uploaded -->
      <label>Изображение</label>
      <div class="preview">
        <button class="preview__remove" type="button">x</button>
        <div class="preview__img">
          <img src="img/avatar.jpg" width="113" height="113" alt="Изображение лота">
        </div>
      </div>
      <?php $classname = isset($errors['Изображение']) ? "form__item--invalid" : "";
      $value = isset($lot['Изображение']) ? $lot['Изображение'] : ""; ?>
      <div class="form__input-file">
        <input class="visually-hidden" name="lot-image" type="file" id="photo2" value="">
        <label for="photo2">
          <span>+ Добавить</span>
        </label>
      </div>
    </div>
    <div class="form__container-three">
      <?php $classname = isset($errors['Начальная стоимость']) ? "form__item--invalid" : "";
      $value = isset($lot['Начальная стоимость']) ? $lot['Начальная стоимость'] : ""; ?>
      <div class="form__item form__item--small <?=$classname; ?>">
        <label for="lot-rate">Начальная цена</label>
        <input id="lot-rate" type="number" name="lot-rate" value="<?=$value; ?>" placeholder="0" required>
        <span class="form__error"><?php isset($errors['Начальная стоимость']) ? print("Введите начальную цену"): "" ?></span>
      </div>
      <?php $classname = isset($errors['Шаг ставки']) ? "form__item--invalid" : "";
      $value = isset($lot['Шаг ставки']) ? $lot['Шаг ставки'] : ""; ?>
      <div class="form__item form__item--small <?=$classname; ?>">
        <label for="lot-step">Шаг ставки</label>
        <input id="lot-step" type="number" name="lot-step" value="<?=$value; ?>" placeholder="0" required>
        <span class="form__error"><?php isset($errors['Шаг ставки']) ? print("Введите шаг ставки"): "" ?></span>
      </div>
      <?php $classname = isset($errors['Дата окончания аукциона']) ? "form__item--invalid" : "";
      $value = isset($lot['Дата окончания аукциона']) ? $lot['Дата окончания аукциона'] : ""; ?>
      <div class="form__item <?=$classname; ?>">
        <label for="lot-date">Дата окончания торгов</label>
        <input class="form__input-date" id="lot-date" type="date" name="lot-date" value="<?=$value; ?>" required>
        <span class="form__error"><?php isset($errors['Дата окончания аукциона']) ? print("Введите дату завершения торгов"): "" ?></span>
      </div>
    </div>
    <?php $classname = isset($errors) ? "" : "visually-hidden"; ?>
    <span class="form__error form__error--bottom <?=$classname; ?>">Пожалуйста, исправьте ошибки в форме.</span>
    <button type="submit" class="button">Добавить лот</button>
  </form>
</main>
<?php else: ?>
<main>
    <h1>Прежде чем добавить лот, авторизуйтесь</h1>
    <?php http_response_code(403); ?>
</main>
<?php endif; ?>

