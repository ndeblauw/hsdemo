<?php

it('checks that no dd, dump nor ray statements are used', function () {
    expect(['dd', 'dump', 'ray'])->each->not()->toBeUsed();
});

it('checks that interfaces are clean')
    ->arch('app')->expect('App\Services\Interfaces')
    ->toBeAbstract()
    ->toBeInterface();

it('checks that jobs are ran on the queue only')
    ->arch('app')
    ->expect('App\Jobs')
    ->toImplement('Illuminate\Contracts\Queue\ShouldQueue');

it('checks that notifications are ran on the queue only')
    ->arch('app')
    ->expect('App\Notifications')
    ->toImplement('Illuminate\Contracts\Queue\ShouldQueue')
    ->ignoring([\App\Notifications\WelcomeNewUser::class]);


it('checks that models are not used elsewhere than in App and Database')
    ->arch('models')
    ->expect('App\Models')
    ->toOnlyBeUsedIn(['App', 'Database']);
