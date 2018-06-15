<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Bookmarkdetails Controller
 *
 * @property \App\Model\Table\BookmarkdetailsTable $Bookmarkdetails
 *
 * @method \App\Model\Entity\Bookmarkdetail[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class BookmarkdetailsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Bookmarks']
        ];
        $bookmarkdetails = $this->paginate($this->Bookmarkdetails);

        $this->set(compact('bookmarkdetails'));
    }

    /**
     * View method
     *
     * @param string|null $id Bookmarkdetail id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $bookmarkdetail = $this->Bookmarkdetails->get($id, [
            'contain' => ['Bookmarks']
        ]);

        $this->set('bookmarkdetail', $bookmarkdetail);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $bookmarkdetail = $this->Bookmarkdetails->newEntity();
        if ($this->request->is('post')) {
            $bookmarkdetail = $this->Bookmarkdetails->patchEntity($bookmarkdetail, $this->request->getData());
            if ($this->Bookmarkdetails->save($bookmarkdetail)) {
                $this->Flash->success(__('The bookmarkdetail has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The bookmarkdetail could not be saved. Please, try again.'));
        }
        $bookmarks = $this->Bookmarkdetails->Bookmarks->find('list', ['limit' => 200]);
        $this->set(compact('bookmarkdetail', 'bookmarks'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Bookmarkdetail id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $bookmarkdetail = $this->Bookmarkdetails->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $bookmarkdetail = $this->Bookmarkdetails->patchEntity($bookmarkdetail, $this->request->getData());
            if ($this->Bookmarkdetails->save($bookmarkdetail)) {
                $this->Flash->success(__('The bookmarkdetail has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The bookmarkdetail could not be saved. Please, try again.'));
        }
        $bookmarks = $this->Bookmarkdetails->Bookmarks->find('list', ['limit' => 200]);
        $this->set(compact('bookmarkdetail', 'bookmarks'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Bookmarkdetail id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $bookmarkdetail = $this->Bookmarkdetails->get($id);
        if ($this->Bookmarkdetails->delete($bookmarkdetail)) {
            $this->Flash->success(__('The bookmarkdetail has been deleted.'));
        } else {
            $this->Flash->error(__('The bookmarkdetail could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
