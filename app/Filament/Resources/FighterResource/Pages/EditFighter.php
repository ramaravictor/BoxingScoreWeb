<?php

namespace App\Filament\Resources\FighterResource\Pages;

use App\Filament\Resources\FighterResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFighter extends EditRecord
{
    protected static string $resource = FighterResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        // Setelah data disimpan, redirect ke halaman index (List Rooms)
        return $this->getResource()::getUrl('index');
    }
}
