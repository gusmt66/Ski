<?php    
    // app/Controller/ProductsController.php
	
	    App::uses('Folder', 'Utility');
        App::uses('File', 'Utility');
		
    class ProductsController extends AppController {

	    public function beforeFilter() {
            parent::beforeFilter();
            $this->loadModel("User");
            $this->loadModel("Category");
        }

        public function isAuthorized($user) {
            if ($user["role"] == "admin") {
                return true;
            }
            return false;
        }

        public function index() {

            if (isset($this->request->data['searcher'])){
                $searcher = $this->request->data['searcher'];

                $conditions = array(
                    'OR'=>array(
                        'Product.name LIKE'=>'%'.$searcher.'%',
                        'Category.name LIKE'=>'%'.$searcher.'%',
                        'Product.code LIKE'=>'%'.$searcher.'%',
                        )
                    );
            }else{
               $conditions = array();
            }


            $this->set('products', $this->paginate('Product',$conditions));
        }


        public function add() {

            $this->set('category', $this->Category->find('list', array('order'=>'Category.name ASC')));

            if ($this->request->is('post')) {

                //Encontrar el nombre de la carpeta de la categoria escogida en la vista
                $categ = $this->Category->find('first', array('conditions'=>array('Category.id'=>$this->request->data['Product']['category_id'])));

                /*Save file*/

                $dir2 = WWW_ROOT.DS."/../../../images/catalog/" . $categ['Category']['folder'];
                $filename = null;

                if (!empty($this->request->data['Product']['filename']['tmp_name']) && is_uploaded_file($this->request->data['Product']['filename']['tmp_name'])) {
                    // Strip path information
                    $date = new DateTime();
                    $ext = pathinfo($this->request->data['Product']['filename']['name']);

                    $data_aux = $this->request->data;
                    $data_aux['Product']['filename'] = $this->request->data['Product']['filename']['name'];
                    
                    if ($this->Product->validates($data_aux)){

                        $filename = $date->getTimestamp().$this->request->data['Product']['filename']['size'].'.'.$ext['extension'];

                        if(file_exists($dir2) && is_dir($dir2))
                        {
                            move_uploaded_file($this->data['Product']['filename']['tmp_name'],$dir2.'/'.$filename);
                               
                        }
                        elseif(mkdir($dir2,0777))
                        {
                            move_uploaded_file($this->data['Product']['filename']['tmp_name'],$dir2.'/'.$filename);                         
                        }
                        $this->request->data['Product']['filename'] = $filename;
                    }
                }else{
                    $this->request->data['Product']['filename'] = '';
                }
                    

                if ($this->Product->save($this->request->data)) {
                    $this->Session->setFlash('El producto ha sido creado exitosamente', 'default', array('class'=>'alert alert-info'));
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('El producto no pudo ser creado', 'default', array('class'=>'alert alert-error'));
                }
            }
        }

        public function view($id = null) {
            $this->Product->id = $id;
            if (!$this->Product->exists()) {
                throw new NotFoundException(__('Producto Invalido'));
            }
            
            //$this->Product->recursive = 2;

            $product = $this->Product->read(null, $id);
            $this->set('product', $product);

            $this->set('folder', WWW_ROOT.DS."/../../../images/catalog/" . $product['Category']['folder']);

            
        }

        public function edit($id = null) {

            if (!$id) {
                throw new NotFoundException(__('Producto invalido'));
            }

            $product = $this->Product->findById($id);
            if (!$product) {
                throw new NotFoundException(__('Producto invalido'));
            }

            $catalog_dir = WWW_ROOT.DS."/../../../images/catalog/";
            $folder = $catalog_dir . $product['Category']['folder'];

            $this->set('category', $this->Category->find('list', array('order'=>'Category.name ASC')));
            $this->set('folder', $folder);
            $this->set('product',$product);

            if ($this->request->is(array('post', 'put'))) {
                $this->Product->id = $id;


                    $new_category = $this->Category->findById($this->request->data['Product']['category_id']);

                    $folder_new = $catalog_dir . $new_category['Category']['folder'] ;


                    if (!empty($this->request->data['Product']['filename']['tmp_name']) && is_uploaded_file($this->request->data['Product']['filename']['tmp_name'])) {
                        // Strip path information
                        $date = new DateTime();
                        $ext = pathinfo($this->request->data['Product']['filename']['name']);

                        $data_aux = $this->request->data;
                        $data_aux['Product']['filename'] = $this->request->data['Product']['filename']['name'];
                        
                        if ($this->Product->validates($data_aux)){

                            $filename = $date->getTimestamp().$this->request->data['Product']['filename']['size'].'.'.$ext['extension'];

                            if(file_exists($folder_new) && is_dir($folder_new))
                            {
                                move_uploaded_file($this->data['Product']['filename']['tmp_name'],$folder_new.'/'.$filename);
                                   
                            }
                            elseif(mkdir($folder_new,0777))
                            {
                                move_uploaded_file($this->data['Product']['filename']['tmp_name'],$folder_new.'/'.$filename);                         
                            }
                            $this->request->data['Product']['filename'] = $filename;


                            $fullpath = $folder . "/" . $product['Product']['filename'];
                            unlink($fullpath);

                        }

                    }else{
                        
                        $this->request->data['Product']['filename'] = $product['Product']['filename'];


                        if ($folder != $folder_new){

                            $full_old_path = $folder . "/" . $product['Product']['filename'];
                            
                            if (!(file_exists($folder_new) && is_dir($folder_new))) {
                                mkdir($folder_new,0777);
                            }

                            copy($full_old_path, $folder_new . "/" . $product['Product']['filename']);

                            unlink($full_old_path);

                        }

                    }

                if ($this->Product->save($this->request->data)) {
                    $this->Session->setFlash(__('El producto ha sido actualizado.'));
                    return $this->redirect(array('action' => 'index'));
                }
                $this->Session->setFlash(__('No se pudo actualizar el producto.'));
            }

            if (!$this->request->data) {
                $this->request->data = $product;
            }
        }
		
		
		public function delete($id = null) {
		
		    if (!$this->request->is('post')) {
                throw new MethodNotAllowedException();
            }
			
            $this->Product->id = $id;

            if (!$id) { return $this->redirect(array('action' => 'index')); }
            if (!$this->Product->exists()) {  return $this->redirect(array('action' => 'index')); }

            $product = $this->Product->find('first',array('conditions'=>array('Product.id'=>$id)));
			
			$category = $this->Category->find('first',array('conditions'=>array('Category.id'=>$product['Product']['category_id'])));
			
            $category_name = strtolower($category['Category']['name']);
			
			$folder = '../../../images/catalog/' . $category_name . '/';		
			
            $this->removeFile($product['Product']['filename'],$folder);
            
            if ($this->Product->delete()) {
                $this->Session->setFlash('El Producto ha sido eliminado', 'default', array('class'=>'alert alert-info'));
                $this->redirect(array('action' => 'index'));
            
            }else{

                $this->Session->setFlash('El Producto no pudo ser eliminado', 'default', array('class'=>'alert alert-error'));
				$this->redirect(array('action' => 'index'));
            }
        }

		

       /* public function delete($id = null) {

            if (!$this->request->is('post')) {
                throw new MethodNotAllowedException();
            }
            $this->Product->id = $id;
			
            if (!$this->Product->exists()) {
                throw new NotFoundException(__('Producto Invalido'));
            }
            $product = $this->Product->find('first',array('conditions'=>array('Product.id'=>$id)));
            $prueba = $this->Product->findById($id);

            //if ($this->Product->delete()) {

                $fullpath = WWW_ROOT."/../../../images/catalog/" . $product['Product']['filename'];

				debug($fullpath);
				
                $folder = new Folder($fullpath);
                
				debug($folder);
				
				exit;
				
                chmod($fullpath, 0777);
                unlink($fullpath); 

                $this->Session->setFlash('El Producto ha sido eliminado', 'default', array('class'=>'alert alert-info'));
                $this->redirect(array('action' => 'index'));
            //}
			
            $this->Session->setFlash('El Producto no pudo ser eliminado', 'default', array('class'=>'alert alert-error'));
            $this->redirect(array('action' => 'index'));
        }*/

        
}
?>
