<?php



/**
 * Test class for Checkbox.
 * @group Core
 */
class CheckboxTest extends PHPUnit_Framework_TestCase {

    /**
     * @var Checkbox
     */
    protected $checkbox;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        $this->checkbox = new Checkbox;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {

    }

    public function test__toString_WithoutProperties() {
        $this->checkbox->setIdentifier('SelectAll');
        $expectedAttributes = array(
            'type="checkbox"',
            'id="chkSelectAll"',
            'name="chkSelectAll"',
            'value=""',
        );
        $html = $this->checkbox->__toString();

        foreach ($expectedAttributes as $attribute) {
            $this->assertRegExp("/{$attribute}/", $html);
        }
    }

    public function test__toString_WithProperties() {
        $this->checkbox->setIdentifier('SelectAll_checkbox');
        $this->checkbox->setProperties(array(
            'id' => 'chkSelAll',
            'label' => 'Select All',
            'name' => '_selectall',
            'value' => 10,
        ));
        $expectedAttributes = array(
            'type="checkbox"',
            'id="chkSelAll"',
            'name="_selectall"',
            'value="10"',
        );
        $html = $this->checkbox->__toString();

        foreach ($expectedAttributes as $attribute) {
            $this->assertRegExp("/{$attribute}/", $html);
        }
    }

}

?>
