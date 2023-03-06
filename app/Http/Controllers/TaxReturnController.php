<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TaxReturnPdf;
use App\Models\TaxReturns;
use App\Models\Company;
use App\Models\User;
use Auth;
use PDF;

class TaxReturnController extends Controller
{
    public $taxYears = [];
    //
        // public function create_tax_returns(Request $req){
    //     $tax_returns = new TaxReturns();

    //     if( !empty($req->input('tax_end'))){
    //         $tax_returns->user_id = Auth::user()->id; 
    //         $tax_returns->company_id = $req->input('company_id');
    //         $tax_returns->tax_end = $req->input('tax_end');
           
    //         if($tax_returns->save()){
    //             return response()->json(['code' => 200, 'msg' => $tax_returns->id]);
    //         }
    //         return response()->json(['code' => 400, 'msg' => 'error']);
    //     }
    //     return response()->json(['code' => 400, 'msg' => 'error']);
    // }

    public function create_tax_returns(Request $req){
        $url = url()->previous();
        $tax_returns = new TaxReturns();

        $file = $req->file('file');

        if($file){
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file-> move(public_path('storage/public/Files'), $filename);
            $tax_returns['file_path'] = asset('storage/public/Files/'.$filename);
        }elseif($req->input('file_link')){
            $tax_returns->file_path = $req->input('file_link');
        }

        $tax_returns->user_id = Auth::user()->id; 
        $tax_returns->company_id = $req->input('company_id');
        $tax_returns->tax_end = $req->input('tax_end');
        $tax_returns->tax_start = $req->input('start_date');
        $tax_returns->due_date = $req->input('due_date');
        $tax_returns->status = $req->input('status');
        $tax_returns->company_status = $req->input('company_status');
        $tax_returns->tax_return_type = $req->input('tax_return_type');
        
        if($tax_returns->save()){

            $generate_file_link = $req->file('filing_extension');

            $TaxReturnPdf = new TaxReturnPdf();

            if($generate_file_link){
                $filename = date('YmdHi').$generate_file_link->getClientOriginalName();
                $generate_file_link->move(public_path('storage/public/PDF'), $filename);
                $TaxReturnPdf['path'] = asset('storage/public/PDF/'.$filename);
            }elseif($req->input('generate_file')){
                $TaxReturnPdf->path = $req->input('generate_file');
                $tax_year = substr($tax_returns->tax_end,0,4);
                $fileName = urldecode(str_replace(' ', '-', $req->input('company_name')).'-7004-extension-'.$tax_year);
                $i = 1;
                while(file_exists(public_path('uploads/company/'.$fileName . '.pdf'))) {
                    $fileName = urldecode(str_replace(' ', '-', $req->input('company_name')).'-7004-extension-'.$tax_year) . '-' . $i;
                    $i++;
                }
                $fileName = $fileName . '.pdf' ;
                $file_url = $req->input('generate_file');

                $data = file_get_contents($file_url);
                $data = str_replace('Title (Form 7004 )', 'Title (7004 Filing Extension-' . $tax_year . ')', $data);
                if(!file_exists(public_path('uploads'))) {
                    mkdir(public_path('uploads'));
                }
                if(!file_exists(public_path('uploads/company'))) {
                    mkdir(public_path('uploads/company'));
                }
                fopen(public_path('uploads/company/'.$fileName), 'w');
                file_put_contents(public_path('uploads/company/'.$fileName), $data);
                $TaxReturnPdf->path = asset('uploads/company/'.$fileName);

            }elseif($req->input('filing_extension_link')){
                $TaxReturnPdf->path = $req->input('filing_extension_link');
            }

            $TaxReturnPdf->user_id = Auth::user()->id; 
            $TaxReturnPdf->company_id = $req->input('company_id');
            $TaxReturnPdf->tax_return_id = $tax_returns->id;
            $TaxReturnPdf->year = substr($req->input('tax_end'),0,4);
            $TaxReturnPdf->save();

            return redirect()->to($url)->with('success',  'Tax Returns Creades');
        } 
        return redirect()->to($url)->with('danger',  'Tax Returns is not created');
    }

