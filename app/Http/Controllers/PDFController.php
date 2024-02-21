<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use  Dompdf\Dompdf;
use Illuminate\Support\Facades\View;

class PDFController extends Controller
{
    public function generatePDF($id)
    {
        $invoice = Invoice::find($id);
        $pdf = new Dompdf();
        $html = view('invoices.pdf', ["invoice"=>$invoice])->render();
        $pdf->loadHtml($html);
        $pdf->render();
        return $pdf->stream($invoice->project->business->name.'_invoice.pdf');
    }
}
