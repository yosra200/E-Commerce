<?php

namespace App\Filament\Resources\Orders\Tables;

use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class OrdersTable
{
    public static function configure(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('id')->label('Order #')->sortable(),
            TextColumn::make('user.name')->label('Customer')->searchable(),
            TextColumn::make('user.phone')->label('Phone')->searchable(),
            TextColumn::make('items_count')->counts('items')->label('Items'),
            TextColumn::make('total')->money('EGP')->sortable(),
            TextColumn::make('status')->badge(),
            TextColumn::make('created_at')->dateTime()->sortable(),
        ])->filters([
            SelectFilter::make('status')->options([
                'pending' => 'Pending',
                'processing' => 'Processing',
                'shipped' => 'Shipped',
                'delivered' => 'Delivered',
                'cancelled' => 'Cancelled',
            ]),
        ])->recordActions([
            EditAction::make(),
        ]);
    }
}
