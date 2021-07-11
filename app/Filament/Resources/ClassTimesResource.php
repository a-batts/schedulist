<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ClassTimesResource\Pages;
use App\Filament\Resources\ClassTimesResource\RelationManagers;
use App\Filament\Roles;
use Filament\Resources\Forms\Components;
use Filament\Resources\Forms\Form;
use Filament\Resources\Resource;
use Filament\Resources\Tables\Columns;
use Filament\Resources\Tables\Filter;
use Filament\Resources\Tables\Table;
use App\Models\ClassTimes;
use Auth;

class ClassTimesResource extends Resource
{
    public static $icon = 'heroicon-o-bell';
    public static $label = 'Class Schedules';
    public static $title = 'Manage Class Times';
    public static $model = ClassTimes::class;

    public static function form(Form $form)
    {
        return $form
            ->schema([
              Components\Grid::make([
                Components\TextInput::make('type')->autofocus()->required(),
                Components\TextInput::make('location')->email()->nullable(),
                Components\Select::make('schedule_type')->required()->options([
                  'normal' => 'Fixed',
                  'block' => 'Block',
                ])->label('Schedule Type'),
                Components\TextInput::make('user_id')->numeric()->rules(['exists:users,id'])->label('User ID')->nullable(),
              ])->columns(2),
              Components\Tabs::make('Schedule Times and Days')
                ->tabs([
                    Components\Tab::make(
                        'Fixed Schedule',
                        [
                          Components\TextInput::make('fixed_start_times')->label('Start Times'),
                          Components\TextInput::make('fixed_end_times')->label('End Times'),
                          Components\TextInput::make('Monday'),
                          Components\TextInput::make('Tuesday'),
                          Components\TextInput::make('Wednesday'),
                          Components\TextInput::make('Thursday'),
                          Components\TextInput::make('Friday'),
                        ],
                    )->columns(3),
                    Components\Tab::make(
                        'Block Schedule',
                        [
                          Components\Grid::make([
                            Components\TextInput::make('block1')->label('Block 1 Days'),
                            Components\TextInput::make('block1_start')->label('Start Times'),
                            Components\TextInput::make('block1_end')->label('End Times'),
                            Components\TextInput::make('block2')->label('Block 2 Days'),
                            Components\TextInput::make('block2_start')->label('Start Times'),
                            Components\TextInput::make('block2_end')->label('End Times'),
                            Components\TextInput::make('block3')->label('Block 3 Days'),
                            Components\TextInput::make('block3_start')->label('Start Times'),
                            Components\TextInput::make('block3_end')->label('End Times'),
                            Components\TextInput::make('block4')->label('Block 4 Days'),
                            Components\TextInput::make('block4_start')->label('Start Times'),
                            Components\TextInput::make('block4_end')->label('Block 4 End Times'),
                            Components\TextInput::make('block5')->label('Block 5 Days'),
                            Components\TextInput::make('block5_start')->label('Start Times'),
                            Components\TextInput::make('block5_end')->label('End Times'),
                          ])->columns(3),

                          Components\Fieldset::make(
                              'Block Settings',
                              [
                                  Components\DatePicker::make('starting_date'),
                                  Components\Select::make('block_style')->options([
                                    'number' => 'Numerical',
                                    'letter' => 'Alphabetical',
                                  ]),
                                  Components\Select::make('number_of_blocks')->options([
                                    '1' => '1',
                                    '2' => '2',
                                    '3' => '3',
                                    '4' => '4',
                                    '5' => '5',
                                  ]),
                                  Components\Select::make('starting_block')->options([
                                    '1' => '1',
                                    '2' => '2',
                                    '3' => '3',
                                    '4' => '4',
                                    '5' => '5',
                                  ])
                              ],
                          )->columns(2),

                        ],
                    )
                ]),
            ]);
    }

    public static function table(Table $table)
    {
        return $table
            ->columns([
                Columns\Text::make('type')->primary()->searchable(),
                Columns\Text::make('location')->searchable(),
                Columns\Text::make('schedule_type'),
                Columns\Text::make('user_id')->sortable(),
                Columns\Text::make('needs_approval')->sortable(),
            ])
            ->filters([
                Filter::make('suggestions', fn ($query) => $query->where('needs_approval', 'true'))->label('Suggested Schedules'),
                Filter::make('schools', fn ($query) => $query->where('type', '!=', 'user')),
                Filter::make('individuals', fn ($query) => $query->where('type', 'user')),
                Filter::make('block', fn ($query) => $query->where('schedule_type', 'block'))->label('Fixed Schedule'),
                Filter::make('fixed', fn ($query) => $query->where('schedule_type', 'normal'))->label('Block Schedule'),
            ]);
    }

    public static function relations()
    {
        return [
            //
        ];
    }

    public static function routes()
    {
        return [
            Pages\ListClassTimes::routeTo('/', 'index'),
            Pages\CreateClassTimes::routeTo('/create', 'create'),
            Pages\EditClassTimes::routeTo('/{record}/edit', 'edit'),
        ];
    }
}
