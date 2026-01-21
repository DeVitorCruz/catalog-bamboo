<?php

namespace App\models;

use CodeIgniter\Model;


class BannerModel extends Model
{

    protected $table = 'banners';
    protected $primaryKey = 'banner_id';
    protected $allowedFields = ['title', 'image_url', 'link_url', 'ACTIVE'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    /**
     * Fetches all results from the banners tables.
     * 
     * @return array
     */
    public function searchAllBanners()
    {
        return $this->findAll();
    }

    /**
     * Try to save or update the data to the table
     * 
     * @param array $data, array with the data extracted
     * 
     * @return boolean
     */
    public function saveBanner($data)
    {
        return $this->save($data);
    }

    /**
     * Fetch all the record value that match the $banner_id
     * 
     * @param int $banner_id, banner id value
     * 
     * @return array
     */
    public function editBanner($banner_id)
    {
        return $this->find($banner_id);
    }

    /**
     * Update the value of the banner
     * 
     * @param int $banner_id, the value of the id of the banner
     * @param array $data, array with the value extracted from the edit page
     *
     * @return boolean 
     */
    public function updateBanner($banner_id, $data)
    {
        return $this->update($banner_id, $data);
    }

    /**
     * Delete the value of the banner that matches with $banner_id
     * 
     * @param int $banner_id, the id of the banner to be deleted
     * 
     * @return boolean
     */
    public function deleteBanner($banner_id)
    {
        return $this->delete($banner_id);
    }
}
