<?php

namespace App\Filament\Widgets;

use App\Models\Asset;
use App\Models\Vendor;
use App\Models\Unit;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class OverviewStats extends BaseWidget
{
    protected static ?int $sort = 1; // posisi urutan widget di dashboard

    protected function getStats(): array
    {
        return [
            Stat::make('Total Asset', Asset::count())
                ->description('Jumlah semua aset yang tercatat')
                ->descriptionIcon('heroicon-m-cube')
                ->color('success'),

            Stat::make('Total Vendor', Vendor::count())
                ->description('Vendor terdaftar')
                ->descriptionIcon('heroicon-m-building-storefront')
                ->color('info'),

            Stat::make('Total Unit', Unit::count())
                ->description('Unit / lokasi penyimpanan')
                ->descriptionIcon('heroicon-m-building-office')
                ->color('warning'),
        ];
    }
}
