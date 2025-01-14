<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler {
	/**
	 * A list of the exception types that should not be reported.
	 *
	 * @var array
	 */
	protected $dontReport = [
		\Illuminate\Auth\AuthenticationException::class,
		\Illuminate\Auth\Access\AuthorizationException::class,
		\Symfony\Component\HttpKernel\Exception\HttpException::class,
		\Illuminate\Database\Eloquent\ModelNotFoundException::class,
		\Illuminate\Session\TokenMismatchException::class,
		\Illuminate\Validation\ValidationException::class,
	];

	/**
	 * Report or log an exception.
	 *
	 * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
	 *
	 * @param  \Exception  $exception
	 * @return void
	 */
	public function report(Exception $exception) {
		parent::report($exception);
	}

	/**
	 * Render an exception into an HTTP response.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Exception  $exception
	 * @return \Illuminate\Http\Response
	 */
	public function render($request, Exception $exception) {

		return parent::render($request, $exception); //for development

		//for production
		if ($exception) {
			$exceptionName = basename(get_class($exception)); // catch exception name
			if ($this->isHttpException($exception)) {
				switch ($exception->getStatusCode()) {
				// not authorized
				case '403':
					return response()->view('errors.403', array(), 403);
					break;
				// not found
				case '404':
					return response()->view('errors.404', array(), 404);
					break;
				// internal error
				case '500':
					return response()->view('errors.500', array(), 500);
					break;

				default:
					return $this->renderHttpException($exception);
					break;
				}
			} else {
				return response()->view('errors.404', array(), 404); // catch missing page error but route exists
			}
		} else {
			return parent::render($request, $exception);
		}
	}

	/**
	 * Convert an authentication exception into an unauthenticated response.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Illuminate\Auth\AuthenticationException  $exception
	 * @return \Illuminate\Http\Response
	 */
	protected function unauthenticated($request, AuthenticationException $exception) {
		if ($request->expectsJson()) {
			return response()->json(['error' => 'Unauthenticated.'], 401);
		}
		return redirect()->guest(route('login'));
	}
}
