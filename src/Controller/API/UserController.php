<?php
class UserController extends BaseController
{
    /** 
     * "/document/list" Endpoint - Get list of documents 
     */
    public function listAction()
    {
        $strErrorDesc = "";

        $requestMethod = $_SERVER["REQUEST_METHOD"];
        $arrQueryStringParams = $this->getQueryStringParams();
        
        if (strtoupper($requestMethod) == "GET") {
            try {
                $userModel = new UserModel();
                
                $intLimit = 10;
                if (isset($arrQueryStringParams["limit"]) && $arrQueryStringParams["limit"]) {
                    $intLimit = $arrQueryStringParams["limit"];
                }

                $strType = isset($arrQueryStringParams["type"]) ? $arrQueryStringParams["type"] : null;
                $strFormat = isset($arrQueryStringParams["format"]) ? $arrQueryStringParams["format"] : null;
                
                $arrUsers = $userModel->getDocuments($intLimit, $strType, $strFormat);
                $responseData = json_encode($arrUsers);
            } catch (Error $e) {
                $strErrorDesc = $e->getMessage() . "Something went wrong! Please contact support.";
                $strErrorHeader = "HTTP/1.1 500 Internal Server Error";
            }
        } else {
            $strErrorDesc = "Method not supported";
            $strErrorHeader = "HTTP/1.1 422 Unprocessable Entity";
        }
        
        if (!$strErrorDesc) {
            $this->sendOutput(
                $responseData,
                array("Content-Type: application/json","'HTTP/1.1 200 OK")
            );
        } else {
            $this->sendOutput(
                json_encode(array("error" => $strErrorDesc)),
                array("Content-Type: application/json", $strErrorHeader)
            );
        }
    }

    /** 
     * "/document/get" Endpoint - Get document by ID 
     */
    public function getAction()
    {
        $strErrorDesc = "";

        $requestMethod = $_SERVER["REQUEST_METHOD"];
        $arrQueryStringParams = $this->getQueryStringParams();
        
        if (strtoupper($requestMethod) == "GET") {
            try {
                $userModel = new UserModel();
                
                if (!isset($arrQueryStringParams["documentId"]) || !$arrQueryStringParams["documentId"]) {
                    throw new Exception("documentId is required");
                }
                
                $intDocumentId = $arrQueryStringParams["documentId"];

                $arrDocument = $userModel->getDocument($intDocumentId);
                $responseData = json_encode($arrDocument);
            } catch (Error $e) {
                $strErrorDesc = $e->getMessage() . "Something went wrong! Please contact support.";
                $strErrorHeader = "HTTP/1.1 500 Internal Server Error";
            }
        } else {
            $strErrorDesc = "Method not supported";
            $strErrorHeader = "HTTP/1.1 422 Unprocessable Entity";
        }
        
        if (!$strErrorDesc) {
            $this->sendOutput(
                $responseData,
                array("Content-Type: application/json","'HTTP/1.1 200 OK")
            );
        } else {
            $this->sendOutput(
                json_encode(array("error" => $strErrorDesc)),
                array("Content-Type: application/json", $strErrorHeader)
            );
        }
    }

    /** 
     * "/document/add" Endpoint - Add a document 
     */
    public function addAction()
    {
        $strErrorDesc = "";

        $requestMethod = $_SERVER["REQUEST_METHOD"];
        
        if (strtoupper($requestMethod) == "POST") {
            try {
                $userModel = new UserModel();                
                $objDocument = $this->getRequestBody("document");
                
                $userModel->addDocument($objDocument);
                $responseData = json_encode(array("message" => "Document added successfully"));
            } catch (Error $e) {
                $strErrorDesc = $e->getMessage() . "Something went wrong! Please contact support.";
                $strErrorHeader = "HTTP/1.1 500 Internal Server Error";
            }
        } else {
            $strErrorDesc = "Method not supported";
            $strErrorHeader = "HTTP/1.1 422 Unprocessable Entity";
        }
        
        if (!$strErrorDesc) {
            $this->sendOutput(
                $responseData,
                array("Content-Type: application/json","'HTTP/1.1 200 OK")
            );
        } else {
            $this->sendOutput(
                json_encode(array("error" => $strErrorDesc)),
                array("Content-Type: application/json", $strErrorHeader)
            );
        }
    }

    /** 
     * "/document/update" Endpoint - Update a document 
     */
    public function updateAction()
    {
        $strErrorDesc = "";

        $requestMethod = $_SERVER["REQUEST_METHOD"];
        $arrQueryStringParams = $this->getQueryStringParams();
        
        if (strtoupper($requestMethod) == "PUT") {
            try {
                $userModel = new UserModel();                
                $objDocument = $this->getRequestBody("document");

                if (!isset($arrQueryStringParams["documentId"]) || !$arrQueryStringParams["documentId"]) {
                    throw new Exception("documentId is required");
                }

                $intDocumentId = $arrQueryStringParams["documentId"];

                $userModel->updateDocument($intDocumentId, $objDocument);
                $responseData = json_encode(array("message" => "Document updated successfully"));
            } catch (Error $e) {
                $strErrorDesc = $e->getMessage() . "Something went wrong! Please contact support.";
                $strErrorHeader = "HTTP/1.1 500 Internal Server Error";
            }
        } else {
            $strErrorDesc = "Method not supported";
            $strErrorHeader = "HTTP/1.1 422 Unprocessable Entity";
        }
        
        if (!$strErrorDesc) {
            $this->sendOutput(
                $responseData,
                array("Content-Type: application/json","'HTTP/1.1 200 OK")
            );
        } else {
            $this->sendOutput(
                json_encode(array("error" => $strErrorDesc)),
                array("Content-Type: application/json", $strErrorHeader)
            );
        }
    }

    /** 
     * "/document/delete" Endpoint - Delete a document 
     */
    public function deleteAction()
    {
        $strErrorDesc = "";

        $requestMethod = $_SERVER["REQUEST_METHOD"];
        $arrQueryStringParams = $this->getQueryStringParams();
        
        if (strtoupper($requestMethod) == "DELETE") {
            try {
                $userModel = new UserModel();
                
                if (!isset($arrQueryStringParams["documentId"]) || !$arrQueryStringParams["documentId"]) {
                    throw new Exception("documentId is required");
                }
                
                $intDocumentId = $arrQueryStringParams["documentId"];

                $userModel->deleteDocument($intDocumentId);
                $responseData = json_encode(array("message" => "Document deleted successfully"));
            } catch (Error $e) {
                $strErrorDesc = $e->getMessage() . "Something went wrong! Please contact support.";
                $strErrorHeader = "HTTP/1.1 500 Internal Server Error";
            }
        } else {
            $strErrorDesc = "Method not supported";
            $strErrorHeader = "HTTP/1.1 422 Unprocessable Entity";
        }
        
        if (!$strErrorDesc) {
            $this->sendOutput(
                $responseData,
                array("Content-Type: application/json","'HTTP/1.1 200 OK")
            );
        } else {
            $this->sendOutput(
                json_encode(array("error" => $strErrorDesc)),
                array("Content-Type: application/json", $strErrorHeader)
            );
        }
    }
}
