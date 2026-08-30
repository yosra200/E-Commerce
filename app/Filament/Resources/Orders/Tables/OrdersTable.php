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
            TextColumn::make('id')
                ->label('رقم الطلب')
                ->sortable(),

            TextColumn::make('user.name')
                ->label('العميل')
                ->searchable(),

            TextColumn::make('user.phone')
                ->label('رقم الهاتف')
                ->searchable(),

            TextColumn::make('items_count')
                ->counts('items')
                ->label('عدد المنتجات'),

            TextColumn::make('total')
                ->label('الإجمالي')
                ->money('EGP')
                ->sortable(),

            TextColumn::make('status')
                ->label('الحالة')
                ->badge()
                ->formatStateUsing(fn($state) => match ($state) {
                    'pending' => 'قيد الانتظار',
                    'processing' => 'قيد التجهيز',
                    'shipped' => 'تم الشحن',
                    'delivered' => 'تم التوصيل',
                    'cancelled' => 'ملغي',
                    default => $state,
                }),

            TextColumn::make('created_at')
                ->label('تاريخ الطلب')
                ->dateTime()
                ->sortable(),

        ])->filters([
            SelectFilter::make('status')
                ->label('الحالة')
                ->options([
                    'pending' => 'قيد الانتظار',
                    'processing' => 'قيد التجهيز',
                    'shipped' => 'تم الشحن',
                    'delivered' => 'تم التوصيل',
                    'cancelled' => 'ملغي',
                ]),
        ])->recordActions([
            EditAction::make()
                ->label('تعديل'),
        ]);
    }
}
