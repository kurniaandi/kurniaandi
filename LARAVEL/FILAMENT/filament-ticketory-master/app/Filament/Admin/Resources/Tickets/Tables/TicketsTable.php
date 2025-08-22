<?php

namespace App\Filament\Admin\Resources\Tickets\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class TicketsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->searchable()
                    ->label('Title'),

                TextColumn::make('status')
                    ->label('Status')
                    ->sortable(),

                TextColumn::make('priority')
                    ->label('Priority')
                    ->sortable(),

                // tampilkan nama kategori
                TextColumn::make('category.name')
                    ->label('Category')
                    ->sortable()
                    ->searchable(),

                // tampilkan nama user pembuat tiket
                TextColumn::make('user.name')
                    ->label('Reporter')
                    ->sortable()
                    ->searchable(),

                // tampilkan nama teknisi assigned
                TextColumn::make('technician.user.name')
                    ->label('Assigned Technician')
                    ->sortable()
                    ->searchable()
                    ->default('Unassigned'),

                TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->label('Updated At')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
