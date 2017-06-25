<?php

namespace Butterfly\Bundles\Icerik\Controllers;

use Butterfly\Bundles\Icerik\Models\BlogFactory;
use Butterfly\System\ActiveClass;
use Butterfly\System\Parameters;
use Butterfly\System\Request;
use Butterfly\System\Uploader;

class Blog extends ActiveClass
{
    /**
     * Blog constructor.
     */
    function __construct()
    {
        parent::__construct();
        $this->getLoader()->loadModel('\\Butterfly\\Bundles\\Icerik\\Models\\Blog');
    }

    /**
     * @param Parameters|null $parameters
     * @param Request|null $request
     */
    public function main(Parameters $parameters = null, Request $request = null) {
        $renderData = ['error' => []];

        $blogFactory = new BlogFactory();

        $renderData['blogs'] = $blogFactory->getAll([
            'author' => $this->getSessions()->get('id')->getValue()
        ]);

        echo $this->getTwig()->render('icerik/blog/main.twig', $renderData);
    }

    /**
     * @param Parameters|null $parameters
     * @param Request|null $request
     */
    public function ekle(Parameters $parameters = null, Request $request = null) {
        $renderData = ['error' => []];
        // If form submitted
        if ($request->isPost()) {
            // Create blog factory for handling blog CRUD events
            $blogFactory = new BlogFactory();
            // Uploader instance for upload file from form field key name
            $uploader = new Uploader('image');
            $result = $uploader
                ->setPath()     // set upload path (default)
                ->upload()      // do upload
                ->getResult();  // get uploading result
            // If upload process successed
            if ($result) {
                // Creaete blog instance for adding DB
                $blog = new \Butterfly\Bundles\Icerik\Models\Blog(json_decode(json_encode([
                    'id' => 0,
                    'title' => $request->getPostValue('title'),
                    'content' => $request->getPostValue('content'),
                    'image' => $uploader->getUrl(),
                    'tags' => $request->getPostValue('tags'),
                    'author' => $this->getSessions()->get('id')->getValue()
                ])));
                // If blog instance added to DB
                if ($blogFactory->set($blog)) {
                    // Goto /icerik/blog/bloglarim
                    $this->getPath()->redirect_route('/icerik/blog/bloglarim');
                } else {
                    // Push DB error to render data
                    $renderData['error'][] = 'Kayıt eklenemedi. Hata: ' . $this->getDatabase()->errorInfo();
                }
            } else {
                // Push upload error to render data
                $renderData['error'][] = 'Resim upload hatası.';
            }
        }
        // Render view
        echo $this->getTwig()->render('icerik/blog/ekle.twig', $renderData);
    }

    /**
     * @param Parameters $parameters
     * @param Request|null $request
     */
    public function sil(Parameters $parameters, Request $request = null) {
        // Create blog factory for handling blog events
        $blogFactory = new BlogFactory();
        // Get requested blog instance by id from parameters
        $blog = $blogFactory->get($parameters->getParameter('id'));
        // Prepare render data
        $renderData = ['error' => [], 'blog' => $blog];
        // Check If form submitted
        if ($request->isPost()) {
            // Get action type (delete|cancel) from form
            $action = $request->getPostValue('action');
            // If delete form submitted from delete button
            if ($action == 'delete') {
                // Remove requested blog instance from DB
                $blogFactory->remove($parameters->getParameter('id'));
            }
            // Goto /icerik/blog/bloglarim
            $this->getPath()->redirect_route('/icerik/blog/bloglarim');
        }
        // Render View
        echo $this->getTwig()->render('icerik/blog/sil.twig', $renderData);
    }

    /**
     * @param Parameters $parameters
     * @param Request|null $request
     */
    public function duzenle(Parameters $parameters, Request $request = null) {
        // Create blog factory for handling blog events
        $blogFactory = new BlogFactory();
        // Get requested blog instance from DB
        $blog = $blogFactory->get($parameters->getParameter('id'));
        // Prepare render data
        $renderData = ['error' => [], 'blog' => $blog];
        // If form submitted
        if ($request->isPost()) {
            // Create uploader instance
            $uploader = new Uploader('image');
            // If new image selected
            if (strlen($_FILES['image']['name']) > 0) {
                // Upload new image
                $result = $uploader
                    ->setPath()
                    ->upload()
                    ->getUrl(); // Commit uplaoder and get uplaoded file url
            } else {
                // If new image not selected get old image
                $result = $blog->getImage();
            }
            // Check for image
            if ($result) {
                // Set new blog title
                $blog->setTitle($request->getPostValue('title'));
                // Set new blog content
                $blog->setContent($request->getPostValue('content'));
                // Set new blog image
                $blog->setImage($result);
                // Set new blog tags
                $blog->setTags(explode(',', $request->getPostValue('tags')));
                // If new blog changes saved to DB
                if ($blogFactory->save($blog)) {
                    // Goto /icerik/blog/bloglarim
                    $this->getPath()->redirect_route('/icerik/blog/bloglarim');
                } else {
                    // Pass error to rendering data for errors
                    $renderData['error'][] = 'Kayıt düzenlenemedi. Hata: ' . $this->getDatabase()->errorInfo();
                }
            } else {
                // Pass error to rendering data for errors
                $renderData['error'][] = 'Resim upload hatası.';
            }
        }
        // Render view
        echo $this->getTwig()->render('icerik/blog/ekle.twig', $renderData);
    }

}