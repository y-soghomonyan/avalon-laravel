<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CorporateAppointment;
use App\Models\AppointmentsRole;
use App\Models\AccountSendEmail;
use App\Models\AddressProvider;
use App\Models\AddressRelation;
use App\Models\TypeOfCompaneis;
use App\Models\FileReations;
use App\Models\CompanyType;
use App\Models\CompanyFile;
use App\Models\Address;
use App\Models\Account;
use App\Models\Company;
use App\Models\Contact;
use App\Models\Country;
use App\Models\Files;
use App\Models\Notes;
use App\Models\User;
use Auth;


class CompaniesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public $months =  array(
                'January',
                'February',
                'March',
                'April',
                'May',
                'June',
                'July ',
                'August',
                'September',
                'October',
                'November',
                'December',
            );

    public function index()
    {
        $id = Auth::user()->id;
        return view('user.company.index', [
            'company_types' => TypeOfCompaneis::all(),
            'companies' => Company::where('user_id', $id)->get(),
            'countries' => Country::with(['states'])->get(),
            'accounts' => Account::where('user_id', '=', $id)->get(['id', 'name']),
            'contacts' => Contact::where('user_id', '=', $id)->get(['id', 'title']),
            'users' => User::where('id', '!=', Auth::user()->id)->get(['id', 'first_name', 'last_name']),
            'months' => $this->months,
        ]);
    }

    public function companies_by_account($id)
    {
        $user_id = Auth::user()->id;
        return view('user.company.index', [
            'company_types' => TypeOfCompaneis::all(),
            'companies' => Company::where('account_id', $id)->get(),
            'countries' => Country::with(['states'])->get(),
            'accounts' => Account::where('user_id', '=', $user_id)->get(['id', 'name']),
            'contacts' => Contact::where('user_id', '=', $user_id)->get(['id', 'title']),
            'users'=>User::where('id', '!=', Auth::user()->id)->get(['id', 'first_name', 'last_name']),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $company = new Company();
        $company->user_id = Auth::user()->id;
        $company->type = $request->input('type');
        $company->name = $request->input('name');
        $company->status = $request->input('status');
        $company->filing = $request->input('filing');
        $company->state_id = $request->input('state_id');
        $company->division = $request->input('division');
        $company->company_id = $request->input('company_id');
        $company->country_id = $request->input('country_id');
        $company->sub_status = $request->input('sub_status');
        $company->account_id = $request->input('account_id');
        $company->contact_id = $request->input('contact_id');
        $company->filing_status = $request->input('filing_status');
        $company->previous_name1 = $request->input('previous_name1');
        $company->previous_name2 = $request->input('previous_name2');
        $company->previous_name3 = $request->input('previous_name3');
        $company->previous_name4 = $request->input('previous_name4');
        $company->previous_name5 = $request->input('previous_name5');
        $company->incorporation_date = $request->input('incorporation_date');
        $company->registration_status = $request->input('registration_status');
        $company->tax_id_type = $request->input('tax_id_type');
        $company->tax_id = $request->input('tax_id');
        $company->tax_filing_code = $request->input('tax_filing_code');
        $company->status_date = $request->input('status_date');
        $company->month = $request->input('month');
        $company->day = $request->input('day');

        if($company->save()){

            $fale_paths = ['file_path_1','file_path_2','file_path_3','file_path_4'];

            // foreach($fale_paths as $fale_path){
            //     if( !empty($request->input($fale_path))){
            //         $CompanyFile = new CompanyFile;
            //         $CompanyFile->user_id = Auth::user()->id; 
            //         $CompanyFile->company_id = $company->id;
            //         $CompanyFile->file_type = $fale_path;
            //         $CompanyFile->path = $request->input($fale_path);
            //         $CompanyFile->save();
            //     }
            // }

            $finalArray = array();
            foreach($fale_paths as $fale_path){
                if( !empty($request->input($fale_path))){
                    array_push($finalArray, array(
                        'user_id' => Auth::user()->id, 
                        'company_id' => $company->id,
                        'file_type' => $fale_path,
                        'path' => $request->input($fale_path),
                        'created_at' =>date('Y-m-d H:i:s', time()),
                        'updated_at' =>date('Y-m-d H:i:s', time()),
                    ));
                }
            }

            CompanyFile::insert($finalArray);
    
            // $files_type = ['file_1', 'file_2', 'file_3', 'file_4'];
            // foreach($files_type as $file_type){
            //     if(session($file_type)){
            //         $CompanyFile = CompanyFile::find(session($file_type));
            //         $CompanyFile->company_id = $company->id;
            //         $CompanyFile->save();
            //         session()->put($file_type,  0);
            //     }
            // }
            return redirect()->route('companies')->with('success', $request->input('name').' - Added');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $company = Company::find($id);

        if(empty($company)){
            return redirect()->route('companies')->with('danger', "Not Found");
        }
        $notifications = new NotificationController;
        return view('user.company.edit', [
            'company' => $company,
            'company_types' => TypeOfCompaneis::all(),
            'countries' => Country::with(['states'])->get(),
            'accounts' => Account::where('user_id', '=', Auth::user()->id)->get(['id', 'name']),
            'contacts' => Contact::where('user_id', '=', Auth::user()->id)->get(['id', 'title']),
            'users'=>User::where('id', '!=', Auth::user()->id)->get(['id', 'email', 'first_name', 'last_name']),
            'companies' =>Company::where('user_id', '=', Auth::user()->id)->get(['id', 'name']),
            'companies_count' => Company::where('user_id', '=', Auth::user()->id)->get(['id', 'name']),
            'contacts_count' => Contact::where('user_id', '=', Auth::user()->id)->get(['id', 'title']),
            'emails' => AccountSendEmail::where('user_id', '=', Auth::user()->id)->get(),
            'notifications'=> $notifications->notifications('company_id',$id),
            'upcoming_overdues' => $notifications->UpcomingOverdue('company_id',$id),
            'subject_events' => [1 => 'Call', 2 => 'Email', 3 => 'Meeting', 4 => 'Send Letter/Quote', 5 => 'Other'],
            'subject_tasks' => [1 => 'Call', 2 => 'Send Letter', 3 => 'Send Quote', 4 => 'Other'],
            'subject_calls' => [1 => 'Call', 2 => 'Send Letter', 3 => 'Send Quote', 4 => 'Other'],
            'url' => 'company',
            'id' => $id,
            'page_title' => $company->name,
            'notes' => Notes::where('company_id', '=', $id)->get(),
            'files' => FileReations::where('company_id', '=', $id)->where('status', '=', 1)->with('file')->get(),
            'files_data' => FileReations::where('user_id', '=', Auth::user()->id)->with('file')->get(),
            'corporate_appointments' => CorporateAppointment::where('user_id', '=', Auth::user()->id)->where('company_id', '=', $id)->with('roles')->get(),
            'appointments_roles' => AppointmentsRole::all(),
            'address_providers' => AddressProvider::where('user_id', '=', Auth::user()->id)->get(),
            'addresses' => Address::where('user_id', '=', Auth::user()->id)
            ->with('country')
            ->with('state')
            ->with('addressRelation')
            ->whereHas('addressRelation', function($q) use($id){$q->where('company_id', $id);})->get(),
            'all_addresses' => Address::where('user_id', '=', Auth::user()->id)->with('country')->with('state')->with('addressRelation')->get(),
            'months' => $this->months,
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){

        $company = Company::find($id);

        if(empty($company)){
            return redirect()->route('companies')->with('danger', "Not Found");
        }

        if($company->user_id == Auth::user()->id){
            $company->name = $request->input('name');
            $company->filing = $request->input('filing');
            $company->state_id = $request->input('state_id');
            $company->company_id = $request->input('company_id');
            $company->country_id = $request->input('country_id');
            $company->filing_status = $request->input('filing_status');
            $company->account_id = $request->input('account_id');
            $company->contact_id = $request->input('contact_id');
            $company->type = $request->input('type');
            $company->division = $request->input('division');
            $company->status = $request->input('status');
            $company->sub_status = $request->input('sub_status');
            $company->previous_name1 = $request->input('previous_name1');
            $company->previous_name2 = $request->input('previous_name2');
            $company->previous_name3 = $request->input('previous_name3');
            $company->previous_name4 = $request->input('previous_name4');
            $company->previous_name5 = $request->input('previous_name5');
            $company->incorporation_date = $request->input('incorporation_date');
            $company->registration_status = $request->input('registration_status');
            $company->tax_id_type = $request->input('tax_id_type');
            $company->tax_id = $request->input('tax_id');
            $company->tax_filing_code = $request->input('tax_filing_code');
            $company->status_date = $request->input('status_date');
            $company->month = $request->input('month');
            $company->day = $request->input('day');

            $fale_paths = ['file_path_1','file_path_2','file_path_3','file_path_4'];
           
            foreach($fale_paths as $fale_path){
                if( !empty($request->input($fale_path))){
                    $CompanyFile = new CompanyFile;
                    $CompanyFile->user_id = Auth::user()->id; 
                    $CompanyFile->company_id = $id;
                    $CompanyFile->file_type = $fale_path;
                    $CompanyFile->path = $request->input($fale_path);;
                    $CompanyFile->save();
                }
            }

            if($company->save()){
                return redirect()->route('edit_company', [$id])->with('success', $request->input('name') . ' - Edited');
            }
        }
        return redirect()->route('companies')->with('error', $request->input('name').' - is not your');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        $data = Company::find($id);
        if(empty($data)){
            return redirect()->route('companies')->with('danger', "Not Found");
        }
        if($data->delete()){
            return redirect()->route('companies')->with('success', $data->name.' - Removed');
        }
    }

    public function uploade_file_company(Request $req){

        // $CompanyFile = new CompanyFile;
        $files = new Files;
        $file = $req->file('file');
        $filename = '';
        if($file){
            $files->name = $file->getClientOriginalName();
            $files->size = $file->getSize();
            $files->type = $file->getMimeType();
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file-> move(public_path('storage/public/Files'), $filename);
            $files['path'] = $filename;

            // $CompanyFile->user_id = Auth::user()->id; 
            // $CompanyFile->file_type = $req->input('file_type');
            // $CompanyFile->path = asset('storage/public/Files/'.$filename);


        }else{
            return "NO FILE";
        }

        // $CompanyFile->save();
        $files->save();

        // session()->put($req->input('file_type'),  $files->id);
        return response()->json(['code' => 200, 'msg' => asset('storage/public/Files/'.$filename)]);
    }

    public function update_file_company(Request $req){

        $files = CompanyFile::where('company_id', '=', $req->company_id)->where('file_type', '=', $req->file_type)->get()->first();
      
        if(empty( $files->id)){
            $files = new CompanyFile;
        }

        $file = $req->file('file');
        $filename = '';
        if($file){
            $files->company_id = $req->company_id;
            $files->name = $file->getClientOriginalName();
            $files->size = $file->getSize();
            $files->type = $file->getMimeType();
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file-> move(public_path('storage/public/Files'), $filename);
            $files['path'] = $filename;
            $files->user_id = Auth::user()->id; 
            $files->file_type = $req->file_type;
        
        }else{
            return "NO FILE";
        }

        $files->save();
        return response()->json(['code' => 200, 'msg' => $filename]);
    }
}
