<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OwnerMarketplaceResource\Pages;
use App\Filament\Resources\OwnerMarketplaceResource\RelationManagers;
use App\Models\OwnerMarketplace;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Hash;

class OwnerMarketplaceResource extends Resource
{
    protected static ?string $model = OwnerMarketplace::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->maxLength(100),
                TextInput::make('email')
                    ->required()
                    ->email()
                    ->maxLength(100),
                TextInput::make('phone')
                    ->required()
                    ->maxLength(15),
                FileUpload::make('photo_profile')
                    ->label('Foto Profile')
                    ->disk('public')
                    ->image()
                    ->directory('photo_profile_marketplace')
                    ->required(),
                FileUpload::make('photo_ktp')
                    ->label('Foto KTP')
                    ->disk('public')
                    ->image()
                    ->directory('owner_ktp_marketplace')
                    ->required(),
                TextInput::make('password')
                    ->password()
                    ->dehydrateStateUsing(fn($state) => $state ? Hash::make($state) : null)
                    ->dehydrated(fn($state) => filled($state))
                    ->maxLength(100)
                    ->required(fn($record) => !$record),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('email'),
                ImageColumn::make('photo_profile')->width(100)->height(100),
                ImageColumn::make('photo_ktp')->width(100)->height(100),
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
            'index' => Pages\ListOwnerMarketplaces::route('/'),
            'create' => Pages\CreateOwnerMarketplace::route('/create'),
            'edit' => Pages\EditOwnerMarketplace::route('/{record}/edit'),
        ];
    }
}
