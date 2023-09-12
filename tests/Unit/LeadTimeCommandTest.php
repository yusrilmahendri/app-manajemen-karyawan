<?php

namespace Tests\Unit;
use Tests\TestCase;
use Illuminate\Support\Facades\Artisan;

class LeadTimeCommandTest extends TestCase
{
    public function testLeadTimeCommand()
    {
        // Execute the SendRemindersCommand
        Artisan::call('reminders:send');

        // Get the output of the command
        $output = Artisan::output();

        // Dump the output for inspection
        // dd($output);

        // Add assertions to test the desired behavior
        // Example: $this->assertContains('Reminders sent successfully.', $output);
    }
}