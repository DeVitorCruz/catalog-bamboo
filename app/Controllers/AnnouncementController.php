<?php

namespace App\Controllers;

use App\Models\AnnouncementModel;
use Codeigniter\Controller;

class AnnouncementController extends BaseController
{
    protected $announcementModel;

    public function __construct()
    {
        $this->announcementModel = new AnnouncementModel();
    }

    protected $validationRules = [
        'message' => 'required|min_length[3]|max_length[255]',
        'ACTIVE' => 'integer'
    ];

    /**
     * @param $data, array with the request data extracted
     * 
     * @return array
     */
    protected function sanitizeInputAnnounce($data)
    {
        return [
            'message' => ucwords(strtolower(trim($data['message']))),
            'ACTIVE' => (int)$data['ACTIVE']
        ];
    }

    /**
     * Take all the post value and turn it into an array
     * 
     * @return array
     */
    public function extractAnnounceInfo()
    {
        $announce = [
            'message' => $this->request->getPost('message'),
            'ACTIVE' => $this->request->getPost('ACTIVE')
        ];

        return $announce;
    }

    /**
     * Create and store new anounce to the table
     * 
     * @return string
     */
    public function create()
    {

        $announce_extracted = $this->extractAnnounceInfo();

        if ($this->request->getMethod() === 'POST' && $this->validate($this->validationRules)) {
            return $this->response->setJSON(['status' => 'error', 'errors' => $this->validator->getErrors()]);
        }

        $sanitized_announce = $this->sanitizeInputAnnounce($announce_extracted);

        if ($this->announcementModel->saveAnnouncement($sanitized_announce)) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'success']);
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Failed to save announcement']);
        }

        return redirect()->to('announcements/index');
    }

    /**
     * Take the value from the stored and convert into a json
     * 
     * @return string
     */
    public function getAnnouncements()
    {
        $announcements = $this->announcementModel->findAnnouncements();

        return $this->response->setJSON(['data' => $announcements]);
    }


    /**
     * Edit and update the record announce value stored
     * 
     * @param int $announcement_id, the id value of the recorded announce
     * 
     * @return string
     */
    public function edit($announcement_id)
    {
        if ($this->request->getMethod()  === 'POST') {

            $announce_extracted = $this->extractAnnounceInfo();

            if (!$this->validate($this->validationRules)) {
                return redirect()->back()->withInput('errors', $this->validator->getErrors());
            }

            $sanitized_announce = $this->sanitizeInputAnnounce($announce_extracted);

            $this->announcementModel->updateAnnouncement($announcement_id, $sanitized_announce);

            return $this->response->setJSON(['status' => 'success']);
        }

        $announce = $this->announcementModel->editAnnouncement($announcement_id);

        return $this->response->setJSON(['data' => $announce]);
    }

    /**
     * Delete the a recorded announce selected
     * 
     * @param int $announcement_id, the id value of that match with the announce recorded
     * 
     * @return string
     */
    public function delete($announcement_id)
    {
        if ($this->announcementModel->deleteAnnouncement($announcement_id)) {
            return $this->response->setJSON(['status' => 'success']);
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Failed to delete announcement']);
        }
    }
}
