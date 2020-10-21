<?php
use PHPUnit\Framework\TestCase;
use App\Controller\Gravity;

class GravityTest extends TestCase
{
    # Actions
        # accept initial state
        # accept new “rows” for a given identifier
            # put the new row(s) at the top,
            # process, update the stored results
            # return success or  errors.
        # Return the results for a given identifier if requested.
        # Update the results for a given identifier if requested.
        # Delete results for a given identifier.
        # load the state
    # Results
        # store the results
        # not required to persist across restarts;
        # return an identifier with success or error

    # Accept multiple worlds and updates, and process them concurrently.
    # Metrics
        # Key aspects of this application should be timed or counted
        # available for future monitoring
        # in-memory solutions are acceptable
    # Testing
        # Reasonable testing & logging should be implemented.
    public function testDropTwoRows()
    {
        $terrain = Gravity::addTerrain("T. :\nT.. ");
        $this->assertSame("T   \nT:.:", $terrain);
    }
    public function testDropOneRow()
    {
        $terrain = Gravity::addTerrain("T. :");
        $this->assertSame("T. :", $terrain);
    }
    public function testAddTerrainInvalidChar()
    {
        $this->expectExceptionMessage("Invalid characters found.");
        Gravity::addTerrain(";P");
    }
    public function testAddTerrainInvalidWidth()
    {
        $this->expectExceptionMessage("Invalid width.");
        Gravity::addTerrain("T. :\n.");
    }
    public function testAddTerrainToExisting()
    {
        $terrain = Gravity::addTerrain("T. :","T.. ");
        $this->assertSame("T   \nT:.:", $terrain);
    }
}