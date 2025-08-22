<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Ticket;
use Filament\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;

class LatestTickets extends TableWidget
{
    protected static ?int $sort = 1; // urutan widget di panel

    protected static ?string $heading = 'Latest Tickets'; // judul widget

    protected function getTableQuery(): Builder
    {
        return Ticket::latest()->limit(7); // ambil 7 tiket terbaru
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('title')->label('Title')->wrap(),
            TextColumn::make('status')->label('Status')->sortable(),
            TextColumn::make('priority')->label('Priority')->sortable(),
            TextColumn::make('user.name')->label('Reporter')->sortable(),
            TextColumn::make('created_at')->label('Created At')->dateTime('d-m-Y H:i'),
        ];
    }

    protected function getTableHeaderActions(): array
    {
        return [
            Action::make('view_all')
                ->label('Lihat Semua Ticket')
                ->url(route('filament.admin.resources.tickets.index'))
        ];
    }

    protected function getTableRecordActions(): array
    {
        return [
        ];
    }


    protected function getTableFilters(): array
    {
        return [];
    }

    protected function getTableToolbarActions(): array
    {
        return [];
    }
}
