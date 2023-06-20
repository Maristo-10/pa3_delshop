<?php

namespace App\Providers;

use App\Models\Notification;
use App\Models\User;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Config;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $notificationsAll = Notification::all();
        $mergedValue = "";

        foreach ($notificationsAll as $notification) {
            $data = json_decode($notification->data, true);

            if (isset($data['data'])) {
                if (strpos($data['data'], 'Diproses') !== false) {
                    $dataPesanan = $data['data'];
                    $array = explode(" ", $dataPesanan);
                    $mergedValue = implode(" ", array_slice($array, 2, 2));
                    $arrayBaru = explode(" ", $mergedValue);
                // $dataToShow = "ada " . $arrayBaru[0] . " baru id " . $arrayBaru[1];
                // dd($dataToShow);
                }
            }
        }
        // dd($mergedValue);
        // $notifications = Notification::where('data->data', 'like', '%' . $mergedValue . '%')->get();
        // $count = count($notifications);
        View::composer('*', function ($view) use ($mergedValue) {
            $notifications = Notification::where('data->data', 'like', '%' . $mergedValue . '%')
            ->whereNull('read_at')
            ->get();
            $count = count($notifications);

            $view->with('notifications', $notifications);
            $view->with('count', $count);
        });

        Paginator::useTailwind();
        Schema::defaultStringLength(500);
    }
}
