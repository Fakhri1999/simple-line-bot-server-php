<?php
defined('BASEPATH') or exit('No direct script access allowed');

class API extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    // require_once APPPATH . "/vendor/linecorp/line-bot-sdk/src/LINEBot.php";
    // require_once APPPATH . "/vendor/linecorp/line-bot-sdk/src/LINEBot/HTTPClient/CurlHTTPClient.php";

    $httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient(getenv('CHANNEL_ACCESS_TOKEN'));
    $bot = new \LINE\LINEBot($httpClient, ['channelSecret' => getenv('CHANNEL_SECRET')]);
  }

  public function chat()
  {
    $body = $this->input->post();
    $data = json_decode($body, true);
    foreach ($data['events'] as $event) {
      $userMessage = $event['message']['text'];
      if (strtolower($userMessage) == 'halo') {
        $message = "Halo juga";
        $textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($message);
        $result = $bot->replyMessage($event['replyToken'], $textMessageBuilder);
        return $result->getHTTPStatus() . ' ' . $result->getRawBody();
      }
    }
  }
}
