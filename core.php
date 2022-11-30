<?php
if (empty($_POST['title']) && empty($_POST['category']) && empty($_POST['type'])) {
    echo 'Не все поля заполнены';
    return;
}

require_once(__DIR__ . '/vendor/autoload.php');

use App\Bitrix24\Bitrix24API;
use App\Bitrix24\Bitrix24APIException;

try {
    $bx24 = new Bitrix24API('https://b24-iqydwq.bitrix24.ru/rest/1/5rnc74o2zy1bj5j3/');

    $current_date = new DateTime();
    $date_for_deal_end = clone($current_date);
    $date_for_deal_end->add(new DateInterval('P30D'));

    $comments = '';

    $comments .= 'Заголовок заявки: ' . $_POST['title'] . '<br>';

    switch ($_POST['category']) {
        case 'consumables':
            $comments .= 'Категория: Масла, автохимия, фильтры, Автоаксессуары, обогреватели, запчасти, сопутствующие товары.<br>';
            break;
        
        case 'wheels':
            $comments .= 'Категория: Шины, диски.<br>';
            break;
    }

    switch ($_POST['type']) {
        case 'price_delivery':
            $comments .= 'Вид заявки: Запрос цены и сроков доставки.<br>';
            break;
        
        case 'replenishment':
            $comments .= 'Вид заявки: Пополнение складов.<br>';
            break;
        
        case 'special_orders':
            $comments .= 'Вид заявки: Спецзаказ.<br>';
            break;
    }

    if (!empty($_POST['stock'])) {
        
        switch ($_POST['stock']) {
            case '1':
                $comments .= 'Склад поставки: Склад 1.<br>';
                break;
            
            case '2':
                $comments .= 'Склад поставки: Склад 2.<br>';
                break;
            
            case '3':
                $comments .= 'Склад поставки: Склад 3.<br>';
                break;
        }
    }

    $comp_str = '';

    foreach ($_POST as $key => $value) {
        
        if (stristr($key, 'brand') && !empty($value)) {

            switch ($value) {
                case 'brand_1':
                    $comp_str .= '  Бренд: Бренд 1.<br>';
                    break;
                
                case 'brand_2':
                    $comp_str .= '  Бренд: Бренд 2.<br>';
                    break;
                
                case 'brand_3':
                    $comp_str .= '  Бренд: Бренд 3.<br>';
                    break;
                
            }
        }
        
        if (stristr($key, 'comp_title') && !empty($value)) {
            $comp_str .= '  Наименование: ' . $value . '<br>';
        }
        
        if (stristr($key, 'comp_count') && !empty($value)) {
            $comp_str .= '  Количество: ' . $value . '<br>';
        }
        
        if (stristr($key, 'comp_packaging') && !empty($value)) {
            $comp_str .= '  Фасовка: ' . $value . '<br>';
        }
        
        if (stristr($key, 'comp_client') && !empty($value)) {
            $comp_str .= '  Клиент: ' . $value . '<br>';
        }
    }

    if (!empty($comp_str)) {
        $comments .= 'Состав заявки: <br>' . $comp_str;
    }

    if ($_FILES['upload_file']['error'] === 0) {
        
        $info = pathinfo($_FILES['upload_file']['name']);
        $ext = $info['extension'];
        $newname = $info['filename'] . '__' . rand(0, 1000) . '.' . $ext; 

        $target = 'files/'.$newname;
        move_uploaded_file($_FILES['upload_file']['tmp_name'], $target);  
    }

    if (!empty($target)) {
        $comments .= 'Файл: ' . $_SERVER['SERVER_NAME'] . '/' . $target . '<br>';
    }

    if (!empty($_POST['comment'])) {
        $comments .= 'Комментарий: ' . $_POST['comment'];
    }

    $bx24->addDeal(
        [
            "TITLE" => $_POST['title'],
            "TYPE_ID" => "GOODS",
            "OPENED" => "Y",
            "STAGE_ID" => "NEW",
            "CATEGORY_ID" => $_POST['category'],
            "CONTACT_ID" => 1,
            "CREATED_BY_ID" => 1,
            "ASSIGNED_BY_ID" => 1,
            "COMMENTS" => !empty($comments)
                ? $comments
                : '',
            "BEGINDATE" => $current_date->format('Y-m-d H:i:s'),
            "CLOSEDATE" => $date_for_deal_end->format('Y-m-d H:i:s')
        ],
        [
            'REGISTER_SONET_EVENT' => 'Y'
        ]
    );

    echo '<h1>Заявка успешно отправлена!</h1>';

} catch (Bitrix24APIException $e) {
    printf('1Ошибка (%d): %s' . PHP_EOL, $e->getCode(), $e->getMessage());
  } catch (Exception $e) {
    printf('2Ошибка (%d): %s' . PHP_EOL, $e->getCode(), $e->getMessage());
  }