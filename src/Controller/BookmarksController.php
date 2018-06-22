<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * Bookmarks Controller
 *
 * @property \App\Model\Table\BookmarksTable $Bookmarks
 *
 * @method \App\Model\Entity\Bookmark[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class BookmarksController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users'],
            'limit'=>10
        ];
        $bookmarks = $this->paginate($this->Bookmarks);

        $this->set(compact('bookmarks'));
    }

    /**
     * View method
     *
     * @param string|null $id Bookmark id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $bookmark = $this->Bookmarks->get($id, [
            'contain' => ['Users', 'Tags']
        ]);

        $test = TableRegistry::get('Bookmark');

        $test = TableRegistry::get('Bookmarkdetails');
        $bookmarkdetails = $test->find()->select(['id','content','created','modified'])->where(["bookmark_id=".$bookmark->id]);
        $this->set(['bookmark'=>$bookmark,'bookmarkdetails'=>$bookmarkdetails]);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $bookmark = $this->Bookmarks->newEntity();
        if ($this->request->is('post')) {
            $bookmark->user_id = $this->Auth->user('id');
            $bookmark = $this->Bookmarks->patchEntity($bookmark, $this->request->getData());
            if ($this->Bookmarks->save($bookmark)) {
                $this->Flash->success(__('The bookmark has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The bookmark could not be saved. Please, try again.'));
        }
        $users = $this->Bookmarks->Users->find('list', ['limit' => 200]);
        $tags = $this->Bookmarks->Tags->find('list', ['limit' => 200]);
        $this->set(compact('bookmark', 'users', 'tags'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Bookmark id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $bookmark = $this->Bookmarks->get($id, [
            'contain' => ['Tags']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $bookmark = $this->Bookmarks->patchEntity($bookmark, $this->request->getData());
            if ($this->Bookmarks->save($bookmark)) {
                $this->Flash->success(__('The bookmark has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The bookmark could not be saved. Please, try again.'));
        }
        $users = $this->Bookmarks->Users->find('list', ['limit' => 200]);
        $tags = $this->Bookmarks->Tags->find('list', ['limit' => 200]);
        $this->set(compact('bookmark', 'users', 'tags'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Bookmark id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $bookmark = $this->Bookmarks->get($id);
        if ($this->Bookmarks->delete($bookmark)) {
            $this->Flash->success(__('The bookmark has been deleted.'));
        } else {
            $this->Flash->error(__('The bookmark could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    public function tagged()
    {
        //get the array. For example: /bookmarks/tagged/Tutorial/Mobiles Games => $tags= ['Tutorial','Mobile Game']
        $tags = $this->request->params['pass'];
        //The same as above
        $path = func_get_args();

        //Find the tagged bookmarks
        $bookmarks = $this->Bookmarks->findTagged(['tags'=>$tags]);

        //$bookmarks = $this->Bookmarks->query('Select * from bookmarks');
        //$test = TableRegistry::get('Bookmarks');
        //$bookmarks = $test->find()->select(['id','title','url'])->from(['Tags','Bookmarks','Bookmarks_Tags'])->where(["Tags.title IN ('".$tags[0]."')and Tags.id=Bookmarks_Tags.tag_id and Bookmarks_Tags.bookmark_id=Bookmarks.id"]);
        $this->set(['bookmarks'=>$bookmarks,'tags'=>$tags,'path'=>$path]);
    }

    public function search()
    {
        $bookmarktitle = null;
        $number = 0;
        if ($this->request->is('post'))
        {
            if ($this->request->getData())
            {
                $data = $this->request->getData('Title');
                $bookmarktable = TableRegistry::get('Bookmarks');
                $bookmarktitle= $bookmarktable->find('all',array('contain'=>array('Tags','Bookmarkdetails')))->where("title like '%".$data."%'");
                $number = $bookmarktitle->count();
            }
        }
        $this->set(['bookmarktitle'=> $bookmarktitle,'number'=>$number]);
    }
    public function find(){
        $tagstable = TableRegistry::get('tags');
        $tags = $tagstable->find('all',array('contain'=>array('Bookmarks')));

        $bookmarktable = TableRegistry::get('Bookmarks');
        $bookmarks= $bookmarktable->find('all',array('contain'=>array('Tags','Bookmarkdetails','Users')));
        
        $idarray = [];
        $currentTag = [];
        $bookmarkcount=-1;

        if ($this->request->is('post'))
        {
            if ($this->request->getData())
            {
                $a = $this->request->getData('Title');
                $count = (int)$a;
            }
            for ($i=0;$i<$count;$i++)
            {
                $a = $this->request->getData('Title'.$i);
                array_push($currentTag,$a);
            }
            foreach ($bookmarks as $bookmark){
                $checktag = [];
                foreach($bookmark->tags as $tag)
                    array_push($checktag,$tag->title);
                if ($this->Bookmarks->checkContainOfTwoArrays($checktag,$currentTag))
                    array_push($idarray,$bookmark->id);
            }
    
            if (!empty($idarray))
            {
                $bookmarks = $bookmarktable->find('all',array('contain'=>array('Tags','Bookmarkdetails','Users')))->where(['Bookmarks.id IN'=>$idarray]);
                $bookmarkcount = $bookmarks->count();
                $this->Flash->success(__('Search completed. '.$bookmarkcount.' bookmark(s) are found'));
            }
            else 
            {
                $bookmarks =null;
                $bookmarkcount =0;
                $this->Flash->success(__('Search completed but nothing is found'));
            }
        }

        $this->set(['bookmarks'=>$bookmarks,'tags'=>$tags,'bookmarkcount'=>$bookmarkcount]);
    }

    public function randomdisplay()
    {
        $startingpoint = $this->request->param('pass')[0];
        $limit = $this->request->param('pass')[1];
        $bookmarktable = TableRegistry::get('Bookmarks');
        $bookmarks = $bookmarktable->find('all',array('limit'=>$limit))->order(['id'=>'ASC'])->where('id>'.$startingpoint);
        $this->set(compact('bookmarks','startingpoint','limit'));
    }
}
