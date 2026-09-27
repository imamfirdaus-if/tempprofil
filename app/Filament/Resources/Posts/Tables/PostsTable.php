<?php

namespace App\Filament\Resources\Posts\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class PostsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')->label('Judul')->searchable()->sortable()->limit(55),
                TextColumn::make('type')->label('Jenis')->badge()->formatStateUsing(fn (string $state): string => $state === 'announcement' ? 'Pengumuman' : 'Berita'),
                TextColumn::make('published_at')->label('Terbit')->dateTime('d M Y')->sortable(),
                ToggleColumn::make('is_published')->label('Aktif'),
            ])
            ->filters([
                SelectFilter::make('type')->label('Jenis')->options(['news' => 'Berita', 'announcement' => 'Pengumuman']),
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
