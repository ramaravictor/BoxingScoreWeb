<?php

namespace App\Filament\Resources\RoomResource\Pages;

use App\Filament\Resources\RoomResource;
use Filament\Resources\Pages\CreateRecord;

class CreateRoom extends CreateRecord
{
    protected static string $resource = RoomResource::class;

    protected function getRedirectUrl(): string
    {
        // Setelah data disimpan, redirect ke halaman index (List Rooms)
        return $this->getResource()::getUrl('index');
    }
}
