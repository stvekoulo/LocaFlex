<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ServiceResource\Pages;
use App\Filament\Resources\ServiceResource\RelationManagers;
use App\Models\Service;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ServiceResource extends Resource
{
    protected static ?string $model = Service::class;

    protected static ?string $navigationIcon = 'heroicon-o-wrench';
    protected static ?string $navigationLabel = 'Mes Services';
    protected static ?string $modelLabel = 'Service';
    protected static ?string $pluralModelLabel = 'Services';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informations Générales')
                    ->schema([
                        Forms\Components\TextInput::make('titre')
                            ->required()
                            ->maxLength(255)
                            ->label('Titre du service'),
                        Forms\Components\Textarea::make('description')
                            ->required()
                            ->columnSpanFull(),
                        Forms\Components\Select::make('categorie')
                            ->required()
                            ->options([
                                'plomberie' => 'Plomberie',
                                'electricite' => 'Électricité',
                                'menage' => 'Ménage',
                                'jardinage' => 'Jardinage',
                                'securite' => 'Sécurité',
                                'transport' => 'Transport',
                                'autre' => 'Autre',
                            ])
                            ->label('Catégorie'),
                    ])->columns(2),

                Forms\Components\Section::make('Tarification & Disponibilité')
                    ->schema([
                        Forms\Components\TextInput::make('prix')
                            ->required()
                            ->numeric()
                            ->prefix('XOF')
                            ->label('Prix'),
                        Forms\Components\Select::make('disponibilite')
                            ->required()
                            ->options([
                                'disponible' => 'Disponible',
                                'limite' => 'Disponibilité limitée',
                                'indisponible' => 'Indisponible temporairement',
                            ])
                            ->label('Disponibilité'),
                    ])->columns(2),

                Forms\Components\Section::make('Tags et Publication')
                    ->schema([
                        Forms\Components\TagsInput::make('tags')
                            ->required()
                            ->label('Tags'),
                        Forms\Components\Toggle::make('publie')
                            ->required()
                            ->label('Publier le service')
                            ->helperText('Activer pour rendre le service visible dans le catalogue'),
                    ]),

                Forms\Components\Hidden::make('user_id')
                    ->default(auth()->id()),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('titre')
                    ->searchable()
                    ->limit(50)
                    ->label('Titre'),
                Tables\Columns\TextColumn::make('categorie')
                    ->searchable()
                    ->label('Catégorie'),
                Tables\Columns\TextColumn::make('prix')
                    ->numeric()
                    ->money('XOF')
                    ->sortable()
                    ->label('Prix'),
                Tables\Columns\BadgeColumn::make('disponibilite')
                    ->colors([
                        'success' => 'disponible',
                        'warning' => 'limite',
                        'danger' => 'indisponible',
                    ])
                    ->label('Disponibilité'),
                Tables\Columns\IconColumn::make('publie')
                    ->boolean()
                    ->label('Publié'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label('Date de création'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('categorie')
                    ->options([
                        'plomberie' => 'Plomberie',
                        'electricite' => 'Électricité',
                        'menage' => 'Ménage',
                        'jardinage' => 'Jardinage',
                        'securite' => 'Sécurité',
                        'transport' => 'Transport',
                        'autre' => 'Autre',
                    ]),
                Tables\Filters\SelectFilter::make('disponibilite')
                    ->options([
                        'disponible' => 'Disponible',
                        'limite' => 'Disponibilité limitée',
                        'indisponible' => 'Indisponible temporairement',
                    ]),
                Tables\Filters\TernaryFilter::make('publie')
                    ->label('Publié'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\Action::make('togglePublication')
                    ->label(fn (Service $record): string => $record->publie ? 'Dépublier' : 'Publier')
                    ->icon(fn (Service $record): string => $record->publie ? 'heroicon-o-eye-slash' : 'heroicon-o-eye')
                    ->color(fn (Service $record): string => $record->publie ? 'danger' : 'success')
                    ->action(function (Service $record): void {
                        $record->update(['publie' => !$record->publie]);
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\BulkAction::make('publier')
                        ->label('Publier')
                        ->icon('heroicon-o-eye')
                        ->color('success')
                        ->action(fn (Builder $query) => $query->update(['publie' => true])),
                    Tables\Actions\BulkAction::make('depublier')
                        ->label('Dépublier')
                        ->icon('heroicon-o-eye-slash')
                        ->color('danger')
                        ->action(fn (Builder $query) => $query->update(['publie' => false])),
                ]),
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
            'index' => Pages\ListServices::route('/'),
            'create' => Pages\CreateService::route('/create'),
            'edit' => Pages\EditService::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('user_id', auth()->id());
    }
}
