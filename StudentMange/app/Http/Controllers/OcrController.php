<?php

namespace App\Http\Controllers;
use thiagoalessio\TesseractOCR\TesseractOCR;

use Illuminate\Http\Request;
use Alimranahmed\LaraOCR\Facades\OCR;

class OcrController extends Controller
{
    public function ocrImage()
    {
        $imagePath = public_path('student_image/joy-76468406.PNG');
        $tesseract = new TesseractOCR($imagePath);
        $tesseract->lang('eng');
        $text = $tesseract->run();
        
        echo $text;
        
    }
}