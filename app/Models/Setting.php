<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\Intl\Currencies;
use Symfony\Component\Intl\Languages;
use Symfony\Component\Intl\Timezones;

class Setting extends Model
{
    protected $primaryKey = 'name';

    protected $keyType = 'string';

    public $incrementing = false;

    protected $fillable = ['name', 'value'];

    public function scopeGroup(Builder $builder, $group): void
    {
        if ($group !== null){
            $builder->where('name', 'LIKE', "{$group}.%");
        }
    }

    public static function localeOptions(): array
    {
        return Languages::getNames();
    }

    public static function timezoneOptions(): array
    {
        return Timezones::getNames();
    }

    public static function currencyOptions(): array
    {
//        foreach (Currencies::getNames() as $code => $name){
//            $currencies[$code] = "$code - $name";
//        }
//        return $currencies;

        return [
            'USD' => 'USD - US Dollar',
            'EUR' => 'EUR - Euro',
            'ILS' => 'ILS - New Shekel',
        ];
    }

}
