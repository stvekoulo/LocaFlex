<?php

namespace App\Filament\Resources\BienResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PhotosRelationManager extends RelationManager
{
    protected static string $relationship = 'photos';

    protected static ?string $recordTitleAttribute = 'chemin';

    protected static ?string $title = 'Photos du bien';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\FileUpload::make('chemin')
                    ->label('Photo')
                    ->image()
                    ->directory('bien-photos')
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('chemin')
                    ->label('Photo'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->label('Date d\'ajout'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}