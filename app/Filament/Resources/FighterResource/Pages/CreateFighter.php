<?php

namespace App\Filament\Resources\FighterResource\Pages;

use App\Filament\Resources\FighterResource;
use Filament\Resources\Pages\CreateRecord;

class CreateFighter extends CreateRecord
{
    protected static string $resource = FighterResource::class;

    protected function getRedirectUrl(): string
    {
        // Setelah data disimpan, redirect ke halaman index (List Rooms)
        return $this->getResource()::getUrl('index');
    }
}
