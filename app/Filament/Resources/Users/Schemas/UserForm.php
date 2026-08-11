<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('الاسم')
                    ->default(null),
                TextInput::make('phone')
                    ->label('رقم الهاتف')
                    ->tel()
                    ->default(null),
                TextInput::make('second_phone')
                    ->label('رقم الهاتف الثاني')
                    ->tel()
                    ->default(null),
                TextInput::make('address')
                    ->label('العنوان')
                    ->default(null),
                TextInput::make('governorate')
                    ->label('المحافظة')
                    ->default(null),
                TextInput::make('email')
                    ->label('البريد الإلكتروني')
                    ->email()
                    ->default(null),
                // DateTimePicker::make('email_verified_at'),
                // TextInput::make('password')
                //     ->password()
                //     ->default(null),
                Select::make('type')
                    ->label('النوع')
                    ->options(['user' => 'User', 'admin' => 'Admin'])
                    ->default('user')
                    ->required(),
            ]);
    }
}
