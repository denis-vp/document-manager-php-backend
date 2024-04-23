<?php
function validateDocument($document) {
    $errors = [];

    if (!$document) {
        $errors[] = "Document is required";
    }

    if (!$document->author) {
        $errors[] = "Document author is required";
    } else if ($document->author === "") {
        $errors[] = "Document author cannot be empty";
    }

    if (!$document->title) {
        $errors[] = "Document title is required";
    } else if ($document->title === "") {
        $errors[] = "Document title cannot be empty";
    }

    if (!$document->numPages) {
        $errors[] = "Document number of pages is required";
    } else if (!is_numeric($document->numPages)) {
        $errors[] = "Document number of pages must be a number";
    } else if ($document->numPages <= 0) {
        $errors[] = "Document number of pages must be greater than 0";
    }

    if (!$document->type) {
        $errors[] = "Document type is required";
    } else if ($document->type === "") {
        $errors[] = "Document type cannot be empty";
    } else if ($document->type[0] !== ".") {
        $errors[] = "Document type must start with a period (.)";
    }

    if (!$document->format) {
        $errors[] = "Document format is required";
    } else if ($document->format === "") {
        $errors[] = "Document format cannot be empty";
    }
    
    if (count($errors) > 0) {
        throw new Exception(implode(", ", $errors));
    }
}
?>