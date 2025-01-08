<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RoomResource\Pages;
use App\Models\Fighter;
use App\Models\Room;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RoomResource extends Resource
{
    protected static ?string $model = Room::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'System Management';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                TextInput::make('name')
                    ->label('Room Name')
                    ->required()
                    ->maxLength(255),

                // Dropdown untuk Weight Class
                Select::make('weight_class')
                    ->label('Weight Class')
                    ->options(Fighter::pluck('weight_class', 'weight_class')->unique()->toArray()) // Mengambil data unik dari Fighter
                    ->required()
                    ->reactive() // Memicu reaktivitas saat nilai berubah
                    ->dehydrateStateUsing(fn ($state) => $state), // Menyimpan nilai terpilih

                // Fighter Select untuk Red Corner
                Select::make('red_corner_id')
                    ->label('Red Corner Fighter')
                    ->options(function (callable $get) {
                        // Ambil weight_class yang dipilih
                        $selectedWeightClass = $get('weight_class');

                        // Filter fighters berdasarkan weight_class yang dipilih
                        return Fighter::where('weight_class', $selectedWeightClass)->pluck('name', 'id');
                    })
                    ->preload()
                    ->searchable()
                    ->required(),

                // Fighter Select untuk Blue Corner
                Select::make('blue_corner_id')
                    ->label('Blue Corner Fighter')
                    ->options(function (callable $get) {
                        // Ambil weight_class yang dipilih
                        $selectedWeightClass = $get('weight_class');

                        // Filter fighters berdasarkan weight_class yang dipilih
                        return Fighter::where('weight_class', $selectedWeightClass)->pluck('name', 'id');
                    })
                    ->preload()
                    ->searchable()
                    ->required(),

                DateTimePicker::make('schedule')
                    ->label('Schedule')
                    ->required()
                    ->withoutSeconds(), // Menghilangkan detik jika tidak diperlukan

                Toggle::make('availability')
                    ->label('Availability')
                    ->default(true),

                // FileUpload::make('image')
                //     ->label('Room Image')
                //     ->image()
                //     ->disk('public')
                //     ->directory('images/rooms')
                //     ->visibility('public')
                //     ->preserveFilenames(),
            ])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label('ID')->sortable(),
                // ImageColumn::make('image')
                //     ->label('Room Image')
                //     ->disk('public'),
                TextColumn::make('name')->label('Name')->sortable()->searchable(),
                TextColumn::make('redCorner.name')
                    ->label('Red Corner')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('blueCorner.name')
                    ->label('Blue Corner')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('weight_class')->label('Weight Class')->sortable()->searchable(),
                TextColumn::make('schedule')
                    ->label('Schedule')
                    ->dateTime('d-m-Y H:i'),
                BooleanColumn::make('availability')
                    ->label('Available')
                    ->trueIcon('heroicon-s-check-circle')
                    ->falseIcon('heroicon-s-x-circle'),
                TextColumn::make('created_at')->label('Created')->dateTime(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(), // ViewAction otomatis memanggil infolist
                Tables\Actions\EditAction::make(),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                // Bagian untuk gambar di atas
                // Section::make('Room Image')
                //     ->schema([
                //         ImageEntry::make('image')
                //             ->label('') // Hilangkan label gambar
                //             ->extraAttributes([
                //                 'class' => 'rounded-lg shadow-lg w-full', // Gambar ukuran penuh
                //             ]),
                //     ])
                //     ->columns(2), // Kolom penuh untuk gambar

                // Bagian untuk detail Room
                Section::make('Room Details')
                    ->schema([
                        TextEntry::make('name')
                            ->label('Room Name :')
                            ->extraAttributes(['class' => 'text-xl font-bold text-gray-900']) // Label lebih besar
                            ->formatStateUsing(fn ($state) => "<span class='font-normal text-gray-400 text-md'>{$state}</span>") // Atribut lebih kecil
                            ->html(), // Izinkan HTML untuk pemformatan atribut

                        TextEntry::make('weight_class')
                            ->label('Weight Class :')
                            ->extraAttributes(['class' => 'text-xl font-bold text-gray-900']) // Label lebih besar
                            ->formatStateUsing(fn ($state) => "<span class='font-normal text-gray-400 text-md'>{$state}</span>")
                            ->html(),

                        TextEntry::make('redcorner.name')
                            ->label('Red Corner :')
                            ->extraAttributes(['class' => 'text-xl font-bold text-gray-900']) // Label lebih besar
                            ->formatStateUsing(fn ($state) => "<span class='font-normal text-gray-400 text-md'>{$state}</span>")
                            ->html(),

                        TextEntry::make('bluecorner.name')
                            ->label('Blue Corner :')
                            ->extraAttributes(['class' => 'text-xl font-bold text-gray-900']) // Label lebih besar
                            ->formatStateUsing(fn ($state) => "<span class='font-normal text-gray-400 text-md'>{$state}</span>")
                            ->html(),

                        TextEntry::make('schedule')
                            ->label('Schedule :')
                            ->dateTime('d-m-Y H:i')
                            ->extraAttributes(['class' => 'text-xl font-bold text-gray-900']) // Label lebih besar
                            ->formatStateUsing(fn ($state) => "<span class='font-normal text-gray-400 text-md'>{$state}</span>")
                            ->html(),

                        IconEntry::make('availability')
                            ->label('Availability :')
                            ->trueIcon('heroicon-s-check-circle') // Ikon jika true
                            ->falseIcon('heroicon-s-x-circle')   // Ikon jika false
                            ->color(fn ($state) => $state ? 'success' : 'danger'), // Warna ikon
                    ])
                    ->columns(2), // Atur menjadi dua kolom

                // Bagian tambahan
                Section::make('Additional Information')
                    ->schema([
                        TextEntry::make('created_at')
                            ->label('Created At :')
                            ->dateTime('d-m-Y H:i')
                            ->extraAttributes(['class' => 'text-md font-normal text-gray-700']),
                    ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRooms::route('/'),
            'create' => Pages\CreateRoom::route('/create'),
            'edit' => Pages\EditRoom::route('/{record}/edit'),
            'view' => Pages\ViewRoom::route('/{record}'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
