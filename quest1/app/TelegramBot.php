<?php

namespace App;

class TelegramBot
{
    private $tokenTelegram;
    private $tokenLeads;

    public function __construct($tokenTelegram, $tokenLeads) {
        $this->tokenTelegram = $tokenTelegram;
        $this->tokenLeads = $tokenLeads;
    }

    public function handleRequest() {
        $update = json_decode(file_get_contents('php://input'), true);

        if ($update === false) {
            $this->handleError("Failed to parse JSON data.");
            return;
        }

        file_put_contents('file.txt', $update);

        if (isset($update['message'])) {
            $message = $update['message'];

            if (isset($message['text'])) {
                $text = $message['text'];
                $chatId = $message['chat']['id'];

                if ($text == '/getCountries') {
                    $countries = $this->getCountries();

                    if ($countries === false) {
                        $this->handleError("Failed to get countries data.");
                        return;
                    }

                    $reply = "Первые 10 стран:\n" . implode("\n", $countries);
                    $this->sendMessage($chatId, $reply);
                } elseif ($text == '/getUser') {
                    $userInfo = $this->getUserInfo();

                    if ($userInfo === false) {
                        $this->handleError("Failed to get user info.");
                        return;
                    }

                    $reply = "User ID: " . $userInfo['id'] . "\nUser Name: " . $userInfo['name'];
                    $this->sendMessage($chatId, $reply);
                }
            }
        }
    }

    private function getCountries() {
        $url = 'https://api.leads.su/webmaster/geo/getCountries?token=' . $this->tokenLeads;
        $response = json_decode(file_get_contents($url), true);

        if ($response === false) {
            $this->handleError("Failed to fetch countries data from API.");
            return false;
        }

        $sortedCountries = array_column($response, 'name');
        array_multisort($sortedCountries, SORT_DESC, $response);

        return array_slice($sortedCountries, 0, 10);
    }

    private function getUserInfo() {
        $url = 'https://api.leads.su/webmaster/account?token=' . $this->tokenLeads;
        $userInfo = json_decode(file_get_contents($url), true);

        if ($userInfo === false) {
            $this->handleError("Failed to fetch users data from API.");
            return false;
        }

        return $userInfo;
    }

    private function sendMessage($chatId, $text) {
        $url = 'https://api.telegram.org/bot' . $this->tokenTelegram . '/sendMessage';
        $data = http_build_query(['chat_id' => $chatId, 'text' => $text]);
        file_get_contents($url . '?' . $data);
    }

    private function handleError($errorMessage) {
        error_log($errorMessage);
    }
}