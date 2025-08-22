<?php

namespace App\Filament\Technician\Resources\Tickets\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Schema;
use App\Models\Technician;
use Illuminate\Support\Facades\Auth;

class TicketForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                TextInput::make('title')
                    ->required(),
                Repeater::make('attachments')
                    ->relationship('attachments')
                    ->label('Attachments (opsional)')
                    ->schema([
                        Hidden::make('user_id')
                            ->default(fn() => auth()->id()),

                        FileUpload::make('file_path')
                            ->label('Upload Image')
                            ->image() // kalau hanya ingin gambar, hapus jika boleh semua file
                            ->nullable(), // tidak wajib diisi
                        // ->required(), // hapus ini
                    ])
                    ->columns(1),
                Textarea::make('description')
                    ->required()
                    ->columnSpanFull(),
                Select::make('unit_id')
                    ->label('Unit')
                    ->relationship('unit', 'name') // pakai relasi di model Ticket -> unit()
                    ->required(),
                Select::make('status')
                    ->options([
                        'open' => 'Open',
                        'in_progress' => 'In progress',
                        'pending' => 'Pending',
                        'resolved' => 'Resolved',
                        'rejected' => 'Rejected',
                    ])
                    ->default('open')
                    ->required(),

                Select::make('priority')
                    ->options([
                        'low' => 'Low',
                        'medium' => 'Medium',
                        'high' => 'High',
                        'critical' => 'Critical',
                    ])
                    ->default('medium')
                    ->required(),

                Select::make('category_id')
                    ->label('Category')
                    ->relationship('category', 'name')
                    ->searchable()
                    ->required(),

                Hidden::make('user_id')
                    ->default(fn() => Auth::id()),

                Select::make('assigned_to')
                    ->label('Assigned Technician')
                    ->options(
                        Technician::with('user')->get()->pluck('user.name', 'id')
                    )
                    ->searchable()
                    ->nullable(),
            ]);
    }
}
