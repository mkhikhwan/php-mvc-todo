<?php

class HTTPException extends Exception{
    protected int $statusCode;

    public function getStatusCode(){
        return $this->statusCode;
    }
}

class ForbiddenException extends HTTPException{
    protected int $statusCode = 403;
}

class NotFoundException extends HTTPException{
    protected int $statusCode = 404;
}

?>