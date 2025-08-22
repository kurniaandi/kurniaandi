<?php

namespace App\Filament\Technician\Resources\Tickets\Pages;

use App\Filament\Technician\Resources\Tickets\TicketResource;
use Filament\Resources\Pages\CreateRecord;

class CreateTicket extends CreateRecord
{
    protected static string $resource = TicketResource::class;
}
