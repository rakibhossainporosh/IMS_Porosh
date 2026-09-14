<?php

namespace App\Filament\Resources\Products\Tables;

use App\Models\Category;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class ProductsTable
{
    public static function configure(Table $table): Table
    {
        return $table
        ->columns([
                ImageColumn::make('image')
                    ->label('Image')
                    ->circular()
                    ->defaultImageUrl('/images/no_image.png'),
                TextColumn::make('name')
                    ->label('Product name')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('sku')
                    ->label('SKU')
                    ->badge()
                    ->color('gray')
                    ->searchable(),
                TextColumn::make('category.name')
                    ->label('Category name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('unit.short_code')
                    ->label('Unit name')
                    ->badge()
                    ->color('info'),
                TextColumn::make('cost_price')
                    ->label('Cost Price')
                    ->money('BDT')
                    ->sortable(),
                TextColumn::make('selling_price')
                    ->label('Selling Price')
                    ->money('BDT')
                    ->sortable(),
                ToggleColumn::make('status')
                    ->label('Status')
                    ->onColor('success')
                    ->offColor('danger'),
                TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('category_id')
                    ->label('category')
                    ->options(Category::pluck('name', 'id'))
                    ->placeholder('All Category'),

                SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        '1' => 'Active',
                        '0' => 'Inactive'
                    ])
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make()
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }
}
