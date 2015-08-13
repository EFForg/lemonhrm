<?php



/**
 * Test class for PropertyPopulator.
 * @group Core
 */
class PropertyPopulatorTest extends PHPUnit_Framework_TestCase {

    /**
     * @var PropertyPopulator
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {

    }

    public function testPopulateFromArray() {
        $object = new PropertyPopulableClass();

        $this->assertNull($object->getName());
        $this->assertNull($object->getValue());
        $this->assertFalse($object->isActive());

        $object->populateFromArray(array(
            'name' => 'Project 1',
            'value' => 50000,
            'isActive' => true,
        ));

        $this->assertEquals('Project 1', $object->getName());
        $this->assertEquals(50000, $object->getValue());
        $this->assertTrue($object->isActive());
    }

}

class PropertyPopulableClass implements PopulatableFromArray {

    protected $name;
    protected $value;
    protected $isActive;

    function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getValue() {
        return $this->value;
    }

    public function setValue($value) {
        $this->value = $value;
    }

    public function isActive($isActive = null) {
        if (is_null($isActive)) {
            return (bool) $this->isActive;
        } else {
            $this->isActive = (bool) $isActive;
        }
    }

    public function populateFromArray(array $properties) {
        PropertyPopulator::populateFromArray($this, $properties);
    }

}

?>
