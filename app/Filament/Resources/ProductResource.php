<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\CategoryMarketplace;
use App\Models\OwnerMarketplace;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name_product')
                    ->label('Nama Produk')
                    ->required(),
                Select::make('owner_marketplace_id')
                    ->label('Owner Marketplace')
                    ->options(OwnerMarketplace::all()->pluck('name', 'id'))
                    ->required(),
                Select::make('category_marketplace_id')
                    ->label('Category Marketplace')
                    ->options(CategoryMarketplace::all()->pluck('name', 'id'))
                    ->required(),
                TextInput::make('description')
                    ->label('Deskripsi')
                    ->required(),
                TextInput::make('price')
                    ->label('Harga')
                    ->numeric()
                    ->minValue(0)
                    ->step(0.01)
                    ->required(),
                FileUpload::make('image')
                    ->label('Image')
                    ->image()
                    ->disk('public') // Gunakan disk yang sesuai dengan konfigurasi Anda
                    ->directory('product') // Direktori tempat gambar disimpan
                    ->required(), // Ta
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name_product'),
                TextColumn::make('category_marketplace.name')
                    ->label('Category Marketplace')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('price')
                    ->label('Harga')
                    ->money('IDR', true),
                TextColumn::make('description'),
                ImageColumn::make('image') // Menambahkan kolom gambar di tabel
                    ->label('Image')
                    ->width(100) // Lebar gambar, sesuaikan dengan kebutuhan
                    ->height(100), // T
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
