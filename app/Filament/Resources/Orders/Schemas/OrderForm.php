<?php

namespace App\Filament\Resources\Orders\Schemas;

use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class OrderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Customer')->schema([
                Placeholder::make('customer')->label('العملاء')->content(fn($record) => $record?->user?->name ?? '-'),
                Placeholder::make('phone')->label('رقم الهاتف')->content(fn($record) => $record?->user?->phone ?? '-'),
                Placeholder::make('address')->label('العنوان')->content(fn($record) => $record?->user?->address ?? '-'),
            ])->columns(3),
            Section::make('Order')->schema([
                Select::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'processing' => 'Processing',
                        'shipped' => 'Shipped',
                        'delivered' => 'Delivered',
                        'cancelled' => 'Cancelled',
                    ])
                    ->required(),
                Placeholder::make('total')->content(fn($record) => number_format((float) $record?->total, 2) . ' EGP'),
                Placeholder::make('items')->content(fn($record) => $record?->items->sum('quantity') ?? 0),
            ])->columns(3),
        ]);
    }
}
