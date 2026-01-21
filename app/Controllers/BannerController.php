<?php

namespace App\Controllers;

use App\Models\BannerModel;
use CodeIgniter\Contrsoller;

class BannerController extends BaseController
{
    protected $bannerModel;

    public function __construct()
    {
        $this->bannerModel = new BannerModel();
    }

    protected $validationRules = [
        'title' => 'required|min_length[3]|max_length[255]',
        'image_url' => 'required|valid_url',
        'link_url' => 'permit_empty|valid_url',
        'ACTIVE' => 'integer'
    ];

    /**
     * @param $data, array with the request data extracted
     * 
     * @return array
     */
    protected function sanitizeInputBanner($data)
    {
        return [
            'title' => ucwords(strtolower(trim($data['title']))),
            'image_url' => filter_var($data['image_url'], FILTER_SANITIZE_URL),
            'link_url' => filter_var($data['link_url'], FILTER_SANITIZE_URL),
            'ACTIVE' => (int)$data['ACTIVE'],
        ];
    }

    /**
     * Take all the post value and turn it into an array
     * 
     * @return array
     */
    public function extractBannerInfo()
    {
        $banner = [
            'title' => $this->request->getPost('title'),
            'image_url' => $this->request->getPost('image_url'),
            'link_url' => $this->request->getPost('link_url'),
            'ACTIVE' => $this->request->getPost('ACTIVE')
        ];

        return $banner;
    }

    /**
     * Return all the banners items to the index
     * 
     * @return array
     */
    public function getAllBanners()
    {
        $banners = $this->bannerModel->searchAllBanners();

        return $this->response->setJSON(['data' => $banners]);
    }

    /**
     * Open the create banner page or save a new banner
     * 
     * @return boolean
     */
    public function create()
    {

        $banner = $this->extractBannerInfo();

        if (!$this->validate($this->validationRules)) {
            return $this->response->setJSON([
                'status' => 'error',
                'errors' => $this->validator->getErrors()
            ]);
        }

        $sanitized_banner = $this->sanitizeInputBanner($banner);

        $this->bannerModel->saveBanner($sanitized_banner);

        return $this->response->setJSON(['status' => 'success']);
    }

    /**
     * Show and update the edit page
     * 
     * @param int $banner_id, id of the banner to be edited
     * 
     * @return string
     */
    public function edit($banner_id = null)
    {

        if ($this->request->getMethod() === 'POST') {

            $banner = $this->extractBannerInfo();

            if (!$this->validate($this->validationRules)) {
                return $this->response->setJSON([
                    'status' => 'error',
                    'errors' => $this->validator->getErrors()
                ]);
            }

            $sanitized_banner = $this->sanitizeInputBanner($banner);

            $this->bannerModel->updateBanner($banner_id, $sanitized_banner);

            return $this->response->setJSON(['status' => 'success']);
        }

        $banner = $this->bannerModel->editBanner($banner_id);

        return $this->response->setJSON(['data' => $banner]);
    }

    /**
     * Delete the banner value that match witht $banner_id
     * 
     * @param int $banner_id, the value of the id of the banner
     * 
     * @return string
     */
    public function delete($banner_id)
    {
        $this->bannerModel->deleteBanner($banner_id);

        return redirect()->to('banner/index');
    }
}
