<?php

namespace App\Filament\Admin\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Ticket;

class TicketStatusChart extends ChartWidget
{
    protected ?string $heading = 'Ticket Status Chart';

    protected function getType(): string
    {
        return 'line';
    }

    protected function getData(): array
    {
        // Daftar status
        $statuses = [
            'open' => 'Open',
            'in_progress' => 'In Progress',
            'pending' => 'Pending',
            'resolved' => 'Resolved',
            'rejected' => 'Rejected',
        ];

        // Hitung jumlah ticket per status
        $counts = [];
        foreach ($statuses as $key => $label) {
            $counts[$label] = Ticket::where('status', $key)->count();
        }

        return [
            'labels' => array_keys($counts),
            'datasets' => [
                [
                    'label' => 'Jumlah Ticket',
                    'data' => array_values($counts),
                    'backgroundColor' => [
                        '#f59e0b', // open
                        '#3b82f6', // in_progress
                        '#f97316', // pending
                        '#10b981', // resolved
                        '#ef4444', // rejected
                    ],
                ],
            ],
        ];
    }
}
