<?php

declare(strict_types=1);

namespace App\Http\Procedures;

use App\Mail\ResetPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Sajya\Server\Procedure;

class NotificationMailProcedures extends Procedure
{
    /**
     * The name of the procedure that will be
     * displayed and taken into account in the search
     *
     * @var string
     */
    public static string $name = 'notification-mail';

    /**
     * Execute the procedure.
     *
     * @param Request $request
     *
     * @return bool
     * @throws \Illuminate\Http\Client\HttpClientException
     */
    public function handle(Request $request)
    {
        Log::info('Новый запрос', $request->all());

        Mail::to($request->input('email'))->send(new ResetPassword($request->input('newPassword'), $request->input('email')));

        return 'ok';
    }
}
