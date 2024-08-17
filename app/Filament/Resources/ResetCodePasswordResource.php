<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ResetCodePasswordResource\Pages;
use App\Filament\Resources\ResetCodePasswordResource\RelationManagers;
use App\Models\ResetCodePassword;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ResetCodePasswordResource extends Resource
{
    protected static ?string $model = ResetCodePassword::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextInput::make('email')
                    ->label('Email'),
                TextInput::make('code')
                    ->label('Code'),
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
            'index' => Pages\ListResetCodePasswords::route('/'),
            'create' => Pages\CreateResetCodePassword::route('/create'),
            'edit' => Pages\EditResetCodePassword::route('/{record}/edit'),
        ];
    }
}
