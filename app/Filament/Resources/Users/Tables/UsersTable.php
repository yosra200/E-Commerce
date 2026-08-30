<?php

namespace App\Filament\Resources\Users\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('الاسم')
                    ->searchable(),

                TextColumn::make('phone')
                    ->label('رقم الهاتف')
                    ->searchable(),

                TextColumn::make('second_phone')
                    ->label('رقم الهاتف الإضافي')
                    ->searchable(),

                TextColumn::make('address')
                    ->label('العنوان')
                    ->searchable(),

                TextColumn::make('governorate')
                    ->label('المحافظة')
                    ->searchable(),

                TextColumn::make('email')
                    ->label('البريد الإلكتروني')
                    ->searchable(),

                TextColumn::make('email_verified_at')
                    ->label('تاريخ تأكيد البريد الإلكتروني')
                    ->dateTime()
                    ->sortable(),

                TextColumn::make('type')
                    ->label('نوع المستخدم')
                    ->badge()
                    ->formatStateUsing(fn($state) => match ($state) {
                        'admin' => 'مدير',
                        'customer' => 'عميل',
                        'delivery' => 'مندوب توصيل',
                        default => $state,
                    }),

                TextColumn::make('created_at')
                    ->label('تاريخ الإنشاء')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->label('تاريخ التحديث')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make()
                    ->label('تعديل'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()
                        ->label('حذف المحدد'),
                ]),
            ]);
    }
}
