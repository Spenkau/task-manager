<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Events\ButtonClicked;
use Illuminate\Http\Request;

class ButtonClickedController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $message = 'test';

        ButtonClicked::dispatch($message);


//        broadcast(new ButtonClicked($message))->toOthers();
        return 'sent';
    }
}
