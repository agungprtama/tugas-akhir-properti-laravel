<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PropertyResource\Pages;
use App\Filament\Resources\PropertyResource\RelationManagers;
use App\Models\Property;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PropertyResource extends Resource
{
    protected static ?string $model = Property::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('user_id')
                    ->label('User')
                    ->options(User::all()->pluck('name', 'id'))
                    ->searchable()
                    ->required(),
                TextInput::make('name')
                    ->label('Nama Properti')
                    ->required(),
                Textarea::make('description')
                    ->label('Deskripsi Properti')
                    ->required(),
                TextInput::make('price')
                    ->label('Harga')
                    ->numeric()
                    ->minValue(0)
                    ->step(0.01)
                    ->required(),
                FileUpload::make('image')
                    ->label('Upload Gambar')
                    ->disk('public')
                    ->directory('property')
                    ->required(),
                Select::make('offer_type')
                    ->label('Tipe Penawaran')
                    ->options([
                        'jual' => 'Jual',
                        'sewa' => 'Sewa',
                    ])
                    ->required(),
                DatePicker::make('rental_start_date')
                    ->label('Tanggal Mulai Sewa')
                    ->nullable(),
                DatePicker::make('rental_end_date')
                    ->label('Tanggal Selesai Sewa')
                    ->nullable(),
                Select::make('property_type')
                    ->label('Tipe Properti')
                    ->options([
                        'rumah' => 'Rumah',
                        'apartement' => 'Apartement',
                        'tanah' => 'Tanah',
                    ])
                    ->required(),
                Select::make('furnished')
                    ->label('Full Furnish')
                    ->options([
                        'ya' => 'Iya',
                        'tidak' => 'Tidak',
                        'semi' => 'Semi',
                    ])
                    ->required(),
                TextInput::make('jumlah_lantai')
                    ->label('Jumlah lantai')
                    ->numeric()
                    ->minValue(0)
                    ->step(1)
                    ->required(),
                TextInput::make('bedrooms')
                    ->label('Kamar Tidur')
                    ->numeric()
                    ->minValue(0)
                    ->step(1)
                    ->required(),
                TextInput::make('bathrooms')
                    ->label('Kamar Mandi')
                    ->numeric()
                    ->minValue(0)
                    ->step(1)
                    ->required(),
                TextInput::make('building_area')
                    ->label('Luas Bangunan')
                    ->numeric()
                    ->minValue(0)
                    ->step(1)
                    ->required(),
                TextInput::make('land_area')
                    ->label('Luas Tanah')
                    ->numeric()
                    ->minValue(0)
                    ->step(1)
                    ->required(),
                TextInput::make('garage')
                    ->label('Garasi')
                    ->numeric()
                    ->minValue(0)
                    ->step(1),
                TextInput::make('province')
                    ->label('Provinsi')
                    ->required(),
                TextInput::make('city')
                    ->label('Kota')
                    ->required(),
                TextInput::make('district')
                    ->label('Kelurahan')
                    ->required(),
                Textarea::make('address')
                    ->label('Alamat Lengkap')
                    ->required(),
                TextInput::make('gmaps_link')
                    ->label('Link Google Maps'),
                TextInput::make('other_links')
                    ->label('Link Lainnya'),
                TextInput::make('latitude')
                    ->label('Latitude'),
                TextInput::make('longitude')
                    ->label('Longitude'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->label('User')
                    ->searchable(),

                TextColumn::make('name')
                    ->label('Nama Properti')
                    ->searchable(),

                TextColumn::make('description')
                    ->label('Deskripsi Properti')
                    ->limit(50),

                TextColumn::make('price')
                    ->label('Harga')
                    ->money('IDR', true),

                ImageColumn::make('image')
                    ->label('Gambar'),

                SelectColumn::make('offer_type')
                    ->label('Tipe Penawaran')
                    ->options([
                        'jual' => 'Jual',
                        'sewa' => 'Sewa',
                    ]),

                TextColumn::make('rental_start_date')
                    ->label('Tanggal Mulai Sewa')
                    ->dateTime(),

                TextColumn::make('rental_end_date')
                    ->label('Tanggal Selesai Sewa')
                    ->dateTime(),

                SelectColumn::make('property_type')
                    ->label('Tipe Properti')
                    ->options([
                        'rumah' => 'Rumah',
                        'apartement' => 'Apartement',
                        'tanah' => 'Tanah',
                    ]),

                SelectColumn::make('furnished')
                    ->label('Full Furnish')
                    ->options([
                        'ya' => 'Iya',
                        'tidak' => 'Tidak',
                        'semi' => 'Semi',
                    ]),

                TextColumn::make('jumlah_lantai')
                    ->label('Jumlah Lantai')
                    ->numeric(),
                TextColumn::make('bedrooms')
                    ->label('Kamar Tidur')
                    ->numeric(),

                TextColumn::make('bathrooms')
                    ->label('Kamar Mandi')
                    ->numeric(),

                TextColumn::make('building_area')
                    ->label('Luas Bangunan')
                    ->numeric(),

                TextColumn::make('land_area')
                    ->label('Luas Tanah')
                    ->numeric(),

                TextColumn::make('garage')
                    ->label('Garasi')
                    ->numeric(),

                TextColumn::make('province')
                    ->label('Provinsi'),

                TextColumn::make('city')
                    ->label('Kota'),

                TextColumn::make('district')
                    ->label('Kelurahan'),

                TextColumn::make('address')
                    ->label('Alamat Lengkap')
                    ->limit(50),

                TextColumn::make('gmaps_link')
                    ->label('Link Google Maps')
                    ->url(fn ($record) => $record->gmaps_link, true),

                TextColumn::make('latitude')
                    ->label('Latitude'),
                TextColumn::make('longitude')
                    ->label('Longitude'),


                TextColumn::make('other_links')
                    ->label('Link Lainnya')
                    ->url(fn ($record) => $record->other_links, true),

            ])
            ->filters([
                //
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
            'index' => Pages\ListProperties::route('/'),
            'create' => Pages\CreateProperty::route('/create'),
            'edit' => Pages\EditProperty::route('/{record}/edit'),
        ];
    }
}
