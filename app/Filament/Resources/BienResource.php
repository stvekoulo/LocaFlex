<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BienResource\Pages;
use App\Filament\Resources\BienResource\RelationManagers;
use App\Models\Bien;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class BienResource extends Resource
{
    protected static ?string $model = Bien::class;

    protected static ?string $navigationIcon = 'heroicon-o-home';
    protected static ?string $navigationLabel = 'Mes Biens';
    protected static ?string $modelLabel = 'Bien';
    protected static ?string $pluralModelLabel = 'Biens';
    protected static ?string $navigationGroup = 'Gestion des biens';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informations Générales')
                    ->schema([
                        Forms\Components\TextInput::make('titre')
                            ->required()
                            ->maxLength(255)
                            ->label('Titre'),
                        Forms\Components\Textarea::make('description')
                            ->required()
                            ->columnSpanFull(),
                        Forms\Components\Select::make('categorie')
                            ->required()
                            ->options([
                                'electromenager' => 'Electroménager',
                                'transport' => 'Transport',
                                'meubles' => 'Meubles',
                                'vetements' => 'Vêtements',
                                'electronique' => 'Électronique',
                                'jouets' => 'Jouets',
                                'sport' => 'Sport',
                                'outils' => 'Outils',
                                'accessoires' => 'Accessoires',
                                'livres' => 'Livres',
                                'musique' => 'Musique',
                                'jardinage' => 'Jardinage',
                                'bricolage' => 'Bricolage',
                                'artisanat' => 'Artisanat',
                                'decoration' => 'Décoration',
                                'cuisine' => 'Cuisine',
                                'voyage' => 'Voyage',
                                'animaux' => 'Animaux',
                                'beaute' => 'Beauté',
                            ])
                            ->label('Catégorie'),
                    ])->columns(2),

                Forms\Components\Section::make('Caractéristiques & Prix')
                    ->schema([
                        Forms\Components\Textarea::make('caracteristiques')
                            ->required()
                            ->label('Caractéristiques'),
                        Forms\Components\TextInput::make('prix')
                            ->required()
                            ->numeric()
                            ->prefix('XOF')
                            ->label('Prix'),
                        Forms\Components\TextInput::make('emplacement')
                            ->required()
                            ->maxLength(255)
                            ->label('Emplacement'),
                        Forms\Components\Select::make('disponibilite')
                            ->required()
                            ->options([
                                'Disponible' => 'Disponible',
                                'Occupé' => 'Occupé',
                                //'EN_RENOVATION' => 'En rénovation',
                            ])
                            ->label('Disponibilité'),
                    ])->columns(2),

                Forms\Components\Section::make('Photos')
                    ->schema([
                        Forms\Components\FileUpload::make('photos')
                            ->label('Photos du bien')
                            ->multiple()
                            ->image()
                            ->imageResizeMode('cover')
                            ->imageCropAspectRatio('16:9')
                            ->imageResizeTargetWidth('1920')
                            ->imageResizeTargetHeight('1080')
                            ->directory('bien-photos')
                            ->maxFiles(10)
                            ->helperText('Vous pouvez télécharger jusqu\'à 10 photos (16:9)')
                            ->columnSpanFull(),
                    ]),

                Forms\Components\Section::make('Tags et Publication')
                    ->schema([
                        Forms\Components\TagsInput::make('tags')
                            ->required()
                            ->label('Tags'),
                        Forms\Components\Toggle::make('publie')
                            ->required()
                            ->label('Publier le bien')
                            ->helperText('Activer pour rendre le bien visible dans le catalogue'),
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
                Tables\Columns\TextColumn::make('emplacement')
                    ->searchable()
                    ->limit(30)
                    ->label('Emplacement'),
                Tables\Columns\BadgeColumn::make('disponibilite')
                    ->colors([
                        'success' => 'Disponible',
                        'danger' => 'Occupé',
                        //'warning' => 'EN_RENOVATION',
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
                        'electromenager' => 'Electroménager',
                        'transport' => 'Transport',
                        'meubles' => 'Meubles',
                        'vetements' => 'Vêtements',
                        'electronique' => 'Électronique',
                        'jouets' => 'Jouets',
                        'sport' => 'Sport',
                        'outils' => 'Outils',
                        'accessoires' => 'Accessoires',
                        'livres' => 'Livres',
                        'musique' => 'Musique',
                        'jardinage' => 'Jardinage',
                        'bricolage' => 'Bricolage',
                        'artisanat' => 'Artisanat',
                        'decoration' => 'Décoration',
                        'cuisine' => 'Cuisine',
                        'voyage' => 'Voyage',
                        'animaux' => 'Animaux',
                        'beaute' => 'Beauté',
                    ]),
                Tables\Filters\SelectFilter::make('disponibilite')
                    ->options([
                        'Disponible' => 'Disponible',
                        'Occupé' => 'Occupé',
                        //'EN_RENOVATION' => 'En rénovation',
                    ]),
                Tables\Filters\TernaryFilter::make('publie')
                    ->label('Publié'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\Action::make('togglePublication')
                    ->label(fn (Bien $record): string => $record->publie ? 'Dépublier' : 'Publier')
                    ->icon(fn (Bien $record): string => $record->publie ? 'heroicon-o-eye-slash' : 'heroicon-o-eye')
                    ->color(fn (Bien $record): string => $record->publie ? 'danger' : 'success')
                    ->action(function (Bien $record): void {
                        $record->update(['publie' => !$record->publie]);
                    }),
                Tables\Actions\Action::make('voirPhotos')
                    ->label('Photos')
                    ->icon('heroicon-o-photo')
                    ->color('info')
                    ->url(fn (Bien $record): string => static::getUrl('edit', ['record' => $record]) . '#relation-photos'),
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
            RelationManagers\PhotosRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBiens::route('/'),
            'create' => Pages\CreateBien::route('/create'),
            'edit' => Pages\EditBien::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('user_id', auth()->id());
    }
}
