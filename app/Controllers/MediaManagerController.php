<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MediaFileModel;

class MediaManagerController extends BaseController
{
    protected $mediaFileModel;

    public function __construct()
    {
        $this->mediaFileModel = new MediaFileModel();
    }

    // List media files
    public function index()
    {
        $title = 'Media Manager';
        $page_title = 'Manage Media Files';
        $menu = 'cms';

        return view('backend/cms/media_manager/index', compact('title', 'page_title', 'menu'));
    }

    // Fetch media files for gallery
    public function getMediaFiles()
    {
        $mediaFiles = $this->mediaFileModel->orderBy('id', 'DESC')->findAll();

        $data = array_map(function ($file) {
            return [
                'id' => $file['id'],
                'file_name' => $file['file_name'],
                'file_type' => $file['file_type'],
                'file_size' => round($file['file_size'] / 1024, 2) . ' KB',
                'file_path' => $file['file_path'],
            ];
        }, $mediaFiles);

        return $this->response->setJSON(['data' => $data]);
    }

    public function upload()
    {
        log_message('info', 'Upload process started.');

        $file = $this->request->getFile('file');

        // Check if file exists
        if (!$file) {
            log_message('error', 'No file received.');
            return $this->response->setJSON(['status' => 'error', 'message' => 'No file uploaded.']);
        }

        // Validate the file
        if (!$file->isValid()) {
            log_message('error', 'Invalid file: ' . $file->getErrorString());
            return $this->response->setJSON(['status' => 'error', 'message' => $file->getErrorString()]);
        }

        // Retrieve the MIME type before moving the file
        $fileMimeType = $file->getMimeType();
        log_message('info', 'Detected MIME type: ' . $fileMimeType);

        $filePath = 'uploads/media/';
        $fileName = $file->getRandomName();

        // Ensure the directory exists
        if (!is_dir($filePath)) {
            mkdir($filePath, 0777, true);
            log_message('info', 'Created directory: ' . $filePath);
        }

        // Move the file
        if ($file->move($filePath, $fileName)) {
            log_message('info', 'File moved successfully to: ' . $filePath . $fileName);

            // Prepare data for database insertion
            $data = [
                'file_name' => $file->getClientName(),
                'file_path' => $filePath . $fileName,
                'file_type' => $fileMimeType, // Use fetched MIME type
                'file_size' => $file->getSize(),
                'uploaded_at' => date('Y-m-d H:i:s'),
            ];

            log_message('info', 'Data prepared for insertion: ' . json_encode($data));

            // Insert data into the database
            try {
                if ($this->mediaFileModel->insert($data)) {
                    log_message('info', 'Database insertion successful.');
                    return $this->response->setJSON([
                        'status' => 'success',
                        'message' => 'File uploaded and record saved successfully.',
                    ]);
                } else {
                    log_message('error', 'Database insertion failed: ' . json_encode($this->mediaFileModel->errors()));
                    return $this->response->setJSON([
                        'status' => 'error',
                        'message' => 'Failed to save file information to the database.',
                    ]);
                }
            } catch (\Exception $e) {
                log_message('critical', 'Exception during database operation: ' . $e->getMessage());
                return $this->response->setJSON([
                    'status' => 'error',
                    'message' => 'A database error occurred.',
                ]);
            }
        } else {
            log_message('error', 'Failed to move the uploaded file.');
            return $this->response->setJSON(['status' => 'error', 'message' => 'Failed to move the uploaded file.']);
        }
    }





    // Delete media file
    public function delete($id)
    {
        $mediaFile = $this->mediaFileModel->find($id);

        if (!$mediaFile) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'File not found.']);
        }

        if (file_exists($mediaFile['file_path'])) {
            unlink($mediaFile['file_path']);
        }

        $this->mediaFileModel->delete($id);

        return $this->response->setJSON(['status' => 'success', 'message' => 'File deleted successfully.']);
    }

    public function testInsert()
    {
        $data = [
            'file_name' => 'test.jpg',
            'file_path' => 'uploads/media/test.jpg',
            'file_type' => 'image/jpeg',
            'file_size' => 12345,
            'uploaded_at' => date('Y-m-d H:i:s'),
        ];

        if ($this->mediaFileModel->insert($data)) {
            echo "Database insertion successful.";
        } else {
            echo "Database insertion failed: " . json_encode($this->mediaFileModel->errors());
        }
    }
}
