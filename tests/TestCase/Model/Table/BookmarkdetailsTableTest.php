<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\BookmarkdetailsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\BookmarkdetailsTable Test Case
 */
class BookmarkdetailsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\BookmarkdetailsTable
     */
    public $Bookmarkdetails;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.bookmarkdetails',
        'app.bookmarks'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Bookmarkdetails') ? [] : ['className' => BookmarkdetailsTable::class];
        $this->Bookmarkdetails = TableRegistry::getTableLocator()->get('Bookmarkdetails', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Bookmarkdetails);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
