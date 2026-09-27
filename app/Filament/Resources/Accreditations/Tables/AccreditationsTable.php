<?php

namespace App\Filament\Resources\Accreditations\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;

class AccreditationsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('program_name')->label('Program Studi')->searchable()->sortable(),
                TextColumn::make('degree')->label('Jenjang'),
                TextColumn::make('status')->label('Status')->badge(),
                TextColumn::make('valid_until')->label('Berlaku sampai'),
                ToggleColumn::make('is_active')->label('Aktif'),
            ])
            ->filters([])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
