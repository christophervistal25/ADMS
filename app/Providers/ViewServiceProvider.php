<?php

namespace App\Providers;

use App\Appointment;
use App\Doctor;
use Carbon\Carbon;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('admin.*', function ($view) {
            $timeNow = Carbon::parse();
            $appointmentsForToday = Appointment::with(['service', 'doctor', 'patients'])
                                            ->whereDate('start_date', date('Y-m-d'))
                                            ->get();
            $view->with('noOfAppointmentsToday', $appointmentsForToday->count());
            $view->with('appointmentsToday', $appointmentsForToday);
        });
    }
}
