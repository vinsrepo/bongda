<?php
/**
 * Get date with format has 'ago' string
 *
 * @param $date
 * @param $check
 *
 * @return string
 */
function getDateFormatAgo($date, $check = false)
{
    if (!$check) {
        $date = date('Y-m-d H:i:s', strtotime($date));
    }
    $ago = 'trước';
    $date = strtotime($date);
    $diff = time() - ($date - 1);
    $times = [];
    $timeleft = [];
    $times[] = ['năm', 'năm', 31557600];
    $times[] = ['tháng', 'tháng', 2592000];
    $times[] = ['ngày', 'ngày', 86400];
    $times[] = ['giờ', 'giờ', 3600];
    $times[] = ['phút', 'phút', 60];
    $times[] = ['giây', 'giây', 1];
    foreach ($times as $timedata) {
        list($time_sing, $time_plur, $offset) = $timedata;
        if ($diff >= $offset) {
            $left = floor($diff / $offset);
            $diff -= ($left * $offset);
            $timeleft[] = "{$left} " . ($left == 1 ? $time_sing : $time_plur) . ' ' . $ago;
        }
    }

    return $timeleft[0];
}


/**
 * Send notification
 *
 * @param $message
 * @param $users
 * @param $additionData
 */
function notification($message, $users, $additionData)
{
    OneSignal::sendNotificationUsingTags(
        $message,
        [
            ["field" => "tag", "key" => "userId", "relation" => "=", "value" => $users],
        ],
        $url = null,
        $data = $additionData,
        $buttons = null,
        $schedule = null
    );
}

/**
 * Regax name
 * @return string
 */
function regexName()
{
    $regex = "regex:/^[ A-Za-z_ÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóô
    õùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềềểỄỆỈỊỌỎỐỒỔỖỘ
    ỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ]+$/u";
    return $regex;
}

/**
 * Regax phone The password has lowercase|uppercase characters
 * @return string
 */
function regexPass()
{
    $regex = "regex:/^.*(?=.{1,})(?=.*[a-zA-Z]).*$/";
    return $regex;
}

/**
 * Get Name By Model
 *
 * @param Model
 * @return var
 */
function nameByModel($model = false)
{
    $name = '';
    if ($model) {
        $arr_model = explode("\\", $model);
        $name = $arr_model[count($arr_model) - 1];
    }
    return $name;
}
