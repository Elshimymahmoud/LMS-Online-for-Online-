<?php

namespace App\Http\Controllers\Traits;

use ArPHP\I18N\Arabic;
use ConsoleTVs\Invoices\Classes\Invoice;
use ConsoleTVs\Invoices\Classes\PDF;
use Dompdf\Dompdf;
use Dompdf\Options;
use View;

class InvoicePDFGenerator extends PDF
{
    public static function generate(Invoice $invoice, $template = 'default')
    {
        $template = strtolower($template);

        $options = new Options();

        $options->set('isRemoteEnabled', true);
        $options->set('isPhpEnabled', true);

        $pdf = new Dompdf($options);

        $context = stream_context_create(['ssl' => ['verify_peer' => false, 'verify_peer_name' => false, 'allow_self_signed' => true,],]);

        $pdf->setHttpContext($context);

        $GLOBALS['with_pagination'] = $invoice->with_pagination;

        // Generate the HTML content
        $html = View::make('invoices::' . $template, ['invoice' => $invoice])->render();

        // Process the HTML content for Arabic text
        $arabic = new Arabic();
        $p = $arabic->arIdentify($html);

        for ($i = count($p) - 1; $i >= 0; $i -= 2) {
            $utf8ar = $arabic->utf8Glyphs(substr($html, $p[$i - 1], $p[$i] - $p[$i - 1]), 1000, true, true);
            $html = substr_replace($html, $utf8ar, $p[$i - 1], $p[$i] - $p[$i - 1]);
        }

        // Load the processed HTML into DOMPDF
        $pdf->loadHtml($html);
        $pdf->render();

        return $pdf;
    }
}