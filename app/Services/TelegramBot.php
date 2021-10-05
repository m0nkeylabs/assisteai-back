<?php

namespace App\Services;

use App\Models\Thread;
use Curl\Curl;
use Illuminate\Support\Str;

class TelegramBot
{

    private $url;

    public function getUpdates()
    {
        $this->url = 'https://api.telegram.org/bot' . env('TELEGRAM_TOKEN') . '/getUpdates';

        return $this->execute();
    }

    public function sendMessage(Thread $thread)
    {
        $this->url = 'https://api.telegram.org/bot' . env('TELEGRAM_TOKEN') . '/sendMessage';

        if($thread->comment !== null) {
            $content = $thread->comment;
        } else {
            $content = $this->shorten($thread->movie->description, 180);
        }

        $data = [
            'chat_id'    => env('TELEGRAM_CHATID'),
            'text'       => '[' . $thread->movie->original_title . ' (' . $thread->movie->year . ')](https://beta2.assisteai.com.br/' . $thread->movie->id . '-' . $thread->movie->slug . ')' . PHP_EOL . PHP_EOL .
                '_' . $content . '_' . PHP_EOL . PHP_EOL .
                '*' . $thread->rating . '* - ' . $thread->user->name,
            'parse_mode' => 'Markdown',
            'disable_web_page_preview' => true,
        ];

        return $this->execute($data);
    }

    private function execute($data = null)
    {
        $curl = new Curl();
        if($data !== null) {
            $result = $curl->post($this->url, $data);
        } else {
            $result = $curl->get($this->url);
        }
        $curl->close();

        return $result;
    }

    /**
     * Shorten given string and append "..." to the end.
     *
     * @param string $string
     * @param int    $max_size
     * @return string
     */
    private function shorten(string $string, int $max_size): string
    {
        return rtrim(mb_substr($string, 0, $max_size), ' .,;:-/\\') . '...';
    }

}
