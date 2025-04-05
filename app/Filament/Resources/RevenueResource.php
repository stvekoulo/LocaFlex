<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RevenueResource\Pages;
use App\Models\Paiement;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class RevenueResource extends Resource
{
    protected static ?string $model = Paiement::class;

    protected static ?string $navigationIcon = 'heroicon-o-banknotes';
    protected static ?string $navigationLabel = 'Mes Revenus';
    protected static ?string $modelLabel = 'Revenu';
    protected static ?string $pluralModelLabel = 'Revenus';
    protected static ?string $navigationGroup = 'Finance';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Détails du paiement')
                    ->schema([
                        Forms\Components\TextInput::make('montant')
                            ->disabled()
                            ->prefix('XOF')
                            ->numeric(),
                        Forms\Components\Select::make('etat')
                            ->disabled()
                            ->options([
                                'En attente de paiement' => 'En attente de paiement',
                                'Payé' => 'Payé',
                                'Annulé' => 'Annulé',
                            ]),
                        Forms\Components\Select::make('bien_id')
                            ->relationship('bien', 'titre')
                            ->disabled()
                            ->label('Bien concerné')
                            ->visible(fn ($record) => $record && $record->bien_id),
                        Forms\Components\Select::make('service_id')
                            ->relationship('service', 'titre')
                            ->disabled()
                            ->label('Service concerné')
                            ->visible(fn ($record) => $record && $record->service_id),
                        Forms\Components\Select::make('user_id')
                            ->relationship('client', 'name')
                            ->disabled()
                            ->label('Client'),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->label('Date'),
                Tables\Columns\TextColumn::make('item')
                    ->label('Article')
                    ->getStateUsing(function ($record) {
                        if ($record->bien_id) {
                            return $record->bien ? $record->bien->titre : 'Bien inconnu';
                        } elseif ($record->service_id) {
                            return $record->service ? $record->service->titre : 'Service inconnu';
                        }
                        return 'Non spécifié';
                    }),
                Tables\Columns\TextColumn::make('type')
                    ->label('Type')
                    ->badge()
                    ->getStateUsing(fn ($record) => $record->bien_id ? 'Bien' : 'Service')
                    ->colors([
                        'primary' => fn ($state) => $state === 'Bien',
                        'success' => fn ($state) => $state === 'Service',
                    ]),
                Tables\Columns\TextColumn::make('client.name')
                    ->label('Client')
                    ->searchable(),
                Tables\Columns\TextColumn::make('montant')
                    ->label('Montant')
                    ->money('XOF')
                    ->sortable(),
                Tables\Columns\BadgeColumn::make('etat')
                    ->label('État')
                    ->colors([
                        'warning' => 'En attente de paiement',
                        'success' => 'Payé',
                        'danger' => 'Annulé',
                    ]),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('etat')
                    ->options([
                        'En attente de paiement' => 'En attente de paiement',
                        'Payé' => 'Payé',
                        'Annulé' => 'Annulé',
                    ])
                    ->label('État'),
                Tables\Filters\SelectFilter::make('type')
                    ->options([
                        'bien' => 'Bien',
                        'service' => 'Service',
                    ])
                    ->query(function (Builder $query, array $data) {
                        if ($data['value'] === 'bien') {
                            return $query->whereNotNull('bien_id');
                        } elseif ($data['value'] === 'service') {
                            return $query->whereNotNull('service_id');
                        }
                    })
                    ->label('Type'),
                Tables\Filters\Filter::make('created_at')
                    ->form([
                        Forms\Components\DatePicker::make('from')
                            ->label('Du'),
                        Forms\Components\DatePicker::make('until')
                            ->label('Au'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    })
                    ->label('Période'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([])
            ->defaultSort('created_at', 'desc');
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
            'index' => Pages\ListRevenues::route('/'),
            'view' => Pages\ViewRevenue::route('/{record}'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('owner_id', auth()->id());
    }
}
