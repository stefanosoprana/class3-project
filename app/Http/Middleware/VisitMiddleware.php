<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Validator;
use App\Visit;
use Carbon\Carbon;
use Closure;

class VisitMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //Salvo id appartamento passato in route
        $apartment_id = $request->route()->parameters();
        $request['apartment_id'] = $apartment_id['id'];
        //creo nuova Visit
        $new_visit = new Visit();

        /*
         * Elvis Operator
         * ?: prende il nome di Elvis operator ed è un operatore condizionale utilizzabile anche per il self-checking delle variabili.
         * Esempio:
         * Ternario
         * $varOne   = isset($_GET['var_one']) ? $_GET['var_one'] : null;
         * Elvis
         * $varOne   = $_GET['var_one'] ?: null;
         * Se $_GET['var_one'] esiste allora prende il suo valore altrimenti è nullo
        */

        //Salvo l'ip dell'utente nella variabile $request
        $request['ip']  = $_SERVER['REMOTE_ADDR'] ?:($_SERVER['HTTP_X_FORWARDED_FOR'] ?: $_SERVER['HTTP_CLIENT_IP']);

        //Salvo data corrente
        $now = Carbon::now();

        //chiamo DB cercando per IP
        $visit = Visit::where('ip',  $request['ip'])->first();

        $request['created_at'] = $now->toDateTimeString();
        $request['updated_at'] = $now->toDateTimeString();
        $data = $request->all();

        $validate_data = Validator::make($data, [
            'ip' => 'required|ip',
            'created_at' => 'required|date',
            'updated_at' => 'required|date',
        ]);

        //se l'ip non è presente nel DB
        if(!isset($visit))
        {
            $new_visit->fill($data);
            $new_visit->save();
        }
        //se l'ip è presente
        else
        {
            $visit_created_at = Carbon::parse($visit['created_at']);
            $diff = $visit_created_at->diffInMinutes($now, true);
            //se sono passati almeno 30 minuti salvo
            if ($diff > 30){
                $new_visit->fill($data);
                $new_visit->save();
            }
        }

        return $next($request);
    }
}
