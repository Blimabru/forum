<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidatorForm;
use App\Models\Reply;
use Illuminate\Http\Request;

class ReplyController extends Controller
{
    public function store(Request $request)
    {
        $reply = $request->all();
        $reply['user_id'] = 1;

        Reply::create($reply);

        return back()->with('flash', [
            'message' => 'Resposta enviada!',
            'type' => 'success',
        ]);
    }
}
