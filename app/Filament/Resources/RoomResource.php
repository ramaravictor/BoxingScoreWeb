<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RoomResource\Pages;
use App\Models\Room;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
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
                FileUpload::make('image')
                    ->label('Room Image')
                    ->image()
                    ->disk('public')
                    ->directory('images/rooms')
                    ->visibility('public')
                    ->preserveFilenames(),
                TextInput::make('name')
                    ->label('Room Name')
                    ->required()
                    ->maxLength(255),

                TextInput::make('class')
                    ->label('Class')
                    ->required()
                    ->maxLength(255),

                DateTimePicker::make('schedule')
                    ->label('Schedule')
                    ->required()
                    ->withoutSeconds(), // Menghilangkan detik jika tidak diperlukan

                TextInput::make('location')
                    ->label('Location')
                    ->required()
                    ->maxLength(255),

                Toggle::make('availability')
                    ->label('Availability')
                    ->default(true),
            ])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')
                    ->label('Room Image')
                    ->disk('public'), TextColumn::make('id')->label('ID')->sortable(),
                TextColumn::make('name')->label('Name')->sortable()->searchable(),
                TextColumn::make('class')->label('Class')->sortable()->searchable(),
                TextColumn::make('schedule')
                    ->label('Schedule')
                    ->dateTime('d-m-Y H:i'), // Format tanggal dan waktu
                TextColumn::make('location')->label('Location')->sortable()->searchable(),
                BooleanColumn::make('availability')
                    ->label('Available')
                    ->trueIcon('heroicon-s-check-circle')
                    ->falseIcon('heroicon-s-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger')
                    ->action(function (Model $record) {
                        $record->availability = ! $record->availability;
                        $record->save();
                    }),

                TextColumn::make('created_at')->label('Created')->dateTime(),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
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
