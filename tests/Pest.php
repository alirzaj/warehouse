<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

uses(Tests\TestCase::class)->in('Feature');
uses(RefreshDatabase::class, WithFaker::class)->in('Feature', 'Unit');
