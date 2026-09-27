<?php

namespace App\Filament\Resources\Pages\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class PagesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')->label('Judul')->searchable()->sortable(),
                TextColumn::make('category')->label('Kategori')->badge(),
                TextColumn::make('slug')->label('Slug')->toggleable(),
                TextColumn::make('sort_order')->label('Urutan')->sortable(),
                ToggleColumn::make('is_published')->label('Aktif'),
            ])
            ->filters([
                SelectFilter::make('category')->label('Kategori')->options([
                    'profil' => 'Profil Jurusan', 'akademik' => 'Akademik', 'publikasi' => 'Publikasi', 'informasi' => 'Informasi', 'kontak' => 'Kontak',
                ]),
            ])
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
