<?php
require($_SERVER["DOCUMENT_ROOT"] . '/bitrix/modules/main/include/prolog_before.php');
\Bitrix\Main\Loader::includeModule("iblock"); ///Подключаем модуль информационного блока

$step = 0;
$arSelect = array("ID");   ///Выбор только поля ID
$arFilter = array("IBLOCK_ID" => 5, "ACTIVE" => "Y"); ///Указываем необходимый инфоблок и выбираем только активные элементы
$prop = [];
$res = CIBlockElement::GetList(array(), $arFilter, false, array(), $arSelect); ///Получаем результат всех элементов
while ($ob = $res->GetNextElement()) {
    $arFields = $ob->GetFields();
    $step++;

    if ($arFields['ID'] >= 30000 && $arFields['ID'] <= 35000) { ///При необходимости указываем диапазон элементов



        $ress = CIBlockElement::GetProperty(5, $arFields['ID'], "sort", "asc", array()); ///Получаем все свойства элемента

        while ($obb = $ress->GetNext()) {

            $prop[$obb['ID']] = $obb['VALUE'];



        }
                $prop[3657] = 67; ///У необходимого свойства меняем значение

        $arLoadProductArray = array( ///Заполняем массив параметров и передаём ему новый массив свойств
            "MODIFIED_BY" => $GLOBALS['USER']->GetID(), // элемент изменен текущим пользователем
            "PROPERTY_VALUES" => $prop,
        );

        $el = new CIBlockElement;
        $ressss = $el->Update($arFields['ID'], $arLoadProductArray); ///Обновляем элемент, передавая ID и набор параметров

    }
}
