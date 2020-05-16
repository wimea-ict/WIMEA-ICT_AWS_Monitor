<?php

namespace station\Http\Middleware;

use Closure;
use ChannelLog as Log;

class LogRequestsAndReponses
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, \Closure  $next)
	{
        // dd($request['server']);
        // dd($request->header('User-Agent'));
        // dd($request->server('HTTP_REFERER'));
        // dd($request->fullUrl());
        // dd($request->all());
        // dd($request->user());
        /* 
        user-agent, referer, SERVER_ADDR, REMOTE_ADDR, SCRIPT_FILENAME, REDIRECT_URL
        */
		return $next($request);
	}

	public function terminate($request, $response)
	{
        // 'request' => $request->all(), 
        // 'response' => $response,
        Log::write('userAction', 'app.requests', [
            'user' => $request->user(),
            'User-Agent' => $request->header('User-Agent'),
            'REMOTE_ADDR' => $request->server('REMOTE_ADDR'),
            'HTTP_REFERER' => $request->server('HTTP_REFERER'),
            'URL' => $request->fullUrl(),
            'REQUEST_METHOD' => $request->server('REQUEST_METHOD'),
        ]);
		// Log::info('app.requests', ['request' => $request->all(), 'response' => $response]);
    }
    
}
