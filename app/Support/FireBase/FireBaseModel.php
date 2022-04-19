<?php

namespace App\Support\FireBase;

use Illuminate\Support\Facades\Log;

class FireBaseModel
{
    public array $androidTokens = [];

    public array $iosTokens = [];

    public function __construct(
        public string $type,
        public string $title,
        public string $message,
        public ?array $relatedData = null,
        public string $action = ''
    ) { }

    public function setTokens(array $tokens) : void
    {
        $collection = collect($tokens);
        $this->iosTokens = $collection->where('device_type', '=','ios')->pluck('device')->all();
        $this->androidTokens = $collection->where('device_type','=', 'android')->pluck('device')->all();
    }

    public function toData() : array
    {
        return [
            'type'         => $this->type,
            'title'        => $this->title,
            'body'          => $this->message,
            'related_data' => $this->relatedData,
            'icon'         => asset('icon.png'),
        ];
    }

    public function toMessage() : array
    {
        return [
            'title'        => $this->title,
            'body'         => $this->message,
            'click_action' => $this->action,
            "sound"        => "default",
        ];
    }
}
