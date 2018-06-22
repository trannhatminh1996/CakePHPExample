<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

class ScrollingController extends AppController
{

    public function display()
    {
        $bookmarktable = TableRegistry::get('Bookmarks');
        $count= $bookmarktable->find('all')->count();
        $this->set(compact('count'));
    }
}
