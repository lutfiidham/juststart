<?php

namespace App\Exceptions;

use Exception;
use Throwable;
use Illuminate\Http\Request;

class GeneralException extends Exception
{

    /**
     * @var
     */
    public $message;

    /**
     * GeneralException constructor.
     *
     * @param string         $message
     * @param int            $code
     * @param Throwable|null $previous
     */
    public function __construct($message = '', $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    /**
     * Report the exception.
     */
    public function report()
    {
        //
    }

    /**
     * Render the exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function render(Request $request)
    {
        // All instances of GeneralException redirect back with a flash message to show a bootstrap alert-error
        return $request->wantsJson() ? response()->json(['message' => $this->message,], 500)  : redirect()
            ->back()
            ->withInput()
            ->withErrors(['message' => $this->message,]);
    }
}
