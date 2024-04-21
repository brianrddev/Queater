<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;


class QrCodeController extends Controller
{
    public function generateQrCode($url, $number)
    {
        // Generate the QR code
        $qr = QrCode::generate($url, storage_path('app/public/qrcodes_images/table_' . $number . '.svg'));
    }



    //TODO: Crear la función para descargar el archivo SVG en especifico.
    function downloadQrCode($number)
    {
        $filePath = 'qrcodes_images/table_' . $number . '.svg';

        // Verificar si el archivo existe
        if (Storage::disk('public')->exists($filePath)) {
            // Descargar el archivo SVG
            return Storage::disk('public')->download($filePath);
        } else {
            // Si el archivo no existe, redirigir o mostrar un mensaje de error
            return redirect()->back()->with('error', 'El archivo SVG no existe.');
        }

    }
}
