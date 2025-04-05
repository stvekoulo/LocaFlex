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
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BienResource extends Resource
{
    protected static ?string $model = Bien::class;

    protected static ?string $navigationIcon = 'heroicon-o-home';

    protected static ?string $navigationGroup = 'Gestion des biens';

    protected static ?string $recordTitleAttribute = 'titre';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('titre')
                    ->required()
                    ->maxLength(255),

                Forms\Components\Textarea::make('description')
                    ->required()
                    ->columnSpanFull(),

                Forms\Components\Select::make('categorie')
                    ->options([
                        'Appartement' => 'Appartement',
                        'Maison' => 'Maison',
                        'Villa' => 'Villa',
                        'Studio' => 'Studio',
                        'Bureau' => 'Bureau',
                        'Local commercial' => 'Local commercial',
                        'Terrain' => 'Terrain',
                        'Autre' => 'Autre',
                    ])
                    ->required(),

                Forms\Components\TagsInput::make('caracteristiques')
                    ->placeholder('Ajouter une caractéristique et appuyer sur Entrée')
                    ->required(),

                Forms\Components\TextInput::make('prix')
                    ->numeric()
                    ->prefix('XAF')
                    ->required(),

                Forms\Components\TextInput::make('emplacement')
                    ->required()
                    ->maxLength(255),

                Forms\Components\Select::make('disponibilite')
                    ->options([
                        'Disponible' => 'Disponible',
                        'Occupé' => 'Occupé',
                    ])
                    ->required(),

                Forms\Components\TagsInput::make('tags')
                    ->placeholder('Ajouter un tag et appuyer sur Entrée')
                    ->required(),

                Forms\Components\Toggle::make('publie')
                    ->label('Publier ce bien')
                    ->default(false)
                    ->required(),

                Forms\Components\Section::make('Photos')
                    ->schema([
                        Forms\Components\Repeater::make('photos')
                            ->relationship()
                            ->schema([
                                Forms\Components\FileUpload::make('url')
                                    ->label('Photo')
                                    ->image()
                                    ->imageResizeMode('cover')
                                    ->imageCropAspectRatio('16:9')
                                    ->directory('biens-photos')
                                    ->required(),
                                Forms\Components\TextInput::make('alt')
                                    ->label('Description de l\'image')
                                    ->required(),
                            ])
                            ->defaultItems(0)
                            ->addActionLabel('Ajouter une photo')
                            ->collapsible()
                    ])->collapsible(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('titre')
                    ->searchable(),

                Tables\Columns\TextColumn::make('categorie')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('prix')
                    ->money('XAF')
                    ->sortable(),

                Tables\Columns\TextColumn::make('emplacement')
                    ->searchable(),

                Tables\Columns\IconColumn::make('disponibilite')
                    ->icon(fn (string $state): string => match ($state) {
                        'Disponible' => 'heroicon-o-check-circle',
                        'Occupé' => 'heroicon-o-x-circle',
                    })
                    ->color(fn (string $state): string => match ($state) {
                        'Disponible' => 'success',
                        'Occupé' => 'danger',
                    }),

                Tables\Columns\IconColumn::make('publie')
                    ->boolean()
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('categorie')
                    ->options([
                        'Appartement' => 'Appartement',
                        'Maison' => 'Maison',
                        'Villa' => 'Villa',
                        'Studio' => 'Studio',
                        'Bureau' => 'Bureau',
                        'Local commercial' => 'Local commercial',
                        'Terrain' => 'Terrain',
                        'Autre' => 'Autre',
                    ]),

                SelectFilter::make('disponibilite')
                    ->options([
                        'Disponible' => 'Disponible',
                        'Occupé' => 'Occupé',
                    ]),

                TernaryFilter::make('publie')
                    ->label('Statut de publication'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\Action::make('togglePublie')
                    ->label(fn (Bien $record): string => $record->publie ? 'Dépublier' : 'Publier')
                    ->icon(fn (Bien $record): string => $record->publie ? 'heroicon-o-eye-slash' : 'heroicon-o-eye')
                    ->color(fn (Bien $record): string => $record->publie ? 'warning' : 'success')
                    ->action(function (Bien $record): void {
                        $record->update(['publie' => !$record->publie]);
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\BulkAction::make('publier')
                        ->label('Publier la sélection')
                        ->icon('heroicon-o-eye')
                        ->color('success')
                        ->action(function (Builder $query): void {
                            $query->update(['publie' => true]);
                        }),
                    Tables\Actions\BulkAction::make('depublier')
                        ->label('Dépublier la sélection')
                        ->icon('heroicon-o-eye-slash')
                        ->color('warning')
                        ->action(function (Builder $query): void {
                            $query->update(['publie' => false]);
                        }),
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
            'index' => Pages\ListBiens::route('/'),
            'create' => Pages\CreateBien::route('/create'),
            'edit' => Pages\EditBien::route('/{record}/edit'),
            //'view' => Pages\ViewBien::route('/{record}'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('user_id', auth()->id())
            ->latest();
    }
}
