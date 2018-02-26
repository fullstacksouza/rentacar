<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate \ Database \ QueryException;
use Symfony\Component\HttpKernel\Exception\HttpException;
class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        if($exception instanceof  QueryException)
        {
            return redirect()->back()->with('database_connect_error','Erro ao conectar com o banco de dados, por favor verifique a conexão com o servidor e tente novamente');
        }
        else if($exception instanceof HttpException)
        {
            return redirect()->back()->with('unauthorized',
            'Você não tem permissão para acessar essa página. Entre em contato com o Administrador(a) para mais detalhes');
        }

        return parent::render($request, $exception);
    }
}
