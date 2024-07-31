<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ImagePropertyResource\Pages;
use App\Filament\Resources\ImagePropertyResource\RelationManagers;
use App\Models\ImageProperty;
use App\Models\Property;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ImagePropertyResource extends Resource
{
    protected static ?string $model = ImageProperty::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('property_id')
                    ->label('Property')
                    ->options(Property::all()->pluck('name', 'id'))
                    ->searchable()
                    ->required(),
                FileUpload::make('image')
                    ->label('Upload Gambar Property')
                    ->disk('public')
                    ->directory('property image')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('property.name')
                    ->label('Property')
                    ->searchable(),
                ImageColumn::make('image')
                    ->label('Gambar Property'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListImageProperties::route('/'),
            'create' => Pages\CreateImageProperty::route('/create'),
            'edit' => Pages\EditImageProperty::route('/{record}/edit'),
        ];
    }
}
