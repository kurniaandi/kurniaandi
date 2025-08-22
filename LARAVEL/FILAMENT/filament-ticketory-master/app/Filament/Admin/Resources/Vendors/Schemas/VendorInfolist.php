<?php

namespace App\Filament\Admin\Resources\Vendors\Schemas;

use Filament\Schemas\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class VendorInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Vendor')
                    ->columns(2)
                    ->schema([
                        TextEntry::make('name')
                            ->label('Nama Vendor')
                            ->extraAttributes(['class' => 'font-bold']),
                        TextEntry::make('address')
                            ->label('Alamat')
                            ->columnSpanFull(),
                    ]),


                Section::make('Kontak Vendor')
                    ->columns(2)
                    ->schema([
                        TextEntry::make('phone')
                            ->label('No. Telepon'),
                        TextEntry::make('email')
                            ->label('Email address'),
                        TextEntry::make('website')
                            ->label('Website'),
                        TextEntry::make('contact_person')
                            ->label('Contact Person'),
                    ]),

                Section::make('Metadata')
                    ->columns(2)
                    ->collapsed() // biar ringkas, bisa di-expand
                    ->schema([
                        TextEntry::make('created_at')
                            ->label('Dibuat')
                            ->dateTime(),
                        TextEntry::make('updated_at')
                            ->label('Terakhir diperbarui')
                            ->dateTime(),
                    ]),
            ]);
    }
}
