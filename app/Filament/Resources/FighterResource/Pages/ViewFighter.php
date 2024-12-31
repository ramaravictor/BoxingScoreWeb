<?php

namespace App\Filament\Resources\FighterResource\Pages;

use App\Filament\Resources\FighterResource;
use Filament\Pages\Actions\DeleteAction;
use Filament\Pages\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewFighter extends ViewRecord
{
    protected static string $resource = FighterResource::class;

    protected function getActions(): array
    {
        return [
            EditAction::make(), // Tombol Edit
            DeleteAction::make(), // Tombol Delete
        ];
    }
}
