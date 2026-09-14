<?php

namespace App\Filament\Resources\Warehouses\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class WarehouseForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
               Section::make('Warehouse Information')
                ->schema([
                    TextInput::make('name')
                        ->label('Warehouse name')
                        ->placeholder('Enter your warehouse name')
                        ->required()
                        ->maxLength(255)
                        ->columnSpanFull(),
                    TextInput::make('location')
                        ->label('Location')
                        ->placeholder('Enter your warehouse location')
                        ->maxLength(255)
                        ->columnSpanFull(),
                    Toggle::make('status')
                        ->label('Status')
                        ->default(true)
                        ->onColor('seccess')
                        ->offColor('danger')
                        ->columnSpanFull(),
                ])
                    ->columns(2)
                    ->columnSpan('full'),
            ]);
    }
}
