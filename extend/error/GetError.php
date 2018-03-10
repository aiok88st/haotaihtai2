<?php
namespace error;
use Exception;
use think\exception\Handle;
use think\exception\HttpException;
class GetError extends Handle
{

    public function render(Exception $e)
    {
        if ($e instanceof HttpException) {
            $statusCode = $e->getStatusCode();
        }

        include 'public/404/404.html';
    }

}
?>