    public function delete_tax_returns ($id){
        $url = url()->previous();
        $data = TaxReturns::find($id);
        if(empty($data)){
            return redirect()->to($url)->with('danger',  'Tax Returns is not deleted');
        }
        if( $data->delete()){
            return redirect()->to($url)->with('success',  'Tax Returns is deleted');
        }
       
    }

    public function tax_returns_by_url($url, $id){
        $user_id = Auth::user()->id;

        $company = Company::find($id);

        $incorporationTime = $company->incorporation_date;
        $incorporationYear = date('Y', strtotime($incorporationTime));
        $all_tax_years = TaxReturns::where('company_id', $id)->get(['tax_end'])->toArray();
        $this->get_tax_years($company, $incorporationYear, $all_tax_years);


        $tax_status = ['1' => 'Not Filed', '2' => 'Filed'];
        $tax_company_status = [
            '1' => 'Dormant (never traded)',
            '2' => 'Non trading (but traded before)',
            '3' => 'Trading',
            '4' => 'Disregarded Entity',
        ];
        $tax_return_type = [
            '1' => '1120 (Corporation)',
            '2' => '1120 (Foreign Disregarded Entity)',
            '3' => '1065 (Partnership)',
        ];

        return view('user.tax_returns.tax_returns', [
            'tax_returns' => TaxReturns::where('user_id', $user_id)->where($url."_id", $id)->with('company')->with('pdfFile')->get(),
            'url' => $url,
            'id' => $id,
            'tax_years' => $this->taxYears,
            'company' => $company,
            'tax_status' => $tax_status,
            'tax_company_status' => $tax_company_status,
            'tax_return_type' => $tax_return_type,
            'page_title' => $company->name
        ]);
    }

