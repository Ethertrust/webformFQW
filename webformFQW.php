<?php
header('Content-Type: text/html; charset=utf-8');
$array = require_once('config.php');
?>
<html>
<head>
    <script src="https://code.jqueRy.com/jquery-1.10.2.js"></script>
    <script src='jquery.modify.js'></script>
    <script src='script.js'></script>
    <link type="text/css" rel="stylesheet" href="css.css" media="all">
    <link href="http://fonts.googleapis.com/css?family=PT+Serif:400,700,400italic,700italic&amp;subset=latin,cyrillic"
          rel="stylesheet" type="text/css">
</head>
<body>
<form action="formcheck.php" class="webform-client-form" method="post" accept-charset="UTF-8" enctype="multipart/form-data">
    <div class="form-item webform-component webform-component-textfield" id="webform-component-title">
        <label for="edit-submitted-title">Заглавие работы <span class="form-required" title="Это поле обязательно для заполнения.">*</span></label>
        <input type="text" id="edit-submitted-title" name="submittedtitle" value="" size="50" maxlength="128" class="form-text required" style="width:213px;">
        <label for="edit-submitted-title" id="error1" class="error" style="display: none;">заполните, пожалуйста</label>
    </div>
    <div class="form-item webform-component webform-component-textfield" id="webform-component-fio">
        <label for="edit-submitted-fio">ФИО <span class="form-required" title="Это поле обязательно для заполнения.">*</span></label>
        <input type="text" id="edit-submitted-fio" name="submittedfio" value="" size="60" maxlength="128" class="form-text required" style="width:213px;">
        <label for="edit-submitted-fio" id="error2" class="error" style="display: none;">заполните, пожалуйста</label>
    </div>
    <div class="form-item webform-component webform-component-textfield" id="webform-component-year">
        <label for="edit-submitted-year">Год написания <span class="form-required" title="Это поле обязательно для заполнения.">*</span></label>
        <input type="date" id="edit-submitted-year" name="submittedyear" value="" size="60" maxlength="128" class="form-text required" style="width:213px;">
        <label for="edit-submitted-year" id="error3" class="error" style="display: none;">заполните, пожалуйста</label>
    </div>
    <div class="form-item webform-component webform-component-textfield" id="webform-component-VKR">
        <label for="edit-submitted-VKR">Форма ВКР <span class="form-required" title="Это поле обязательно для заполнения.">*</span></label>
        <select name="VKR[]" id="edit-submitted-VKR">
            <option selected="selected" disabled>Форма ВКР </option>
            <?php
            while ($fruit_name = current($array["work_type"])) {
                echo '<option>'.htmlspecialchars($fruit_name).'</option>';
                next($array["work_type"]);
            }
            ?>
        </select>
        <label for="edit-submitted-VKR" id="error4" class="error" style="display: none;">выберите, пожалуйста</label>
    </div>
    <div id="curators">
        <div class="form-item webform-component webform-component-textfield" id="webform-component-curator">
            <label for="edit-submitted-curator">Научный руководитель (Фамилия, Имя, Отчество - полностью) <span class="form-required" title="Это поле обязательно для заполнения.">*</span></label>
            <input type="text" id="edit-submitted-curator" name="submittedcurator" value="" size="60" maxlength="128" class="form-text required" style="width:213px;">
            <label for="edit-submitted-curator" id="error5" class="error" style="display: none;">заполните, пожалуйста</label>
        </div>
        <button type="button" id="cboxCuratorAdd">Добавить руководителя</button>
    </div>
    <div class="form-item webform-component webform-component-textfield" id="webform-component-kod">
        <label for="edit-submitted-kod">ФИО <span class="form-required" title="Это поле обязательно для заполнения.">*</span></label>
        <input type="text" id="edit-submitted-kod" name="submittedkod" value="" size="60" maxlength="128" class="form-text required" style="width:213px;">
        <label for="edit-submitted-kod" id="error6" class="error" style="display: none;">заполните, пожалуйста</label>
    </div>
    <div class="form-item webform-component webform-component-textfield" id="webform-component-institutes">
        <label for="edit-submitted-institutes">Выберите институт <span class="form-required" title="Это поле обязательно для заполнения.">*</span></label>
        <select name="institutes[]" id="edit-submitted-institute">
            <option selected="selected" disabled>Выберите институт</option>
            <?php
            while ($fruit_name = current($array["institute"])) {
                echo '<option>'.htmlspecialchars(key($array["institute"])).'</option>';
                next($array["institute"]);
            }
            ?>
        </select>
        <label for="edit-submitted-institutes" id="error7" class="error" style="display: none;">выберите, пожалуйста</label>
    </div>
    <div class="form-item webform-component webform-component-textfield" id="webform-component-pages">
        <label for="edit-submitted-pages">К-во страниц <span class="form-required" title="Это поле обязательно для заполнения.">*</span></label>
        <input type="text" id="edit-submitted-pages" name="submittedpages" value="" size="60" maxlength="128" class="form-text required" style="width:213px;">
        <label for="edit-submitted-pages" id="error8" class="error" style="display: none;">заполните, пожалуйста</label>
    </div>
    <div class="form-item webform-component webform-component-email" id="webform-component-vash-email">
        <label for="edit-submitted-vash-email">Действующий адерс эл. почты <span class="form-required" title="Это поле обязательно для заполнения.">*</span></label>
        <input class="email form-text form-email required" type="email" id="edit-submitted-vash-email" name="submittedvash_email" size="60" style="width:213px; float:left;">
        <img id="ok1" src="images/ok.jpg" alt="ok" style="display:none;">
        <img id="notok1" src="images/notok.jpg" alt="error" style="display:none;">
    </div>
    <div class="form-item webform-component webform-component-email" id="webform-component-vash-pdf">
        <label for="edit-submitted-vash-pdf">Присоединить текст работы (формат PDF) <span class="form-required" title="Это поле обязательно для заполнения.">*</span></label>
        <input type="file" name="fileToUpload" id="edit-submitted-vash-pdf" accept=".pdf">
        <img id="ok2" src="images/ok.jpg" alt="ok" style="display:none;">
        <img id="notok2" src="images/notok.jpg" alt="error" style="display:none;">
    </div>
 <p><input type="submit" /></p>
</form>
</body>
</html>
