<?php
header('Content-Type: text/html; charset=utf-8');
$array = require_once('config.php');
$config = require_once('config.php');
$back = $config['back_url'];
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
<div id="cboxOverlay" style="opacity: 0.85; cursor: pointer; visibility: visible; display: block;"></div>
<div id="colorbox" class="" role="dialog" tabindex="-1"
     style="display: block; visibility: visible; position: absolute; width: 562px; height: 815px; top: 50%; left: 50%; margin: -425px 0 0 -281px;  opacity: 1; cursor: auto;">
    <div id="cboxWrapper" style="text-align: left; height: 820px; width: 740px;">
        <div>
            <div id="cboxTopLeft" style="float: left;"></div>
            <div id="cboxTopCenter" style="float: left; width: 710px;"></div>
            <div id="cboxTopRight" style="float: left;"></div>
        </div>
        <div style="clear: left;">
            <div id="cboxMiddleLeft" style="float: left; height: 539px;"></div>
            <div id="cboxContent" style="float: left; width: 710px; height: 801px;">
                <div id="cboxLoadedContent" style="width: 710px; overflow: auto; height: 801px;">
                    <div id="webform" class="popup_form">
                        <form action="formcheck.php" class="webform-client-form" method="post" accept-charset="UTF-8" enctype="multipart/form-data" id="formdata" name="formdata">
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
                                <select name="VKR" id="edit-submitted-VKR" class="form-text required">
                                    <option selected="selected" disabled>Форма ВКР </option>
                                    <?php
                                    while ($work_type = current($array["work_type"])) {
                                        echo '<option>'.htmlspecialchars($work_type).'</option>';
                                        next($array["work_type"]);
                                    }
                                    ?>
                                </select>
                                <label for="edit-submitted-VKR" id="error4" class="error" style="display: none;">выберите, пожалуйста</label>
                            </div>
                            <div id="curators">
                                <div class="form-item webform-component webform-component-textfield" id="webform-component-curator">
                                    <label for="1">Научный руководитель (Фамилия, Имя, Отчество - полностью) <span class="form-required" title="Это поле обязательно для заполнения.">*</span></label>
                                    <input type="text" id="1" name="submittedcurator" value="" size="60" maxlength="128" class="form-text required" style="width:213px;">
                                    <label for="1" id="error-1" class="error" style="display: none;">заполните, пожалуйста</label>
                                </div>
                                <button type="button" id="cboxCuratorAdd">+ Добавить руководителя</button>
                            </div>
                            <div class="form-item webform-component webform-component-textfield" id="webform-component-institutes">
                                <label for="edit-submitted-institutes">Выберите институт <span class="form-required" title="Это поле обязательно для заполнения.">*</span></label>
                                <select name="institutes" id="edit-submitted-institute" class="form-text required">
                                    <option selected="selected" disabled>Выберите институт</option>
                                    <?php
                                    while ($institute = current($array["institute"])) {
                                        echo '<option>'.htmlspecialchars(key($array["institute"])).'</option>';
                                        next($array["institute"]);
                                    }
                                    reset($array["institute"]);
                                    ?>
                                </select>
                                <label for="edit-submitted-institutes" id="error7" class="error" style="display: none;">выберите, пожалуйста</label>
                            </div>
                            <div class="form-item webform-component webform-component-textfield" id="webform-component-kod">
                                <label for="edit-submitted-kod">Выберите код направления <span class="form-required" title="Это поле обязательно для заполнения.">*</span></label>
                                <select id="edit-submitted-kod" name="submittedkod" class="form-text required"\>
                                    <option selected="selected" disabled>Выберите код направления</option>
                                    <?php
                                    while ($institutes = current($array["institute"])) {
                                        while ($institute = current($array["institute"][key($array["institute"])])){
                                            echo '<option>'.htmlspecialchars(key($array["institute"][key($array["institute"])]))." ".htmlspecialchars($institute).'</option>';
                                            next($array["institute"][key($array["institute"])]);
                                        }
                                        next($array["institute"]);
                                    }
                                    ?>
                                </select>
                                <label for="edit-submitted-kod" id="error6" class="error" style="display: none;">заполните, пожалуйста</label>
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
                                <input type="hidden" name="MAX_FILE_SIZE" value="40000000" />
                                <input type="file" name="upfile" id="edit-submitted-vash-pdf" accept=".pdf">
                                <img id="ok2" src="images/ok.jpg" alt="ok" style="display:none;">
                                <img id="notok2" src="images/notok.jpg" alt="error" style="display:none;">
                            </div>
                         <p><input type="submit" value="Отправить"/></p>
                        </form>
                        <a href="<?php echo $back; ?>" class="close_popup" id="close_popup">Я передумал</a>
                    </div>
                </div>
                <div id="cboxTitle" style="float: left; display: none;"></div>
                <div id="cboxCurrent" style="float: left; display: none;"></div>
                <button type="button" id="cboxPrevious" style="display: none;"></button>
                <button type="button" id="cboxNext" style="display: none;"></button>
                <button id="cboxSlideshow" style="display: none;"></button>
                <div id="cboxLoadingOverlay" style="float: left; display: none;"></div>
                <div id="cboxLoadingGraphic" style="float: left; display: none;"></div>
                <button type="button" id="cboxClose">Close</button>
            </div>
            <div id="cboxMiddleRight" style="float: left; height: 539px;"></div>
        </div>
        <div style="clear: left;">
            <div id="cboxBottomLeft" style="float: left;"></div>
            <div id="cboxBottomCenter" style="float: left; width: 710px;"></div>
            <div id="cboxBottomRight" style="float: left;"></div>
        </div>
    </div>
    <div style="position: absolute; width: 9999px; visibility: hidden; display: none;"></div>
</div>
</body>
</html>