    public function edit_tax_returns(Request $req){
        
        $tax_id = $req->input('tax_id');
        $tax_returns = TaxReturns::find($tax_id);
        $tax_returns->user_id = Auth::user()->id;
        $file = $req->file('file');

        if($file){
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file-> move(public_path('storage/public/Files'), $filename);
            $tax_returns['file_path'] = asset('storage/public/Files/'.$filename);
        }elseif($req->input('file_link')){
            $tax_returns->file_path = $req->input('file_link');
        }

        $tax_returns->due_date = $req->input('due_date');
        $tax_returns->status = $req->input('status');
        $tax_returns->company_status = $req->input('company_status');
        $tax_returns->tax_return_type = $req->input('tax_return_type');

        $generate_file_link = $req->file('filing_extension');
       
        $TaxReturnPdf = TaxReturnPdf::where('tax_return_id', '=', $tax_id)->get()->first();

        if(empty($TaxReturnPdf )){
            $TaxReturnPdf = new TaxReturnPdf();

            if($generate_file_link){
                $filename = date('YmdHi').$generate_file_link->getClientOriginalName();
                $generate_file_link->move(public_path('storage/'), $filename);
                $TaxReturnPdf['path'] = asset('storage/'.$filename);
            }elseif($req->input('generate_file')){
                $tax_year = substr($tax_returns->tax_end,0,4);
                $fileName = urldecode(str_replace(' ', '-', $req->input('company_name')).'-7004-extension-'.$tax_year);
                $i = 1;
                while(file_exists(public_path('uploads/company/'.$fileName . '.pdf'))) {
                    $fileName = urldecode(str_replace(' ', '-', $req->input('company_name')).'-7004-extension-'.$tax_year) . '-' . $i;
                    $i++;
                }
                $fileName = $fileName . '.pdf' ;
                $file_url = $req->input('generate_file');

                $data = file_get_contents($file_url);
                $data = str_replace('Title (Form 7004 )', 'Title (7004 Filing Extension-' . $tax_year . ')', $data);
                if(!file_exists(public_path('uploads'))) {
                    mkdir(public_path('uploads'));
                }
                if(!file_exists(public_path('uploads/company'))) {
                    mkdir(public_path('uploads/company'));
                }
                fopen(public_path('uploads/company/'.$fileName), 'w');
                file_put_contents(public_path('uploads/company/'.$fileName), $data);
                $TaxReturnPdf->path = asset('uploads/company/'.$fileName);
            }elseif($req->input('filing_extension_link')){
                $TaxReturnPdf->path = $req->input('filing_extension_link');
            }
            $TaxReturnPdf->user_id = Auth::user()->id; 
            $TaxReturnPdf->company_id = $tax_returns->company_id;
            $TaxReturnPdf->tax_return_id = $tax_id;
            $TaxReturnPdf->year =substr($tax_returns->tax_end,0,4);
           
        }else{
            if($generate_file_link){
                $filename = date('YmdHi').$generate_file_link->getClientOriginalName();
                $generate_file_link->move(public_path('storage/'), $filename);
                $TaxReturnPdf['path'] = asset('storage/'.$filename);
            }elseif($req->input('generate_file')){
                $tax_year = substr($tax_returns->tax_end,0,4);
                $fileName = urldecode(str_replace(' ', '-', $req->input('company_name')).'-7004-extension-'.$tax_year);
                $i = 1;
                while(file_exists(public_path('uploads/company/'.$fileName . '.pdf'))) {
                    $fileName = urldecode(str_replace(' ', '-', $req->input('company_name')).'-7004-extension-'.$tax_year) . '-' . $i;
                    $i++;
                }
                $fileName = $fileName . '.pdf' ;
                $file_url = $req->input('generate_file');

                $data = file_get_contents($file_url);
                $data = str_replace('Title (Form 7004 )', 'Title (7004 Filing Extension-' . $tax_year . ')', $data);
                if(!file_exists(public_path('uploads'))) {
                    mkdir(public_path('uploads'));
                }
                if(!file_exists(public_path('uploads/company'))) {
                    mkdir(public_path('uploads/company'));
                }
                fopen(public_path('uploads/company/'.$fileName), 'w');
                file_put_contents(public_path('uploads/company/'.$fileName), $data);
                $TaxReturnPdf->path = asset('uploads/company/'.$fileName);
            }elseif($req->input('filing_extension_link')){
                $TaxReturnPdf->path = $req->input('filing_extension_link');
            }
        }

        $TaxReturnPdf->save();
        
        $url = url()->previous();
        if($tax_returns->save()){
            return redirect()->to($url)->with('success',  'Tax Returns Edited');
        } 
        return redirect()->to($url)->with('danger',  'Tax Returns is not Edited');

    }

    public function get_tax_years($company, $year, $all_tax_years)
    {
        $month = $company->month;
        $day = $company->day;
        // dd([$month, $day]);
        if(!$month || !$day || !$company->incorporation_date){
            return $this->taxYears = "wrong";
        }
        $month = $month < 10 ? "0$month" : $month;
        $day = $day < 10 ? "0$day" : $day;
        $taxDate = strtotime("$year-$month-$day");
        $flag = 1;

        foreach ($all_tax_years as $all_tax_year){
            if("$year-$month-$day" == $all_tax_year['tax_end']){
                $flag = 0;
            }
        }

        if($taxDate < time() && $taxDate > strtotime($company->incorporation_date) && $flag) {
            $this->taxYears[] = date('Y-m-d', $taxDate);
            $year = $year + 1;
            return $this->get_tax_years($company, $year, $all_tax_years);
        }elseif(($year + 1) < date('Y')) {
            $year = $year + 1;
            return $this->get_tax_years($company, $year, $all_tax_years);
        }
        return;
    }
}
