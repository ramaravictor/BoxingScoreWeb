<?php

namespace App\Filament\Resources\RoomResource\Pages;

use App\Filament\Resources\RoomResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRooms extends ListRecords
{
    protected static string $resource = RoomResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\Action::make('backToHome') // Tombol Back to Home
                ->label('Back to Home')
                ->url(route('home')) // Ganti 'home' dengan nama route ke halaman utama
                ->icon('heroicon-o-arrow-left') // Ikon panah kiri
                ->color('gray') // Warna tombol
                ->openUrlInNewTab(false), // Tidak membuka tab baru
        ];
    }
}
