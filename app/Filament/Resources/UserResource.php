<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('firstname')
                ->required()
                ->maxLength(50),
            Forms\Components\TextInput::make('lastname')
                ->required()
                ->maxLength(50),
            Forms\Components\TextInput::make('email')
                ->email()
                ->required()
                ->maxLength(255),
            Forms\Components\TextInput::make('two_factor_secret'),
            Forms\Components\TextInput::make('two_factor_recovery_codes'),
            Forms\Components\Textarea::make('profile_photo_path')->maxLength(
                65535
            ),
            Forms\Components\Checkbox::make('filament_user'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('firstname'),
                Tables\Columns\TextColumn::make('lastname'),
                Tables\Columns\TextColumn::make('email'),
                Tables\Columns\TextColumn::make(
                    'email_verified_at'
                )->dateTime(),
                Tables\Columns\TextColumn::make('two_factor_secret'),
                Tables\Columns\TextColumn::make('two_factor_recovery_codes'),
                Tables\Columns\TextColumn::make('profile_photo_path'),
                Tables\Columns\TextColumn::make('created_at')->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')->dateTime(),
                Tables\Columns\TextColumn::make('filament_user'),
            ])
            ->filters([
                //
            ])
            ->actions([Tables\Actions\EditAction::make()])
            ->bulkActions([Tables\Actions\DeleteBulkAction::make()]);
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
