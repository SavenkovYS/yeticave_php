<?php if(isset($_SESSION['user'])): ?>
<?php if(isset($error)): ?>
<h1>Просим прощения - произошла ошибка</h1>
<?php else: ?>
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
  <form enctype="multipart/form-data" class="form form--add-lot container <?=$classname; ?>" action="add.php" method="post"> <!-- form--invalid -->
    <h2>Добавление лота</h2>
    <div class="form__container-two">
      <?php $classname = isset($errors['lot-name']) ? "form__item--invalid" : "";
      $value = isset($lot['lot-name']) ? $lot['lot-name'] : ""; ?>
      <div class="form__item <?=$classname; ?>"> <!-- form__item--invalid -->
        <label for="lot-name">Наименование</label>
        <input id="lot-name" type="text" name="lot-name" value="<?=$value; ?>" placeholder="Введите наименование лота" required>
        <span class="form__error"><?php isset($errors['lot-name']) ? print($errors['lot-name']): "" ?></span>
      </div>
      <?php $classname = isset($errors['category']) ? "form__item--invalid" : ""; ?>
      <div class="form__item <?=$classname; ?>">
        <label for="category">Категория</label>
        <select id="category" name="category" required>
          <option>Выберите категорию</option>
          <option>Доски и лыжи</option>
          <option>Крепления</option>
          <option>Ботинки</option>
          <option>Одежда</option>
          <option>Инструменты</option>
          <option>Разное</option>
        </select>
        <span class="form__error"><?php isset($errors['category']) ? print($errors['category']): "" ?></span>
      </div>
    </div>
    <?php $classname = isset($errors['message']) ? "form__item--invalid" : "";
    $value = isset($lot['message']) ? $lot['message'] : ""; ?>
    <div class="form__item form__item--wide <?=$classname; ?>">
      <label for="message">Описание</label>
      <textarea id="message" name="message" placeholder="Напишите описание лота" required><?=$value; ?></textarea>
      <span class="form__error"><?php isset($errors['message']) ? print($errors['message']): "" ?></span>
    </div>
    <div class="form__item form__item--file"> <!-- form__item--uploaded -->
      <label>Изображение</label>
      <div class="preview">
        <button class="preview__remove" type="button">x</button>
        <div class="preview__img">
          <img src="img/avatar.jpg" width="113" height="113" alt="Изображение лота">
        </div>
      </div>
      <?php $classname = isset($errors['lot-image']) ? "form__item--invalid" : "";
      $value = isset($lot['lot-image']) ? $lot['lot-image'] : ""; ?>
      <div class="form__input-file">
        <input class="visually-hidden" name="lot-image" type="file" id="photo2" value="">
        <label for="photo2">
          <span>+ Добавить</span>
        </label>
        <span class="form__error"><?php isset($errors['lot-image']) ? print($errors['lot-image']): "" ?></span>
      </div>
    </div>
    <div class="form__container-three">
      <?php $classname = isset($errors['lot-rate']) ? "form__item--invalid" : "";
      $value = isset($lot['lot-rate']) ? $lot['lot-rate'] : ""; ?>
      <div class="form__item form__item--small <?=$classname; ?>">
        <label for="lot-rate">Начальная цена</label>
        <input id="lot-rate" type="number" name="lot-rate" value="<?=$value; ?>" placeholder="0" required>
        <span class="form__error"><?php isset($errors['lot-rate']) ? print($errors['lot-rate']): "" ?></span>
      </div>
      <?php $classname = isset($errors['lot-step']) ? "form__item--invalid" : "";
      $value = isset($lot['lot-step']) ? $lot['lot-step'] : ""; ?>
      <div class="form__item form__item--small <?=$classname; ?>">
        <label for="lot-step">Шаг ставки</label>
        <input id="lot-step" type="number" name="lot-step" value="<?=$value; ?>" placeholder="0" required>
        <span class="form__error"><?php isset($errors['lot-step']) ? print($errors['lot-step']): "" ?></span>
      </div>
      <?php $classname = isset($errors['lot-date']) ? "form__item--invalid" : "";
      $value = isset($lot['lot-date']) ? $lot['lot-date'] : ""; ?>
      <div class="form__item <?=$classname; ?>">
        <label for="lot-date">Дата окончания торгов</label>
        <input class="form__input-date" id="lot-date" type="date" name="lot-date" value="<?=$value; ?>" required>
        <span class="form__error"><?php isset($errors['lot-date']) ? print($errors['lot-date']): "" ?></span>
      </div>
    </div>
    <?php $classname = isset($errors) ? "" : "visually-hidden"; ?>
    <span class="form__error form__error--bottom <?=$classname; ?>">Пожалуйста, исправьте ошибки в форме.</span>
    <button type="submit" class="button">Добавить лот</button>
  </form>
</main>
<?php endif; ?>
<?php else: ?>
<main>
    <h1>Прежде чем добавить лот, авторизуйтесь</h1>
    <?php http_response_code(403); ?>
</main>

<?php endif; ?>

