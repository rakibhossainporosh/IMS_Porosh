<?php

namespace App\Filament\Resources\Customers\Schemas;

use App\Models\Customer;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class CustomerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Customer Information')
                    ->schema([
                        TextInput::make('name')
                            ->label('Customer Name')
                            ->placeholder('Enter customer name')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),
                        TextInput::make('email')
                            ->label('Email Address')
                            ->placeholder('Enter email address')
                            ->email()
                            ->maxLength(255)
                            ->unique(Customer::class, 'email', ignoreRecord: true),
                        TextInput::make('phone')
                            ->label('Phone Number')
                            ->placeholder('Enter phone number')
                            ->tel()
                            ->maxLength(20),
                        Textarea::make('address')
                            ->label('Address')
                            ->placeholder('Enter customer address')
                            ->rows(3)
                            ->columnSpanFull(),
                        Toggle::make('is_active')
                            ->label('Active')
                            ->default(true)
                            ->onColor('success')
                            ->offColor('danger')
                            ->columnSpanFull(),
                    ])
                    ->columns(2)
                    ->columnSpan('full'),
            ]);
    }
}
