<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Fieldset;
use Filament\Schemas\Schema;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Fieldset::make('Details')
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('price')
                            ->required()
                            ->numeric()
                            ->prefix('IDR'),

                        FileUpload::make('thumbnail')
                            ->image()
                            ->required(),
                    ]),

                Fieldset::make('Additional')
                    ->schema([
                        Textarea::make('about')
                            ->required(),

                        Select::make('is_popular')
                            ->options([
                                false => 'Not popular',
                                true => 'Popular',
                            ])
                            ->required(),
                        
                        Select::make('category_id')
                            ->preload()
                            ->relationship('category', 'name')
                            ->searchable()
                            ->required(),

                        Select::make('brand_id')
                            ->preload()
                            ->relationship('brand', 'name')
                            ->searchable()
                            ->required(),

                        TextInput::make('stock')
                            ->numeric()
                            ->required()
                            ->prefix('Pcs'),
                    ]),

            ]);
    }
}
