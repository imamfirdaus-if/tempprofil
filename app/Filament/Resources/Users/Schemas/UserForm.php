<?php

namespace App\Filament\Resources\Users\Schemas;

use App\Models\User;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Akun administrator')
                    ->description('Setiap akun di menu ini memiliki akses administrator ke CMS. Username dipakai saat login.')
                    ->schema([
                        TextInput::make('name')
                            ->label('Nama')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('email')
                            ->label('Username login')
                            ->helperText('Boleh menggunakan username seperti superadmin@developer; tidak harus alamat email.')
                            ->required()
                            ->maxLength(255)
                            ->unique(table: User::class, column: 'email', ignoreRecord: true),
                        TextInput::make('password')
                            ->label('Kata sandi')
                            ->password()
                            ->revealable()
                            ->autocomplete('new-password')
                            ->nullable()
                            ->minLength(12)
                            ->confirmed()
                            ->required(fn (string $operation): bool => $operation === 'create')
                            ->dehydrated(fn (?string $state): bool => filled($state))
                            ->helperText(fn (string $operation): string => $operation === 'edit'
                                ? 'Kosongkan jika tidak ingin mengganti kata sandi.'
                                : 'Gunakan minimal 12 karakter.'),
                        TextInput::make('password_confirmation')
                            ->label('Konfirmasi kata sandi')
                            ->password()
                            ->revealable()
                            ->autocomplete('new-password')
                            ->required(fn (string $operation): bool => $operation === 'create')
                            ->dehydrated(false),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),
            ]);
    }
}
