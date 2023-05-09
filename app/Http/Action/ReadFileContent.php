<?php

namespace App\Http\Action;

class ReadFileContent
{
    public function __invoke($file): Object
    {
        $readFileContent = json_decode(file_get_contents($file));
        return $readFileContent;
    }
}
