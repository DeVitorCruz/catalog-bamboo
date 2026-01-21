<?php

namespace App\Models;

use CodeIgniter\Model;

class AnnouncementModel extends Model
{
    protected $table = 'announcements';
    protected $primaryKey = 'announcement_id';
    protected $allowedFields = ['message', 'ACTIVE'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    /**
     * Fetch all the inserted announcement
     * 
     * @return array
     */
    public function findAnnouncements()
    {
        return $this->findAll();
    }

    /**
     * Insert or update the data in table
     * 
     * @param array $announce, array of announce extracted from the view
     * 
     * @return boolean
     */
    public function saveAnnouncement($announce)
    {
        return $this->save($announce);
    }

    /**
     * Fetch all the stored announce from the table
     * 
     * @param int $announcement_id, the id value that match with the stored announce
     * 
     * @return array
     */
    public function editAnnouncement($announcement_id)
    {
        return $this->find($announcement_id);
    }

    /**
     * Update a single announce recorded in the table
     * 
     * @param int $announcement_id, the id value that matches with the stored announce 
     * @param array $announce, the array with announce post value extracted
     * 
     * @return boolean
     */
    public function updateAnnouncement($announcement_id, $announce)
    {
        return $this->update($announcement_id, $announce);
    }

    /**
     * Delete a single announce recorded in the table
     * 
     * @param int $announcement_id, the id value that matches with the stored announce
     * 
     * @return boolean
     */
    public function deleteAnnouncement($announcement_id)
    {
        return $this->delete($announcement_id);
    }

    /**
     * Select all the activated announcement
     * 
     * @return array
     */
    public function getActiveAnnouncement()
    {
        return $this->where('ACTIVE', 1)->findAll();
    }
}
