<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('بيانات المنتج')->schema([
                Select::make('category_id')
                    ->label('القسم')
                    ->options(
                        \App\Models\Category::query()
                            ->get()
                            ->mapWithKeys(function ($category) {
                                return [
                                    $category->id => $category->name ?? 'بدون اسم',
                                ];
                            })
                            ->toArray()
                    )
                    ->searchable()
                    ->preload()
                    ->required(),
                TextInput::make('name.ar')->label('اسم المنتج بالعربي')->required()->maxLength(255),
                TextInput::make('name.en')->label('اسم المنتج بالإنجليزي')->required()->maxLength(255),
                Textarea::make('description.ar')->label('الوصف بالعربي')->maxLength(5000),
                Textarea::make('description.en')->label('الوصف بالإنجليزي')->maxLength(5000),
            ])->columns(2),
            Section::make('السعر وحالة الظهور')->schema([
                TextInput::make('price')->label('السعر')->numeric()->minValue(0)->required()->prefix('EGP'),
                TextInput::make('compare_price')->label('السعر قبل الخصم')->numeric()->minValue(0)->gte('price')->prefix('EGP'),
                TextInput::make('sku')->label('كود المنتج SKU')->required()->maxLength(255)->unique(ignoreRecord: true),
                // TextInput::make('sort_order')->label('ترتيب الظهور')->numeric()->integer()->minValue(0)->default(0)->required(),
                Toggle::make('is_active')->label('ظاهر في المتجر')->default(true)->required(),
            ])->columns(2),
            Section::make('صور المنتج')->schema([
                Repeater::make('images')
                    ->relationship()
                    ->label('')
                    ->minItems(1)
                    ->defaultItems(1)
                    ->addActionLabel('إضافة صورة')
                    ->schema([
                        FileUpload::make('image')
                            ->label('الصورة')
                            ->image()
                            ->disk('public')
                            ->directory('products')
                            ->required(),
                        // Select::make('color_id')
                        //     ->label('اللون المرتبط بالصورة')
                        //     ->relationship('color', 'id')
                        //     ->getOptionLabelFromRecordUsing(fn($record) => $record->name['ar'] ?? $record->name['en'] ?? $record->id)
                        //     ->searchable()
                        //     ->preload(),
                        // Toggle::make('is_primary')->label('الصورة الرئيسية')->default(false),
                        // TextInput::make('sort_order')->label('الترتيب')->numeric()->integer()->minValue(0)->default(0)->required(),
                    ])->columns(2),
            ]),
            // Section::make('المقاسات والألوان والمخزون')->schema([
            //     Repeater::make('variants')
            //         ->relationship()
            //         ->label('')
            //         ->minItems(1)
            //         ->defaultItems(1)
            //         ->addActionLabel('إضافة خيار')
            //         ->schema([
            //             Select::make('color_id')
            //                 ->label('اللون')
            //                 ->relationship('color', 'id')
            //                 ->getOptionLabelFromRecordUsing(fn($record) => $record->name['ar'] ?? $record->name['en'] ?? $record->id)
            //                 ->searchable()
            //                 ->preload()
            //                 ->required(),
            //             Select::make('size_id')
            //                 ->label('المقاس')
            //                 ->relationship('size', 'id')
            //                 ->getOptionLabelFromRecordUsing(fn($record) => $record->name['ar'] ?? $record->name['en'] ?? $record->id)
            //                 ->searchable()
            //                 ->preload()
            //                 ->required(),
            //             TextInput::make('sku')->label('SKU للخيار')->required()->maxLength(255)->unique(ignoreRecord: true),
            //             TextInput::make('price')->label('سعر خاص للخيار')->numeric()->minValue(0)->prefix('EGP'),
            //             TextInput::make('stock')->label('الكمية المتاحة')->numeric()->integer()->minValue(0)->default(0)->required(),
            //             Toggle::make('is_active')->label('نشط')->default(true)->required(),
            //         ])->columns(2),
            // ]),
        ]);
    }
}
