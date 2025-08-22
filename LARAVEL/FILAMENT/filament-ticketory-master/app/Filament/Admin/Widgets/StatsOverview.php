<?php

namespace App\Filament\Admin\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Category;
use App\Models\Technician;
use App\Models\Ticket;
use Filament\Support\Icons\Heroicon;

class StatsOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Categories', Category::count())
                ->description('Jumlah kategori ticket')
                ->color('primary')
                ->icon('heroicon-o-tag'),

            Stat::make('Total Technicians', Technician::count())
                ->description('Jumlah teknisi')
                ->color('success')
                ->icon('heroicon-o-user-group'), // <— string ikon

            Stat::make('Total Tickets', Ticket::count())
                ->description('Jumlah semua ticket')
                ->color('warning')
                ->icon('heroicon-o-document-text') // <— string ikon

        ];
    }
}
