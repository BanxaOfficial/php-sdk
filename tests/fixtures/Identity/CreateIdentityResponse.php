<?php

namespace Tests\fixtures\Identity;

use Tests\fixtures\BaseResponse;

class CreateIdentityResponse extends BaseResponse
{
    public static function success(): bool|string
    {
        return json_encode([
            "data" => [
                "account" => [
                    "account_id"        => "28d517af407a0566204acd75e3a8e5b7",
                    "account_reference" => "test001001"
                ]
            ]
        ]);
    }
}