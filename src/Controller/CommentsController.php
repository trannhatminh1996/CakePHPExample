<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;


/**
 * Comments Controller
 *
 * @property \App\Model\Table\CommentsTable $Comments
 *
 * @method \App\Model\Entity\Comment[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CommentsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Bookmarks', 'Users']
        ];
        $comments = $this->paginate($this->Comments);

        $this->set(compact('comments'));
    }

    /**
     * View method
     *
     * @param string|null $id Comment id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $comment = $this->Comments->get($id, [
            'contain' => ['Bookmarks', 'Users']
        ]);

        $this->set('comment', $comment);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $comment = $this->Comments->newEntity();
        if ($this->request->is('post')) {
            $comment->user_id = $this->Auth->user('id');
            $comment = $this->Comments->patchEntity($comment, $this->request->getData());
            if ($this->Comments->save($comment)) {
                $this->Flash->success(__('The comment has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The comment could not be saved. Please, try again.'));
        }
        $bookmarks = $this->Comments->Bookmarks->find('list', ['limit' => 200]);
        $users = $this->Comments->Users->find('list', ['limit' => 200]);
        $this->set(compact('comment', 'bookmarks', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Comment id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $comment = $this->Comments->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $comment = $this->Comments->patchEntity($comment, $this->request->getData());
            if ($this->Comments->save($comment)) {
                $this->Flash->success(__('The comment has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The comment could not be saved. Please, try again.'));
        }
        $bookmarks = $this->Comments->Bookmarks->find('list', ['limit' => 200]);
        $users = $this->Comments->Users->find('list', ['limit' => 200]);
        $this->set(compact('comment', 'bookmarks', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Comment id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $comment = $this->Comments->get($id);
        if ($this->Comments->delete($comment)) {
            $this->Flash->success(__('The comment has been deleted.'));
        } else {
            $this->Flash->error(__('The comment could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function commentonbookmark()
    {
        $params = $this->request->params['pass'];
        $bookmarktable = TableRegistry::get('Bookmarks');
        $bookmarks = $bookmarktable->find('all',array('contain'=>array('Tags','Bookmarkdetails','Users','Comments')))->where(['Bookmarks.id IN'=>$params]);
        $commenttable = tableRegistry::get('Comments');
        $comments = $commenttable->find('all',array('contain'=>array('Bookmarks')));
        if ($this->request->is('post'))
        {
            if ($this->request->getData())
            {
                $comment = $this->Comments->newEntity();
                $comment->user_id = $this->Auth->user('id');
                $comment->content = $this->request->getData('inputcomment');
                $comment->bookmark_id= $this->request->getData('bookmarkid');
                $comment->parentcomment = $this->request->getData('parentcomment');
                $this->Comments->save($comment);
                return $this->redirect($this->here);

            }
        }
        $this->set(compact('bookmarks','comments','comment'));
    }
    
}
