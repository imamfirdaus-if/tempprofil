<?php

namespace App\Filament\Resources\SiteSettings;

use App\Filament\Resources\SiteSettings\Pages\ManageSiteSettings;
use App\Models\SiteSetting;
use BackedEnum;
use Filament\Actions\EditAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use UnitEnum;

class SiteSettingResource extends Resource
{
    protected static ?string $model = SiteSetting::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCog6Tooth;
    protected static string|UnitEnum|null $navigationGroup = 'Pengaturan';
    protected static ?string $navigationLabel = 'Identitas & SEO';
    protected static ?string $modelLabel = 'pengaturan identitas';
    protected static ?string $pluralModelLabel = 'Identitas & SEO';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Identitas situs')
                    ->description('Dipakai pada header, footer, metadata, dan schema.org.')
                    ->schema([
                        TextInput::make('site_name')->label('Nama situs')->required(),
                        TextInput::make('short_name')->label('Nama singkat')->required(),
                        TextInput::make('tagline')->label('Tagline'),
                        Textarea::make('description')->label('Deskripsi situs')->rows(3),
                        FileUpload::make('logo')->label('Logo')->image()->disk('public')->directory('branding')->visibility('public'),
                        FileUpload::make('favicon')->label('Favicon')->image()->disk('public')->directory('branding')->visibility('public'),
                    ])->columns(2),
                Section::make('Header atas')
                    ->description('Atur teks dan tautan layanan yang tampil pada baris paling atas situs.')
                    ->schema([
                        TextInput::make('topbar_text')->label('Teks header atas')->maxLength(255)->columnSpanFull(),
                        Repeater::make('top_links')
                            ->label('Tautan cepat')
                            ->schema([
                                TextInput::make('label')->label('Nama tautan')->required()->maxLength(60),
                                TextInput::make('url')->label('URL tujuan')->url()->required()->maxLength(255),
                            ])
                            ->columns(2)
                            ->reorderable()
                            ->collapsible()
                            ->addActionLabel('Tambah tautan')
                            ->columnSpanFull(),
                    ]),
                Section::make('Hero beranda')
                    ->description('Judul utama mengikuti Identitas situs → Nama singkat. Foto serta tiga warna gradasi dapat diganti kapan saja.')
                    ->schema([
                        TextInput::make('hero_eyebrow')->label('Teks pembuka'),
                        Textarea::make('hero_subtitle')->label('Subjudul')->rows(3),
                        FileUpload::make('hero_image')->label('Foto latar hero')->image()->disk('public')->directory('branding')->visibility('public')->helperText('Foto gedung dapat diganti dari sini.'),
                        TextInput::make('hero_cta_text')->label('Teks tombol'),
                        TextInput::make('hero_cta_url')->label('URL tombol')->url(),
                        ColorPicker::make('hero_gradient_start')->label('Gradasi hero · hijau')->hex(),
                        ColorPicker::make('hero_gradient_middle')->label('Gradasi hero · biru')->hex(),
                        ColorPicker::make('hero_gradient_end')->label('Gradasi hero · putih')->hex(),
                    ])->columns(2),
                Section::make('Akreditasi di Beranda')
                    ->schema([
                        FileUpload::make('accreditation_image')->label('Foto sertifikat')->image()->disk('public')->directory('branding')->visibility('public'),
                        TextInput::make('accreditation_title')->label('Judul akreditasi')->required()->maxLength(255),
                        Textarea::make('accreditation_description')->label('Redaksi akreditasi')->rows(5)->required()->columnSpanFull(),
                    ])->columns(2),
                Section::make('Tampilan bagian pengumuman')
                    ->description('Foto dan ketiga warna ini membentuk latar bagian agenda di Beranda.')
                    ->schema([
                        FileUpload::make('announcement_background_image')->label('Foto latar pengumuman')->image()->disk('public')->directory('branding')->visibility('public'),
                        ColorPicker::make('announcement_gradient_start')->label('Gradasi pengumuman · hijau')->hex(),
                        ColorPicker::make('announcement_gradient_middle')->label('Gradasi pengumuman · biru')->hex(),
                        ColorPicker::make('announcement_gradient_end')->label('Gradasi pengumuman · putih')->hex(),
                    ])->columns(2),
                Section::make('Kontak & layanan')
                    ->schema([
                        TextInput::make('email')->label('Email')->email(),
                        TextInput::make('phone')->label('Telepon'),
                        Textarea::make('address')->label('Alamat')->rows(3),
                        TextInput::make('postal_code')->label('Kode pos'),
                        TextInput::make('maps_url')->label('URL Google Maps')->url(),
                        TextInput::make('lms_url')->label('URL E-learning / LMS')->url()->required(),
                        TextInput::make('wordpress_api_url')->label('Endpoint API berita UIN')->url()->required(),
                    ])->columns(2),
                Section::make('Sosial media')
                    ->schema([
                        TextInput::make('instagram')->label('Instagram')->url(),
                        TextInput::make('facebook')->label('Facebook')->url(),
                        TextInput::make('youtube')->label('YouTube')->url(),
                        TextInput::make('x_url')->label('X / Twitter')->url(),
                    ])->columns(2),
                Section::make('Footer')
                    ->description('Tagline dan alamat menggunakan data Identitas serta Kontak. Atur kredit dan warna footer di sini.')
                    ->schema([
                        TextInput::make('footer_office_label')->label('Judul blok alamat')->maxLength(255),
                        TextInput::make('footer_credit')->label('Kredit footer')->maxLength(255)->columnSpanFull(),
                        ColorPicker::make('footer_background_color')->label('Warna latar footer')->hex(),
                        ColorPicker::make('footer_text_color')->label('Warna teks footer')->hex(),
                    ])->columns(2),
                Section::make('SEO default')
                    ->schema([
                        TextInput::make('meta_title')->label('Meta title')->maxLength(255),
                        Textarea::make('meta_description')->label('Meta description')->rows(3)->maxLength(160),
                        Textarea::make('meta_keywords')->label('Meta keywords')->rows(2),
                        FileUpload::make('og_image')->label('Open Graph image')->image()->disk('public')->directory('branding')->visibility('public'),
                        TextInput::make('latitude')->label('Latitude')->numeric(),
                        TextInput::make('longitude')->label('Longitude')->numeric(),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('site_name')->label('Nama situs'),
                TextColumn::make('email')->label('Email'),
                TextColumn::make('updated_at')->label('Terakhir diperbarui')->dateTime('d M Y H:i'),
            ])
            ->filters([])
            ->recordActions([
                EditAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageSiteSettings::route('/'),
        ];
    }
}
