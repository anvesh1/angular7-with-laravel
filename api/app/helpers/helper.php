<?php

define("country_code", "");
define("super_admin_email", "anvesh@gmail.com");
define("google_notification_key", "AAAAwgSxe6c:APA91bHyKXer7GcH9l5IDegNrsOKTXPLOEveuXHfllkTiDTGrM5JtEcdUDb-WwzO6OvQ8NOjbcsyMJ-Lbn79aCBWNFwynfABeThAAV1PeairI2M0EeDNwJwJ7RaA7-YMgfN_iXVLMdf5");
define("pem_file", "atd.pem");
define("pass_phase", "");

function redirectMe($path){
    header('Location: /'.$path);exit;
}

function decodeQuery($queryToken)
{
    return unserialize(base64_decode($queryToken));
}


function encodeQuery($queryObject) {
    return base64_encode(serialize($queryObject));
}

function sendEmail($data){

    try{
        Mail::send($data['page'], $data, function ($message) use ($data) {
            $message->from('anvesh@aeologic.com', $data['title']);

            //$message->to($data['email']);
            $message->to(super_admin_email);

            $message->subject($data['title']);
        });

        return 0;
        //return redirect()->back()->with('status', 'Message Sent Successfully!');
    }catch(Exception $e){
        //echo $e->getMessage();exit;
        return 0;
    }

}


function addImage()
{
    $fileData = $_FILES;

    $response = array();

    foreach($fileData as $key => $param){

        if (isset($param["type"])) {
            $targetFolder = '/officer-image'; // Relative to the root

            $targetPath = $_SERVER['DOCUMENT_ROOT'] . $targetFolder;
            $imagePath = 'officer-image';
            $file_name = rand(999999, 999999999) . date("Y-m-d");

            $targetFile = rtrim($targetPath, '/') . '/' . $file_name;
            $fileParts = pathinfo($param['name']);
            //dd($fileParts);

            if (!file_exists(rtrim($targetPath, '/'))) {
                mkdir(rtrim($targetPath, '/'), 0777, true);
            }

            $imagePath = rtrim($imagePath, '/') . '/' . $file_name . '.' . $fileParts['extension'];

            $fileTypes = array('jpg', 'jpeg', 'gif', 'png', 'PNG', 'GIF', 'JPG', 'JPEG');

            if ((in_array($fileParts['extension'], $fileTypes))) {

                $sourcePath = $param['tmp_name'];
                move_uploaded_file($sourcePath, $targetFile . "." . $fileParts['extension']);

                $response[$key] = $imagePath;

            } else {
                $response[$key] = '';

            }

        }
    }

    return $response;

}

function sendIosNotification($registrationToken, $payload){
    foreach($registrationToken as $token){
        if(!$token){
            continue;
        }
        $ctx = stream_context_create();
        stream_context_set_option($ctx, 'ssl', 'local_cert', pem_file);
        stream_context_set_option($ctx, 'ssl', 'passphrase', pass_phase);

        // Open a connection to the APNS server
        $fp = stream_socket_client(
            'ssl://gateway.push.apple.com:2195', $err,
            $errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);

        if (!$fp)
            exit("<br/>Failed to connect: $err $errstr" . PHP_EOL);
//echo $token;exit;
        $msg = chr(0) . pack('n', 32) . pack('H*', $token) . pack('n', strlen($payload)) . $payload;

        // Send it to the server
        $pushResult = fwrite($fp, $msg, strlen($msg));
        fclose($fp);
        //return $pushResult;
    }
}

function sendPushNotification($registration_ids, $message) {

    $url = 'https://android.googleapis.com/gcm/send';
    $fields = array(
        'registration_ids' => $registration_ids,
        'data' => $message,
    );

    $txt = json_encode($fields);

    //\Illuminate\Support\Facades\Storage::put('file.txt', $txt);
    //echo json_encode($fields);exit;

    define('GOOGLE_API_KEY', google_notification_key);

    $headers = array(
        'Authorization:key=' . GOOGLE_API_KEY,
        'Content-Type: application/json'
    );
    //echo json_encode($fields);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

    $result = curl_exec($ch);

    $dataToReturn = array();
    if($result === false){
        //die('Curl failed ' . curl_error());
        $dataToReturn['statusCode']  = 503;
        $dataToReturn['message']     = 'Something Went Wrong.';
        return $dataToReturn;
    }

    curl_close($ch);
    $dataToReturn['status'] = 200;
    $dataToReturn['result']     = $result;
    $dataToReturn['message']    = 'Notification Sent Successfully.';
    return $dataToReturn;
    //return $result;
}
