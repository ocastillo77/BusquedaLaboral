<?php

class FileUploader
{
    private $uploadDirectory;
    private $allowedTypes;
    private $fileType;
    private $uploadedFile;

    public function __construct($fileType, $allowedTypes = [])
    {
        $this->uploadDirectory = __DIR__ . '/uploads/';
        $this->allowedTypes = $allowedTypes;
        $this->fileType = $fileType;
    }

    public function upload($file)
    {
        $this->uploadedFile = $file;

        if (!$this->isValidFileType()) {
            return $this->jsonResponse('error', 'Tipo de archivo no permitido.');
        }
        if (!$this->isValidExtension()) {
            return $this->jsonResponse('error', 'Extensión de archivo no permitida.');
        }

        $filePath = $this->moveFile();
        if ($filePath) {
            return $this->jsonResponse('success', 'Archivo subido exitosamente', ['filename' => $filePath]);
        } else {
            return $this->jsonResponse('error', 'Error al subir el archivo.');
        }
    }

    private function isValidFileType()
    {
        return isset($this->allowedTypes[$this->fileType]);
    }

    private function isValidExtension()
    {
        $fileExtension = strtolower(pathinfo($this->uploadedFile['name'], PATHINFO_EXTENSION));
        return in_array($fileExtension, $this->allowedTypes[$this->fileType]);
    }

    private function moveFile()
    {
        $uploadPath = $this->uploadDirectory . $this->fileType . '/';
        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0777, true);
        }

        $fileExtension = pathinfo($this->uploadedFile['name'], PATHINFO_EXTENSION);
        $filename = uniqid() . '.' . $fileExtension;

        if (move_uploaded_file($this->uploadedFile['tmp_name'], $uploadPath . $filename)) {
            return $filename;
        }

        return false;
    }

    private function jsonResponse($status, $message, $data = [])
    {
        return json_encode(array_merge(['status' => $status, 'message' => $message], $data));
    }
}

$allowedTypes = [
    'penales' => ['pdf', 'jpg', 'png'],
    'cv' => ['pdf', 'doc', 'docx'],
    'certificado' => ['pdf', 'jpg']
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fileType = $_POST['file_type'] ?? '';
    $fileUploader = new FileUploader($fileType, $allowedTypes);

    if (isset($_FILES['userfile'])) {
        echo $fileUploader->upload($_FILES['userfile']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'No se encontró el archivo.']);
    }
}
