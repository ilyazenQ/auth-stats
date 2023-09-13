<?php

namespace App\Models;

use App\DTO\DTOInterface;
use App\DTO\Event\FilterDTO;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'is_auth', 'ip', 'user_id'];

    const AVAILABLE_AGGREAGATION = [
        'by_ip',
        'by_auth_status',
        'by_event_name'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function createFromDTO(DTOInterface $DTO): Event
    {
        return self::create([
            'user_id' => $DTO->user->id,
            'name' => $DTO->name,
            'is_auth' => $DTO->isAuth,
            'ip' => $DTO->ip
        ]);
    }

    public function scopeFilter($query, DTOInterface $filterDTO)
    {
        $query->where('name', '=',$filterDTO->name)
               ->whereDate('created_at', '>=', $filterDTO->dateFrom)
               ->whereDate('created_at', '<=', $filterDTO->dateTo);

        return $query;
    }

    public static function getCountByEventName(DTOInterface $filterDTO)
    {
        return self::filter($filterDTO)
            ->selectRaw('name, count(*) as count')
            ->groupBy('name')
            ->get();
    }

    public static function getCountByIp(DTOInterface $filterDTO)
    {
        return self::filter($filterDTO)
            ->selectRaw('ip, count(*) as count')
            ->groupBy('ip')
            ->get();
    }

    public static function getCountByAuthStatus(DTOInterface $filterDTO)
    {
        return self::filter($filterDTO)
            ->selectRaw('is_auth, count(*) as count')
            ->groupBy('is_auth')
            ->get();
    }
}
