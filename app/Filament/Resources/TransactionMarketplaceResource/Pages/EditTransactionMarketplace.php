<?php

namespace App\Filament\Resources\TransactionMarketplaceResource\Pages;

use App\Filament\Resources\TransactionMarketplaceResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTransactionMarketplace extends EditRecord
{
    protected static string $resource = TransactionMarketplaceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
