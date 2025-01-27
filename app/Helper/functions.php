<?php

/**
 * Session expired, return to the login page
 * @return login view
 */
function loginExpired(){
    return redirect()->action('LoginController@index')
                     ->with(['notify' => true,
                             'type' => 'danger',
                             'title' => 'You have not logged in',
                             'message' => 'You have not logged in']);
}

function dateToDay($date){
    $week_array=array("Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday");
    return  $week_array[$date];
}

// encode
function encode($string = '', $skey = 'yuto2018') {
    $strArr = str_split(base64_encode($string));
    $strCount = count($strArr);
    foreach (str_split($skey) as $key => $value)
        $key < $strCount && $strArr[$key].=$value;
    return str_replace(array('=', '+', '/'), array('O0O0O', 'o000o', 'oo00o'), join('', $strArr));
 }

// decode
function decode($string = '', $skey = 'yuto2018') {
    try{
        $strArr = str_split(str_replace(array('O0O0O', 'o000o', 'oo00o'), array('=', '+', '/'), $string), 2);
        $strCount = count($strArr);
        foreach (str_split($skey) as $key => $value)
            $key <= $strCount  && isset($strArr[$key]) && $strArr[$key][1] === $value && $strArr[$key] = $strArr[$key][0];
        $result = base64_decode(join('', $strArr));
    }
    catch(Exception $e){
        return '';
    }
    if(encode($result,$skey)==$string){
        return $result;
    }else{
        return '';
    }
}

function getUserIcon($first_name, $last_name, $size = "md"){
    $classes = array('avatar-blue',
                     'avatar-azure',
                     'avatar-indigo',
                     'avatar-purple',
                     'avatar-pink',
                     'avatar-red',
                     'avatar-orange',
                     'avatar-yellow',
                     'avatar-lime',
                     'avatar-green');
    echo "<span style='cursor:pointer;' class='avatar avatar-".$size." ".$classes[mt_rand(0, 9)]."' title='".$first_name." ".$last_name."'>".strtoupper(substr($first_name, 0, 1 )).strtoupper(substr($last_name, 0, 1 ))."</span>";
}

function getTutorialTag($tutorial_name, $tutorial_day_in_week){
    $classes = array('tag-blue',
                     'tag-azure',
                     'tag-indigo',
                     'tag-purple',
                     'tag-pink',
                     'tag-red',
                     'tag-orange',
                     'tag-yellow',
                     'tag-lime',
                     'tag-green');
    echo "<span style='cursor:pointer;' class='tag ".$classes[$tutorial_day_in_week]."' title='".$tutorial_name."'>".strtoupper($tutorial_name)."</span>";
}

function getUosImage($uos_id, $uos_name){
    echo "<img src='/assets/images/gallery/".($uos_id%10+1).".jpg' alt='".$uos_name."' title='".$uos_name."'>";
}

function storeNotification($notification_user, $notification_type, $notification_content){
    // Insert into database
    DB::table('notification')->insert([
        'notification_user' => $notification_user,
        'notification_type' => $notification_type,
        'notification_content' => $notification_content,
        'notification_is_read' => 0,
        'notification_create_user' => Session::get('user_id'),
        'notification_create_time' => date('Y-m-d H:i:s')
    ]);
}
?>
                               
