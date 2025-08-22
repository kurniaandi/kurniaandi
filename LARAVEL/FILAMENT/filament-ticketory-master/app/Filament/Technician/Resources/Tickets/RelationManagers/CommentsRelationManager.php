<?php

namespace App\Filament\Technician\Resources\Tickets\RelationManagers;

use Filament\Actions\AssociateAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DissociateAction;
use Filament\Actions\DissociateBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class CommentsRelationManager extends RelationManager
{
    protected static string $relationship = 'comments';

    protected static ?string $recordTitleAttribute = 'comment';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                // hidden field user_id otomatis dari user login
                Hidden::make('user_id')
                    ->default(fn() => auth()->id()),

                // textarea untuk comment
                Textarea::make('comment')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('comment')
            ->columns([
                TextColumn::make('user.name')->label('User')->sortable(),
                TextColumn::make('comment')->searchable()->limit(50),
                TextColumn::make('created_at')->label('Created')->dateTime()->sortable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                CreateAction::make(),
                AssociateAction::make(),
            ])
            ->recordActions([
                EditAction::make()
                    ->visible(fn($record) => $record->user_id === auth()->id()),

                DissociateAction::make()
                    ->visible(fn($record) => $record->user_id === auth()->id()),

                DeleteAction::make()
                    ->visible(fn($record) => $record->user_id === auth()->id()),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DissociateBulkAction::make()
                        ->visible(fn() => false), // disembunyikan biar tidak bisa mass delete

                    DeleteBulkAction::make()
                        ->visible(fn() => false),
                ]),
            ]);
    }
}
