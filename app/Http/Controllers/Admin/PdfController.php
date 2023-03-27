<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\View;

class PdfController extends Controller
{
    public function index(Post $post){

        
        /* dd($post); */

        //per la decodifica dell'immagine
        $image_data = file_get_contents(public_path('storage/' . $post->cover));
        $image_base64 = base64_encode($image_data);
        
        
        $view = View::make('admin.pdf', compact('post', 'image_base64'));
        $html_content = $view->render();
        
        // Crea un nuovo oggetto Dompdf
        $pdf = new Dompdf();
        $pdf->loadHtml($html_content);

        
        
        // Renderizza il PDF
        $pdf->render();
        
        // Scarica il PDF
        return $pdf->stream($post->nome  . '_anime.pdf');
    }
}
