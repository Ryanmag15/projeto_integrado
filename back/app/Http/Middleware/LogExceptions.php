<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Log; // Verifique se está importado corretamente
use Exception;

class LogExceptions
{
    public function handle(Request $request, Closure $next)
    {
        try {
            return $next($request);
        } catch (Exception $e) {
            Log::create([
                'message' => $e->getMessage(),
                'context' => json_encode($request->all()),
                'user_id' => auth()->check() ? auth()->id() : null,
                'ip_address' => $request->ip(),
                'http_method' => $request->method(),
                'url' => $request->fullUrl(),
                'level' => 'error',
                'stack_trace' => $e->getTraceAsString(),
            ]);

            return response()->json(['error' => 'An error occurred.'], 500);
        }
    }
}
