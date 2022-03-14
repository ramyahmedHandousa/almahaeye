<?php

namespace App\Support;

use Illuminate\Http\JsonResponse;

class JsonResponder
{
    public function success($body, array $extra = []) : JsonResponse
    {
        return $this->base($body, $extra);
    }

    public function error($body, array $extra = []) : JsonResponse
    {
        return $this->base($body, $extra, 400);
    }

    public function executed() : JsonResponse
    {
        return $this->success(__('Request executed successfully'));
    }

    public function failed() : JsonResponse
    {
        return $this->error(__('Request failed to be executed'));
    }

    private function base($body, array $extra, bool|int $status = 200) : JsonResponse
    {
        $bodyAttribute = $status == 400 ? 'errors' : (is_string($body) ? 'message' : 'body');
        $response = [
            'status'       => $status,
            $bodyAttribute => $body,
        ];

        if (count($extra) > 0) {
            $response['extra'] = $extra;
        }

        return response()->json($response,$status !== 400?200:400);
    }


}
