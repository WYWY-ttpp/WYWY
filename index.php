<?php


$API_URL = 'https://api.line.me/v2/bot/message';
$ACCESS_TOKEN = '+LjQiy894dplPI88P7QcbrkHy2E8hHZY+bmoOzNPudPv4VejxQrQAdRVEb+Tb1E6t7CRCtBw/1EVkV+q91rPlXn+9daCONVUYrAK+6N+ARJtNSVspABxKe+fb/sJuoTznzeRZ2I6Y23kUtx6/VVQZQdB04t89/1O/w1cDnyilFU='; 
$channelSecret = '9ac035e64b4ad4628310ef7121ff625a';


$POST_HEADER = array('Content-Type: application/json', 'Authorization: Bearer ' . $ACCESS_TOKEN);

$request = file_get_contents('php://input');   // Get request content
$request_array = json_decode($request, true);   // Decode JSON to Array



if ( sizeof($request_array['events']) > 0 ) {

    foreach ($request_array['events'] as $event) {

        $reply_message = '';
        $reply_token = $event['replyToken'];

        $text = $event['message']['text'];
        
        $a = '';
        
        if($text=='ชอบเจ้าหญิงองค์ไหนคะ'){
            $a = 'สโนว์ไวท์จ้ะ';
        }
        else{
             $a = 'ฉันชอบเจ้าชาย';
        }
        
        $data = [
            'replyToken' => $reply_token,
            // 'messages' => [['type' => 'text', 'text' => json_encode($request_array) ]]  Debug Detail message
            'messages' => [['type' => 'text', 'text' => $a ]]
        ];
        $post_body = json_encode($data, JSON_UNESCAPED_UNICODE);

        $send_result = send_reply_message($API_URL.'/reply', $POST_HEADER, $post_body);

        echo "Result: ".$send_result."\r\n";
    }
}

echo "OK";




function send_reply_message($url, $post_header, $post_body)
{
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $post_header);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_body);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    $result = curl_exec($ch);
    curl_close($ch);

    return $result;
}

?>
