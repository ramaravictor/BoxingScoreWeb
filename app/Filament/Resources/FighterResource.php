<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FighterResource\Pages;
use App\Models\Fighter;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class FighterResource extends Resource
{
    protected static ?string $model = Fighter::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'System Management';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Forms\Components\TextInput::make('name')
                    ->label('Name')
                    ->required()
                    ->maxLength(255),
                // Forms\Components\Textarea::make('description')
                //     ->label('Description')
                //     ->required(),

                Forms\Components\DatePicker::make('birthdate')
                    ->label('Birthdate')
                    ->required(),

                Forms\Components\TextInput::make('weight_class')
                    ->label('Weight Class')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('champions')
                    ->label('Champions')
                    ->required()
                    ->maxLength(255),
                // Forms\Components\TextInput::make('losses')
                //     ->label('Losses')
                //     ->required()
                //     ->numeric(),
                // Forms\Components\TextInput::make('draws')
                //     ->label('Draws')
                //     ->required()
                //     ->numeric(),
                FileUpload::make('image')
                    ->label('Fighter Image')
                    ->image()
                    ->disk('public')
                    ->directory('images/fighters')
                    ->visibility('public')
                    ->preserveFilenames(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label('ID')->sortable(),

                Tables\Columns\TextColumn::make('name')
                    ->label('Name')
                    ->sortable()
                    ->searchable(),
                ImageColumn::make('image')
                    ->label('Fighter Image')
                    ->disk('public'),
                Tables\Columns\TextColumn::make('weight_class')
                    ->label('Weight Class')
                    ->sortable(),
                Tables\Columns\TextColumn::make('birthdate')
                    ->label('Birthdate')
                    ->date(),
                Tables\Columns\TextColumn::make('champions')
                    ->label('Champion Tittles')
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([

            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListFighters::route('/'),
            'create' => Pages\CreateFighter::route('/create'),
            'edit' => Pages\EditFighter::route('/{record}/edit'),
        ];
    }
}
