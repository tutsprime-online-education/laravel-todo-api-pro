<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Carbon;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function tasksSummary($fromStr)
    {
        return $this->tasks()
            ->when($fromStr === 'today', function ($query) {
                $query->whereDate('created_at', Carbon::today());
            })
            ->when($fromStr === 'yesterday', function ($query) {
                $query->whereDate('created_at', Carbon::yesterday());
            })
            ->when($fromStr === 'thisweek', function ($query) {
                $query->whereBetween('created_at', [Carbon::today()->subDays(6), Carbon::now()]);
            })
            ->when($fromStr === 'lastweek', function ($query) {
                $query->whereBetween('created_at', [Carbon::today()->subDays(13), Carbon::today()->subDays(7)]);
            })
            ->when($fromStr === 'thismonth', function ($query) {
                $query->whereBetween('created_at', [new Carbon('first day of this month'), new Carbon('last day of this month')]);
            })
            ->when($fromStr === 'lastmonth', function ($query) {
                $query->whereBetween('created_at', [new Carbon('first day of last month'), new Carbon('last day of last month')]);
            })
            ->latest()
            ->get();
    }
}
