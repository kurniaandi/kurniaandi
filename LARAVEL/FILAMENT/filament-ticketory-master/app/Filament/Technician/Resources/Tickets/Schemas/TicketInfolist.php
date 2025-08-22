<?php

namespace App\Filament\Technician\Resources\Tickets\Schemas;

use Filament\Schemas\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Schemas\Schema;

class TicketInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // Informasi Utama
                Section::make('Ticket Info')
                    ->columns(3)
                    ->schema([
                        TextEntry::make('title')
                            ->label('Ticket Title')
                            ->placeholder('-'),

                        TextEntry::make('status')
                            ->label('Status')
                            ->badge()
                            ->color(fn(string $state): string => match ($state) {
                                'Open' => 'primary',
                                'Pending' => 'warning',
                                'Closed' => 'success',
                                'Overdue' => 'danger',
                                default => 'gray',
                            })
                            ->placeholder('Unknown'),

                        TextEntry::make('priority')
                            ->label('Priority')
                            ->badge()
                            ->color(fn(string $state): string => match ($state) {
                                'Low' => 'primary',
                                'Medium' => 'warning',
                                'High' => 'danger',
                                default => 'gray',
                            })
                            ->placeholder('Not Set'),

                        TextEntry::make('description')
                            ->label('Description')
                            ->placeholder('-'),
                    ]),

                // Detail Unit
                Section::make('Unit Details')
                    ->columns(2)
                    ->schema([
                        TextEntry::make('category.name')
                            ->label('Category')
                            ->placeholder('Uncategorized'),

                        TextEntry::make('unit.name')
                            ->label('Unit')
                            ->placeholder('No Unit'),

                        TextEntry::make('unit.location.name')
                            ->label('Unit Location')
                            ->placeholder('No Location'),
                    ]),

                // Assignment
                Section::make('Assignment')
                    ->columns(2)
                    ->schema([
                        TextEntry::make('user.name')
                            ->label('Reported By')
                            ->placeholder('Anonymous'),

                        TextEntry::make('technician.user.name')
                            ->label('Assigned Technician')
                            ->placeholder('Unassigned'),
                    ]),

                // Timeline
                Section::make('Timeline')
                    ->columns(2)
                    ->schema([
                        TextEntry::make('created_at')
                            ->label('Created At')
                            ->dateTime('d M Y H:i'),

                        TextEntry::make('updated_at')
                            ->label('Last Updated')
                            ->dateTime('d M Y H:i'),
                    ]),
                Section::make('Attachments')
                    ->columns(3)
                    ->schema([
                        ImageEntry::make('attachments')
                            ->label('First Attachment')
                            ->square()
                            ->imageSize(150)
                            ->disk('public')
                            ->visibility('public')
                            ->getStateUsing(
                                fn($record) =>
                                $record->attachments()
                                    ->oldest() // ambil yang paling lama
                                    ->first()?->file_path
                                    ? asset('storage/' . $record->attachments()->oldest()->first()->file_path)
                                    : null
                            )
                            ->defaultImageUrl(url('storage/default.jpg')),
                    ]),
            ]);
    }
}
