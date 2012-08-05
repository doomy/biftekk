<?php
class FileUploader {
# version 1
    
    public function upload($path, $file) {
            $upload_path = $path . $file["name"];
            if (file_exists($upload_path)) {
                $upload_path = $this->_make_upload_path_unique($upload_path);
            }
            move_uploaded_file($file['tmp_name'], $upload_path);
    }

    private function _make_upload_path_unique($upload_path) {
        $parts = explode('.', $upload_path);
        $element_count = count($parts);
        $parts[$element_count - 2] .= '-' . uniqid();
        return implode('.', $parts);
    }
}
?>
