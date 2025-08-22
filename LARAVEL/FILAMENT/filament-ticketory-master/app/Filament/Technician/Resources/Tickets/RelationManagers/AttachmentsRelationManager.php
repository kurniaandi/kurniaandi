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
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Tables\Columns\ImageColumn;

class AttachmentsRelationManager extends RelationManager
{
    protected static string $relationship = 'attachments';

    protected static ?string $recordTitleAttribute = 'file_path';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Hidden::make('user_id')
                    ->default(fn() => auth()->id()),

                FileUpload::make('file_path')
                    ->label('Image')
                    ->image() // hanya untuk gambar
                    ->directory('ticket-attachments') // folder penyimpanan
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('file_path')
            ->columns([
                TextColumn::make('user.name')->label('Uploaded By')->sortable(),
                ImageColumn::make('file_path')->label('Preview')->disk('public'),
                TextColumn::make('created_at')->label('Uploaded')->dateTime()->sortable(),
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
                        ->visible(fn() => false), // sembunyikan bulk action

                    DeleteBulkAction::make()
                        ->visible(fn() => false),
                ]),
            ]);
    }
}
