<?php

it('returns a successful response', function () {
    $response = $this->withSession(['weather_show_plugin_city' => 'brussels'])->get('/');

    $response->assertStatus(200);
});
