<?php

namespace App\Services\Codes;

use App\Constants\AuthConstant;
use App\Models\Code;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CodeService
{
    /**
     * Create user
     *
     * @param request
     * @return
     */
    public function createCode($request)
    {
        Code::create($request->all());
    }

    /**
     * Update Code
     *
     * @param request
     * @param Code_id
     * @return
     */
    public function updateCode($request, $id)
    {
        $code = Code::where('id', $id)->first();
        $code->update($request->all());
    }
}
