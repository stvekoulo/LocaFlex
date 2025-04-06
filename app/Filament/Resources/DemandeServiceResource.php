<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DemandeServiceResource\Pages;
use App\Filament\Resources\DemandeServiceResource\RelationManagers;
use App\Models\DemandeService;
use App\Models\Paiement;
use App\Models\User;
use App\Mail\DemandeServiceRefuserMail;
use App\Mail\DemandeServiceAccepterMail;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class DemandeServiceResource extends Resource
{
    protected static ?string $model = DemandeService::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-check';
    protected static ?string $navigationLabel = 'Demandes de Services';
    protected static ?string $modelLabel = 'Demande de Service';
    protected static ?string $pluralModelLabel = 'Demandes de Services';
    protected static ?string $navigationGroup = 'Demandes';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Détails de la demande')
                    ->schema([
                        Forms\Components\Select::make('service_id')
                            ->relationship('services', 'titre')
                            ->disabled()
                            ->label('Service demandé'),
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
                Tables\Columns\TextColumn::make('services.titre')
                    ->searchable()
                    ->label('Service'),
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
                    ->visible(fn (DemandeService $record): bool => $record->etat === 'En attente')
                    ->requiresConfirmation()
                    ->modalHeading('Accepter la demande')
                    ->modalDescription('Voulez-vous également marquer le service comme "Occupé"?')
                    ->form([
                        Forms\Components\Checkbox::make('marquer_occupe')
                            ->label('Marquer le service comme "Occupé"')
                            ->default(true),
                    ])
                    ->action(function (DemandeService $record, array $data): void {
                        $utilisateur = Auth::user();
                        $record->update(['etat' => 'Validé']);

                        if ($data['marquer_occupe'] ?? false) {
                            $record->services()->update(['disponibilite' => 'Occupé']);
                        }

                        Paiement::create([
                            'montant' => $record->services->prix,
                            'user_id' => $record->user_id,
                            'owner_id' => $utilisateur->id,
                            'service_id' => $record->service_id,
                            'etat' => 'En attente de paiement',
                        ]);

                        Mail::to($record->user->email)->send(new DemandeServiceAccepterMail($record->user));
                    }),
                Tables\Actions\Action::make('refuser')
                    ->label('Refuser')
                    ->icon('heroicon-o-x-mark')
                    ->color('danger')
                    ->visible(fn (DemandeService $record): bool => $record->etat === 'En attente')
                    ->action(function (DemandeService $record): void {
                        $record->update(['etat' => 'Refusé']);
                        Mail::to($record->user->email)->send(new DemandeServiceRefuserMail($record->user));
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
            'index' => Pages\ListDemandeServices::route('/'),
            'edit' => Pages\EditDemandeService::route('/{record}/edit'),
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
