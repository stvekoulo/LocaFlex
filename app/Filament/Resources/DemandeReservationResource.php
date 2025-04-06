<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DemandeReservationResource\Pages;
use App\Filament\Resources\DemandeReservationResource\RelationManagers;
use App\Models\DemandeReservation;
use App\Models\Paiement;
use App\Mail\DemandeBienRefuserMail;
use App\Mail\DemandeBienAccepterMail;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class DemandeReservationResource extends Resource
{
    protected static ?string $model = DemandeReservation::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';
    protected static ?string $navigationLabel = 'Demandes de Biens';
    protected static ?string $modelLabel = 'Demande de Bien';
    protected static ?string $pluralModelLabel = 'Demandes de Biens';
    protected static ?string $navigationGroup = 'Demandes';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Détails de la demande')
                    ->schema([
                        Forms\Components\Select::make('bien_id')
                            ->relationship('bien', 'titre')
                            ->disabled()
                            ->label('Bien demandé'),
                        Forms\Components\TextInput::make('duree')
                            ->disabled()
                            ->label('Durée (jours)'),
                        Forms\Components\Textarea::make('motif')
                            ->disabled()
                            ->label('Motif de la demande'),
                        Forms\Components\Select::make('user_id')
                            ->relationship('user', 'name')
                            ->disabled()
                            ->label('Demandeur'),
                        Forms\Components\Select::make('etat')
                            ->options([
                                'En attente' => 'En attente',
                                'Validé' => 'Accepté',
                                'Refusé' => 'Refusé',
                            ])
                            ->required()
                            ->label('État')
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('bien.titre')
                    ->searchable()
                    ->label('Bien'),
                Tables\Columns\TextColumn::make('user.name')
                    ->searchable()
                    ->label('Demandeur'),
                Tables\Columns\TextColumn::make('duree')
                    ->label('Durée (jours)'),
                Tables\Columns\TextColumn::make('motif')
                    ->searchable()
                    ->limit(30)
                    ->label('Motif'),
                Tables\Columns\BadgeColumn::make('etat')
                    ->colors([
                        'warning' => 'En attente',
                        'success' => 'Validé',
                        'danger' => 'Refusé',
                    ])
                    ->label('État'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->label('Date de demande'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('etat')
                    ->options([
                        'En attente' => 'En attente',
                        'Validé' => 'Accepté',
                        'Refusé' => 'Refusé',
                    ])
                    ->label('État'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('accepter')
                    ->label('Accepter')
                    ->icon('heroicon-o-check')
                    ->color('success')
                    ->visible(fn (DemandeReservation $record): bool => $record->etat === 'En attente')
                    ->action(function (DemandeReservation $record): void {
                        $utilisateur = Auth::user();
                        $record->update(['etat' => 'Validé']);

                        Paiement::create([
                            'montant' => $record->bien->prix,
                            'user_id' => $record->user_id,
                            'owner_id' => $utilisateur->id,
                            'bien_id' => $record->bien_id,
                            'etat' => 'En attente de paiement',
                        ]);

                        Mail::to($record->user->email)->send(new DemandeBienAccepterMail($record->user));
                    }),
                Tables\Actions\Action::make('refuser')
                    ->label('Refuser')
                    ->icon('heroicon-o-x-mark')
                    ->color('danger')
                    ->visible(fn (DemandeReservation $record): bool => $record->etat === 'En attente')
                    ->action(function (DemandeReservation $record): void {
                        $record->update(['etat' => 'Refusé']);
                        Mail::to($record->user->email)->send(new DemandeBienRefuserMail($record->user));
                    }),
            ])
            ->bulkActions([]);
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
            'index' => Pages\ListDemandeReservations::route('/'),
            'edit' => Pages\EditDemandeReservation::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('owner_id', auth()->id());
    }

    public static function canCreate(): bool
    {
        return false;
    }
}
