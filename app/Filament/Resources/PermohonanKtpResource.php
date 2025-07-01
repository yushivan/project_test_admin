<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PermohonanKtpResource\Pages;
use App\Filament\Resources\PermohonanKtpResource\RelationManagers;
use App\Models\PermohonanKtp;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PermohonanKtpResource extends Resource
{
    protected static ?string $model = PermohonanKtp::class;

    protected static ?string $navigationIcon = 'heroicon-o-identification';
    protected static ?string $pluralModelLabel = 'Permohonan KTP';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('customer_id')
                    ->relationship('customer', 'nama')
                    ->required()
                    ->searchable(),
                Forms\Components\TextInput::make('alamat')->required(),
                Forms\Components\TextInput::make('status')->required(),
                Forms\Components\FileUpload::make('kk')
                    ->required()
                    ->reorderable()
                    ->directory('permohonanktp/kk')
                    ->appendFiles()
                    ->columnStart(1)
                    ->label('Foto Kartu Keluarga'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('customer.nama')->label('Customer'),
                Tables\Columns\TextColumn::make('alamat'),
                Tables\Columns\TextColumn::make('status'),
            ])->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPermohonanKtps::route('/'),
            'create' => Pages\CreatePermohonanKtp::route('/create'),
            'edit' => Pages\EditPermohonanKtp::route('/{record}/edit'),
        ];
    }
}
