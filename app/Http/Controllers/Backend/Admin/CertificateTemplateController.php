<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use App\Models\CourseGroup;
use App\Models\Type;
use DOMDocument;
use DOMXPath;
use Google\Service\CertificateAuthorityService\CertificateTemplate;
use Illuminate\Http\Request;
use App\Models\CertificateTemplates;
use App\Models\Course;
use Illuminate\Support\Facades\Storage;
use Dompdf\Dompdf;
//use Barryvdh\DomPDF\Facade as PDF;
use PDF;
use ArPHP\I18N\Arabic;

class CertificateTemplateController extends Controller
{
    public function index()
    {
        return view('backend.certificates.templates.index');
    }

    public function getData(){
        $templates = CertificateTemplates::orderBy('created_at', 'desc')->get();
        return datatables()->of($templates)
            ->addIndexColumn()
            ->addColumn('title', function ($template) {
                return $template->title;
            })
            ->addColumn('actions', function ($template) {
                $editUrl = route('admin.certificates.templates.edit', ['id' => $template->id]);
                $edit = view('backend.datatable.action-edit')
                    ->with(['route' => $editUrl])
                    ->render();
                return $edit;
            })
            ->addColumn('type', function ($template) {
                return $template->types->name;
            })
            ->addColumn('status', function ($template) {
                return $template->status == 1 ? 'Active' : 'Inactive';
            })
            ->addColumn('bg_image', function ($template) {
                return '<img src="' . asset('storage/uploads/certificate_templates/' . $template->bg_image) . '" width="100px" height="100px">';
            })
            ->rawColumns(['actions', 'bg_image'])
            ->make(true);
    }

    public function create()
    {
        $courseTypes = Type::orderBy('created_at', 'desc')->where('status', 1)->pluck('name', 'id');
        return view('backend.certificates.templates.create', compact('courseTypes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'title_ar' => 'required',
            'template_content' => 'required',
            'course_type' => 'required',
        ]);


        $certificateTemplate = new CertificateTemplates();
        $certificateTemplate->title = $request->title;
        $certificateTemplate->title_ar = $request->title_ar;
        $content = $request->template_content;
        $certificateTemplate->content = $content;
        $certificateTemplate->type = $request->course_type;
        $certificateTemplate->qr_width =  $request->qr_width;
        $certificateTemplate->qr_height =  $request->qr_height;
        $certificateTemplate->status = 1;

        if ($request->hasFile('bg_image')) {
            $image = $request->file('bg_image');
            $name = time() . '-'. $image->getClientOriginalName() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path() . '/storage/uploads/certificate_templates/';
            $image->move($destinationPath, $name);
            $certificateTemplate->bg_image = $name;
        }

        $certificateTemplate->save();

        return redirect()->route('admin.certificates.templates.index')->withFlashSuccess('success', 'Certificate Template created successfully.');
    }
    public function edit($id)
    {
        $cert_template = CertificateTemplates::findOrFail($id);
        $courseTypes = Type::orderBy('created_at', 'desc')->where('status', 1)->pluck('name', 'id');
        return view('backend.certificates.templates.edit', compact('cert_template', 'courseTypes'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'title_ar' => 'required',
            'template_content' => 'required',
            'course_type' => 'required',
        ]);

        $certificateTemplate = CertificateTemplates::findOrFail($request->template_id);
        $certificateTemplate->title = $request->title;
        $certificateTemplate->title_ar = $request->title_ar;
        $content = $request->template_content;
        $certificateTemplate->content = $content;
        $certificateTemplate->type = $request->course_type;
        $certificateTemplate->qr_width =  $request->qr_width;
        $certificateTemplate->qr_height =  $request->qr_height;
        $certificateTemplate->status = 1;

        if ($request->hasFile('bg_image')) {
            $image = $request->file('bg_image');
            $name = time() . '-'. $image->getClientOriginalName() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path() . '/storage/uploads/certificate_templates/';
            $image->move($destinationPath, $name);
            $certificateTemplate->bg_image = $name;
        }

        $certificateTemplate->save();
        return redirect()->route('admin.certificates.templates.index')->withFlashSuccess('success', 'Certificate Template updated successfully.');
    }

    private function convert_empty_paragraphs_to_br($html) {
        $dom = new DOMDocument('1.0', 'UTF-8');
        // Suppress errors due to malformed HTML
        @$dom->loadHTML(mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8'), LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

        $xpath = new DOMXPath($dom);
        $paragraphs = $xpath->query('//p');

        foreach ($paragraphs as $p) {
            $nodeValue = trim($p->nodeValue);
            $containsNbsp = strpos($nodeValue, "\xC2\xA0") !== false;

            if ($nodeValue === '' || $containsNbsp) {
                // If the paragraph is truly empty or only contains non-breaking spaces, replace with <br>
                if ($p->childNodes->length === 0 || ($p->childNodes->length === 1 && $p->childNodes->item(0)->nodeValue === "\xC2\xA0")) {
                    $br = $dom->createElement('br');
                    $p->parentNode->replaceChild($br, $p);
                }
            }
        }

        return $dom->saveHTML();
    }

    public function view(CertificateTemplates $template, Certificate $certificate)
    {
        $group = CourseGroup::findOrFail($certificate->group_id);
        $parameters['type'] = $template->type;
        $parameters['image'] = $template->bg_image;
        $parameters['code'] = $template->content;
        $parameters['cert'] = $certificate;
        $parameters['qr_width'] = $template->qr_width;
        $parameters['qr_height'] = $template->qr_height;
        $parameters['code_print'] = $template->content;
        $parameters['group'] = $group;

        $html = $this->htmlGenerator($parameters);
//        $html = mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8');
//
//                $arabic = new Arabic();
//                $p = $arabic->arIdentify($html);
//                for ($i = count($p)-1; $i >= 0; $i-=2) {
//                    $utf8ar = $arabic->utf8Glyphs(substr($html, $p[$i-1], $p[$i] - $p[$i-1]));
//                    $html = substr_replace($html, $utf8ar, $p[$i-1], $p[$i] - $p[$i-1]);
//                }

        $pdf = PDF::loadHTML($html);
        $pdf->setOptions(['dpi' => 250, 'defaultFont' => 'Cairo' ]);
        $pdf->setPaper('A4', 'landscape');
        $filename = 'كل الشهادات' . time() . '.pdf';
        return $pdf->stream($filename);
    }
    private function htmlGenerator($parameters)
    {
       return view('backend.certificates.templates.view',$parameters);
    }
}