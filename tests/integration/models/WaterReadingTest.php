<?php

use App\WaterReading;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class WaterReadingTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions;

    /** @test */
    function it_creates_the_initial_water_reading()
    {
        // given that there is a user
        $user = factory(App\User::class)->create();
        // and there are water reading's attributes
        $attributes = array('user_id' => $user->id, 'date' => Carbon::today(), 'state' => 10);

        // and there is an attempt to create the water reading
        $waterReading = WaterReading::create($attributes);

        // reading has been persisted in the database
        $this->seeInDatabase('water_readings', $waterReading->getAttributes());
        // and usage is null
        $this->assertNull($waterReading->usage);
    }

    /** @test */
    function it_calculates_the_usage()
    {
        // given that there is a user
        $user = factory(App\User::class)->create();
        // and initial water reading with state equal to 10
        $initialWaterReading = WaterReading::create(['user_id' => $user->id, 'date' => Carbon::today(), 'state' => 10]);

        // and there is an attempt to create another water reading
        $waterReading = WaterReading::create(['user_id' => $user->id, 'date' => Carbon::today(), 'state' => 30]);

        // reading has been persisted in the database
        $this->seeInDatabase('water_readings', $waterReading->getAttributes());
        // and initial water reading has been set as a previous reading
        $this->assertEquals($initialWaterReading->id, $waterReading->previous->id);
        // and usage is equal to 20
        $this->assertEquals(20, $waterReading->usage);
    }

    /** @test */
    function it_does_not_calculate_the_usage_when_it_should_be_fixed()
    {
        // given that there is a user
        $user = factory(App\User::class)->create();
        // and initial water reading with state equal to 10
        $initialWaterReading = WaterReading::create(['user_id' => $user->id, 'date' => Carbon::today(), 'state' => 10]);

        // and there is an attempt to create another water reading with fixed usage
        $waterReading = WaterReading::create([
            'user_id' => $user->id,
            'date' => Carbon::today(),
            'state' => 5,
            'fixed_usage' => true,
            'usage' => 7
        ]);

        // reading has been persisted in the database
        $this->seeInDatabase('water_readings', $waterReading->getAttributes());
        // and initial water reading has been set as a previous reading
        $this->assertEquals($initialWaterReading->id, $waterReading->previous->id);
        // and usage is equal to 7
        $this->assertEquals(7, $waterReading->usage);
    }

    /** @test */
    function it_fills_the_gap_while_deleting()
    {
        // given that there are 3 water readings
        $waterReadings = $this->_create_test_readings();

        // and there is an attempt to delete the second one
        $waterReadings[1]->delete();

        // reading is deleted
        $this->notSeeInDatabase('water_readings', $waterReadings[1]->getAttributes());
        // and first reading's next reading reference points to the third one
        $this->assertEquals($waterReadings[2]->fresh()->id, $waterReadings[0]->fresh()->next->id);
        // and third reading's previous reading reference points to the first one
        $this->assertEquals($waterReadings[0]->fresh()->id, $waterReadings[2]->fresh()->previous->id);
        // and third reading's usage is recalculated using the state from the first one
        $this->assertEquals(
            $waterReadings[2]->fresh()->state - $waterReadings[0]->fresh()->state,
            $waterReadings[2]->fresh()->usage
        );
    }

    /** @test */
    function it_nullifies_the_previous_reading_reference_if_there_is_none_after_deleting()
    {
        // given that there are 3 water readings
        $waterReadings = $this->_create_test_readings();

        // and there is an attempt to delete the first one
        $waterReadings[0]->delete();

        // reading is deleted
        $this->notSeeInDatabase('water_readings', $waterReadings[0]->getAttributes());
        // and second reading's previous reading reference is nullified
        $this->assertNull($waterReadings[1]->fresh()->previous);
        // and its usage is nullified
        $this->assertNull($waterReadings[1]->fresh()->usage);
    }

    /** @test */
    function it_recalculates_usage_if_state_is_changed()
    {
        // given that there are 3 water readings
        $waterReadings = $this->_create_test_readings();
        // store the previous usages of the readings
        $usages = collect($waterReadings)->map(function (WaterReading $waterReading) {
            return $waterReading->usage;
        })->toArray();

        // and there is an attempt to update state of the second one
        $waterReadings[1]->state += 2;
        $waterReadings[1]->save();

        // reading is updated
        $this->seeInDatabase('water_readings', $waterReadings[1]->getAttributes());
        // and current reading's usage is updated
        $this->assertEquals($usages[1] + 2, $waterReadings[1]->fresh()->usage);
        // and next reading's usage is also updated
        $this->assertEquals($usages[2] - 2, $waterReadings[2]->fresh()->usage);
    }

    /**
     * @return WaterReading[]
     */
    private function _create_test_readings()
    {
        // given that there is a user
        $user = factory(App\User::class)->create();
        // create 3 water readings
        return [
            WaterReading::create(['user_id' => $user->id, 'date' => Carbon::today(), 'state' => 10]),
            WaterReading::create(['user_id' => $user->id, 'date' => Carbon::today(), 'state' => 25]),
            WaterReading::create(['user_id' => $user->id, 'date' => Carbon::today(), 'state' => 38])
        ];
    }
}