<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TransactionMarketplaceResource\Pages;
use App\Filament\Resources\TransactionMarketplaceResource\RelationManagers;
use App\Models\TransactionMarketplace;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TransactionMarketplaceResource extends Resource
{
    protected static ?string $model = TransactionMarketplace::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('user_id')
                    ->label('User')
                    ->options(User::all()->pluck('name', 'id'))
                    ->required(),
                TextInput::make('total')
                    ->label('Total')
                    ->numeric()
                    ->minValue(0)
                    ->step(0.01)
                    ->required(),
                TextInput::make('status'),
                TextInput::make('payment_url'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->label('User')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('price')
                    ->label('Harga')
                    ->money('IDR', true),
                TextColumn::make('status'),
                TextColumn::make('payment_url')
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
            'index' => Pages\ListTransactionMarketplaces::route('/'),
            'create' => Pages\CreateTransactionMarketplace::route('/create'),
            'edit' => Pages\EditTransactionMarketplace::route('/{record}/edit'),
        ];
    }
}
