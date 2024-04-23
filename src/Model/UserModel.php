<?php
require_once PROJECT_ROOT_PATH . "/src/Model/Database.php";

class UserModel extends Database
{
    public function getDocuments($limit, $type = null, $format = null)
    {
        $query = "SELECT * FROM document WHERE 1 = 1";
        $params = [];
        
        if ($type) {
            $query .= " AND type = ?";
            $params[] = $type;
        }
        
        if ($format) {
            $query .= " AND format = ?";
            $params[] = $format;
        }
        
        $query .= " ORDER BY documentId ASC LIMIT ?";
        $params[] = $limit;
        
        return $this->executeSelect($query, $params);
    }

    public function getDocument($documentId)
    {
        return $this->executeSelect("SELECT * FROM document WHERE documentId = ?", [$documentId]);
    }

    public function addDocument($document)
    {
        return $this->executeInsert("INSERT INTO document (documentId, author, title, description, numPages, size, type, format) VALUES (?, ?, ?, ?, ?, ?, ?, ?)", [$document->documentId, $document->author, $document->title, $document->description, $document->numPages, $document->size, $document->type, $document->format]);
    }

    public function updateDocument($documentId, $document)
    {
        return $this->executeUpdate("UPDATE document SET author = ?, title = ?, description = ?, numPages = ?, size = ?, type = ?, format = ? WHERE documentId = ?", [$document->author, $document->title, $document->description, $document->numPages, $document->size, $document->type, $document->format, $documentId]);
    }

    public function deleteDocument($documentId)
    {
        return $this->executeDelete("DELETE FROM document WHERE documentId = ?", [$documentId]);
    }
}
?>
