<?php

namespace App\Interface;

interface UploadFile
{
    public function uploadFile(array &$errors): string;
}
