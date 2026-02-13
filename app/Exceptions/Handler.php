<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use DomainException;

class Handler extends ExceptionHandler
{
  protected $dontReport = [
    // add exceptions you don't want to report
  ];

  protected $dontFlash = ['current_password', 'password', 'password_confirmation'];

  public function render($request, Throwable $exception)
  {
    if ($exception instanceof DomainException) {
      return redirect()
        ->back()
        ->withInput()
        ->with('flash', [
          'type' => 'danger',
          'message' => $exception->getMessage(),
        ]);
    }

    return parent::render($request, $exception);
  }
}
