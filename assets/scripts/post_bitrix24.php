<?php
$tel = $_POST['tel'];
// Настройте этот урл согласно вашей ссылке вебхука битрикс 24
$queryURLB24 = 'https://[ваш_поддомен_на_битрикс_24].bitrix24.kz/rest/[идентификатор_пользователья]/[код_вебхука]/crm.lead.add.json';

$queryData = http_build_query(array('fields' => array(
    'TITLE' => 'Заявка с сайта MARKGROUP-TEST.RU',
    "NAME" => 'User',
    'PHONE' => array('n0' => array(
        "VALUE" => "$tel",
        "VALUE_TYPE" => "WORK",
    ),),
), 'params' => array("REGISTER_SONET_EVENT" => "Y")));
$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_SSL_VERIFYPEER => 0,
    CURLOPT_POST => 1,
    CURLOPT_HEADER => 0,
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_URL => $queryURLB24,
    CURLOPT_POSTFIELDS => $queryData,
));
$result = curl_exec($curl);
curl_close($curl);
$result = json_decode($result, 1);
if (array_key_exists('error', $result)) echo "Ошибка при сохранении лида: " . $result['error_description'] . "<br/>>";
