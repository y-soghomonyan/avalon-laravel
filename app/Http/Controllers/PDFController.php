<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CompanyFile;
use App\Models\Company;
use DateTime;
use Auth;
use DB;
use PDF;


/* 
    in terminal : composer require barryvdh/laravel-dompdf
    in config/app.php : 
    'providers' => [
    Barryvdh\DomPDF\ServiceProvider::class,
    ],

    'aliases' => [
    'PDF' => Barryvdh\DomPDF\Facade::class,
    ],
*/

class PDFController extends Controller
{
    public $apy_key = 'forpdf2@avalon.enterprises_078caad8ce34cc199f2c8e36688f87ff30f30c9f139f43c865d107815a82bacddfdabbb0';
    public function pdfview(Request $req)
    {
       
        // $company_id = $req->input('company_id');
        $tax_date = '2020-01-21';// $req->input('date');
        // $tax_type= $req->input('tax_return_type');
        
        // $company = Company::where('id', '=', $company_id)->get()->first()->toArray();
        $company = Company::where('id', '=', 14)->get()->first()->toArray();
        $company['tax_return_type'] = 1;//$tax_type;
        $company['tax_date'] = $tax_date;
        $company_name = $company['name'];
        
        view()->share('company',$company);
        
        $pdf = PDF::loadView('pdfview');

        $path = public_path('/storage/public/Files/');
        $fileName = $company_name.'-'.substr($tax_date,0,4).'.pdf' ;
        
        $CompanyFile = new CompanyFile;
        $CompanyFile->user_id = Auth::user()->id; 
        $CompanyFile->company_id = 14;
        $CompanyFile->file_type = 'form_7004';
        $CompanyFile->path = asset('storage/public/Files/'.$fileName);
        

        // if($pdf->save($path . '/' . $fileName) && $CompanyFile->save()){
        //     return response()->json(['code' => 200, 'msg' => asset('storage/public/Files/'.$fileName)]);
        // }
        // return response()->json(['code' => 400, 'msg' => 'error']);

// Storage::put('public/pdf/invoice.pdf', $pdf->output());


        // return $pdf->download('pdfview.pdf');
        
        return view('pdfview');
    }

   

    public function pdf2 (){


        $url = "https://api.pdf.co/v1/pdf/info/fields";
        // $url = "https://api.pdf.co/v1/pdf/edit/delete-text";
        // $url = "https://api.pdf.co/v1/pdf/edit/add";


        // See documentation: https://apidocs.pdf.co
        $parameters = array();

        $parameters["url"] = 'https://avalon.enterprises/public/public/f7004.pdf';
        $parameters['info']["Title"] = "Company 1";
        $parameters['Title'] = "Companytest";
        $parameters['name'] = "Companytest";
        $parameters["async"] = false;

        $annotations =   '[]';// JSON string


        $annotationsArray = json_decode($annotations, true);

        $info = '[{
            "Title": "test"
        }]';

         $infoa = json_decode( $info, true);

        // $parameters["annotations"] = $annotationsArray;
        $parameters["info"] = $infoa;


        // $parameters["earchString"] = "▶ Go to www.irs.gov/Form7004 for instructions and the latest information";

        // $parameters["replaceString"] = "XYZ LLC";




        // Create Json payload
        $data = json_encode($parameters);

        // Create request
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("x-api-key: " . $this->apy_key, "Content-type: application/json"));
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

        // Execute request
        $result = curl_exec($curl);
        $json = json_decode($result, true);
        echo "<pre>";
        print_r($json);
        die;




        if (curl_errno($curl) == 0)
        {
            $status_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            
            if ($status_code == 200)
            {
                $json = json_decode($result, true);
                
                if ($json["error"] == false)
                {
                    $resultFileUrl = $json["url"];
                    
                    // Display link to the file with conversion results
                    echo "<div><h2>Result:</h2><a href='" . $resultFileUrl . "' target='_blank'>" . $resultFileUrl . "</a></div>";
                }
                else
                {
                    // Display service reported error
                    echo "<p>Error: " . $json["message"] . "</p>"; 
                }
            }
            else
            {
                // Display request error
                echo "<p>Status code: " . $status_code . "</p>"; 
                echo "<p>" . $result . "</p>";
            }
        }
        else
        {
            // Display CURL error
            echo "Error: " . curl_error($curl);
        }

        // Cleanup
        curl_close($curl);

    }


    public function edit_date($date){
        $url = "https://api.pdf.co/v1/pdf/edit/replace-text";
        $parameters["url"] = 'https://avalon.enterprises/public/public/f7004_1.pdf';

        $parameters["searchString"] = "(Rev. December 2018)";
        $parameters["replaceString"] = $date;

        $data = json_encode($parameters);

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("x-api-key: " . $this->apy_key, "Content-type: application/json"));
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        $result = curl_exec($curl);
        $json = json_decode($result, true);

        if (curl_errno($curl) == 0){
            $status_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            
            if ($status_code == 200) {
                $json = json_decode($result, true);
                $resultFileUrl = $json["url"];
                if ($json["error"] == false && $resultFileUrl){
                   
                    return  $resultFileUrl;;
                }
                else{
                    return  $json["message"];
                }
            }
            else{
                return $result ;
            }
        }
        else{
            return curl_error($curl);
        }
      
        curl_close($curl);

    }


    public function edit_pdf(Request $req){

      
        $tax_end = $req->input('tax_end');
        $tax_start = $req->input('tax_start');
        $tax_type= $req->input('tax_return_type');
        $company_id = $req->input('company_id');
        
        $company = Company::where('id', '=', $company_id)->get()->first()->toArray();
        $company['tax_return_type'] = 1;
        $company_name = $company['name'];
        $addresses = $company['address1']. " " .$company['address2'];
        $address_full = $company['city']." ".$company['correspondence_state']." ".$company['zip'];

        $value1 = 0;
        $value2 = 0;

        if($company['tax_return_type'] == 1 || $company['tax_return_type'] == 3){
            $value1 = 1;
            $value2 = 2;
        }
        if($company['company_id'] == 4){
            $value1 = 0;
            $value2 = 9;
        }


        $newtime =  date('Y-m-d', time());

        $date = new DateTime($newtime); 
        $date->modify("-1 year");
        $nt =  $date->format("Y-m-d");
        $date = new DateTime($nt);
        
        $testDate = $date->getTimestamp();
        $date = new DateTime($tax_start);
        $testStart = $date->getTimestamp();

        $newcompany = '';
        if($testDate < $testStart ){

            // $newcompany = 'True';
        }
        
     


        $url = "https://api.pdf.co/v1/pdf/edit/add";
        $parameters = array();

        $param_url = $this->edit_date(substr($tax_end,0,4));

        $parameters["url"] = $param_url;



        $fields = '[{
            "fieldName": "topmostSubform[0].Page1[0].f1_01[0]",
            "pages": "0-",
            
            "text": "'.$company_name.'"
        },
        {
            "fieldName": "topmostSubform[0].Page1[0].f1_02[0]",
            "pages": "0-",
            
            "text": "'.$company['tax_id'].'"
        },
        {
            "fieldName": "topmostSubform[0].Page1[0].f1_03[0]",
            "pages": "0-",
            
            "text": "'. $addresses .'"
        },
        {
            "fieldName": "topmostSubform[0].Page1[0].f1_04[0]",
            "pages": "0-",
            
            "text": "'.$address_full.'"
        },
        {
            "fieldName": "topmostSubform[0].Page1[0].f1_05[0]",
            "pages": "0-",
            
            "text": "'.$value1.'"
        },
        {
            "fieldName": "topmostSubform[0].Page1[0].f1_06[0]",
            "pages": "0-",
            
            "text": "'.$value2.'"
        },
        {
            "fieldName": "topmostSubform[0].Page1[0].f1_07[0]",
            "pages": "0-",
            
            "text": "'.substr($tax_end,2,4).'"
        },
        {
            "fieldName": "topmostSubform[0].Page1[0].f1_08[0]",
            "pages": "0-",
            
            "text": "'.substr($tax_start,5).'"
        },
        {
            "fieldName": "topmostSubform[0].Page1[0].f1_09[0]",
            "pages": "0-",
            
            "text": "'.substr($tax_start,2,4).'"
        },
        {
            "fieldName": "topmostSubform[0].Page1[0].f1_10[0]",
            "pages": "0-",
            
            "text": "'.substr($tax_end,5).'"
        },
        {
            "fieldName": "topmostSubform[0].Page1[0].f1_11[0]",
            "pages": "0-",
            
            "text": "'.substr($tax_end,2,4).'"
        },

        {
            "fieldName": "topmostSubform[0].Page1[0].f1_12[0]",
            "pages": "0-",
            
            "text": ""
        },

        {
            "fieldName": "topmostSubform[0].Page1[0].f1_13[0]",
            "pages": "0-",
            
            "text": ""
        },

        {
            "fieldName": "topmostSubform[0].Page1[0].f1_14[0]",
            "pages": "0-",
            
            "text": ""
        },

        {
            "fieldName": "topmostSubform[0].Page1[0].f1_15[0]",
            "pages": "0-",
            
            "text": ""
        },

        {
            "fieldName": "topmostSubform[0].Page1[0].f1_16[0]",
            "pages": "0-",
            
            "text": ""
        },

        {
            "fieldName": "topmostSubform[0].Page1[0].f1_17[0]",
            "pages": "0-",
            
            "text": ""
        },


        {
            "fieldName": "topmostSubform[0].Page1[0].c1_1[0]",
            "pages": "0-",
            
            "value":"True" 
        },
        
        {
            "fieldName": "topmostSubform[0].Page1[0].c1_2[0]",
            "pages": "0-",
            
            "value":"True" 
        },
        {
            "fieldName": "topmostSubform[0].Page1[0].c1_3[0]",
            "pages": "0-",
            
            "value":"True" 
        },
        {
            "fieldName": "topmostSubform[0].Page1[0].c1_4[0]",
            "pages": "0-",
            "text": "'.$newcompany.'",
            "value":"True" 
        },
        {
            "fieldName": "topmostSubform[0].Page1[0].c1_4[1]",
            "pages": "0-",
            
            "value":"True" 
        },
        {
            "fieldName": "topmostSubform[0].Page1[0].c1_4[2]",
            "pages": "0-",
            "text": "",
            "value":"1" 
        },
        {
            "fieldName": "topmostSubform[0].Page1[0].c1_4[3]",
            "pages": "0-",
            
            "value":"True" 
        },
        {
            "fieldName": "topmostSubform[0].Page1[0].c1_4[4]",
            "pages": "0-",
            
            "value":"true" 
        }]';
        
        $fieldsArray = json_decode($fields, true);
        
        $parameters["fields"] = $fieldsArray;
        

        $data = json_encode($parameters);
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("x-api-key: " . $this->apy_key, "Content-type: application/json"));
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

        $result = curl_exec($curl);
        $json = json_decode($result, true);

        if (curl_errno($curl) == 0){
            $status_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            
            if ($status_code == 200) {
                $json = json_decode($result, true);
                $resultFileUrl = $json["url"];

                if ($json["error"] == false && $resultFileUrl){
                    return response()->json(['code' => 200, 'msg' => $resultFileUrl]);
                }
                else{
                    return  $json["message"];
                }
            }
            else{
                return $result ;
            }
        }
        else{
            return curl_error($curl);
        }
        curl_close($curl);


    }




    public function create_pdf(){

        



        $fields =  [
            [
            "fieldName"=> "topmostSubform[0].Page1[0].FilingStatus[0].c1_01[1]",
            "pages"=> "1",
            "text"=> "True"
            ],
            [
            "fieldName"=> "topmostSubform[0].Page1[0].f1_02[0]",
            "pages"=> "1",
            "text"=> "John A."
            ],
            [
            "fieldName"=> "topmostSubform[0].Page1[0].f1_03[0]",
            "pages"=> "1",
            "text"=> "Doe"
            ],
            [
            "fieldName"=> "topmostSubform[0].Page1[0].YourSocial_ReadOrderControl[0].f1_04[0]",
            "pages"=> "1",
            "text"=> "123456789"
            ],
            [
            "fieldName"=> "topmostSubform[0].Page1[0].YourSocial_ReadOrderControl[0].f1_05[0]",
            "pages"=> "1",
            "text"=> "Joan B."
            ],
            [
            "fieldName"=> "topmostSubform[0].Page1[0].YourSocial_ReadOrderControl[0].f1_05[0]",
            "pages"=> "1",
            "text"=> "Joan B."
            ],
            [
            "fieldName"=> "topmostSubform[0].Page1[0].YourSocial_ReadOrderControl[0].f1_06[0]",
            "pages"=> "1",
            "text"=> "Doe"
            ],
            [
            "fieldName"=> "topmostSubform[0].Page1[0].YourSocial_ReadOrderControl[0].f1_07[0]",
            "pages"=> "1",
            "text"=> "987654321"
            ]
            
        ];
        
        
        
        // $curl = curl_init();
        
        // curl_setopt_array($curl, array(
        // 		CURLOPT_URL => "https://api.pdf.co/v1/file/upload/get-presigned-url",
        // 		CURLOPT_RETURNTRANSFER => true,
        // 		CURLOPT_ENCODING => "",
        // 		CURLOPT_MAXREDIRS => 10,
        // 		CURLOPT_TIMEOUT => 0,
        // 		CURLOPT_FOLLOWLOCATION => true,
        // 		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        // 		CURLOPT_CUSTOMREQUEST => "PUT",
        // 		CURLOPT_POSTFIELDS => $fields,
        // 		CURLOPT_HTTPHEADER => array(
        // 				"x-api-key: {{forpdf@avalon.enterprises_ff49ee05a3e0776afcd508acebd1b3c1c9cc47fd5090c0fa2064474a5c74ca2fff7f4c59}}"
        // 		),
        // ));
        
        // $response = curl_exec($curl);
        
        // curl_close($curl);
        // echo $response;
        
        
                // $url = 'https://api.pdf.co/v1/pdf/edit/add';
                // $curl = curl_init();
                // $headers = [
                  
                //     'Content-Type: application/json',
                //     'x-api-key: forpdf@avalon.enterprises_ff49ee05a3e0776afcd508acebd1b3c1c9cc47fd5090c0fa2064474a5c74ca2fff7f4c59' 
                // ];
                
                // curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
             
                
                // $fields_string = http_build_query($fields);
        
             
                // curl_setopt($curl, CURLOPT_URL, $url);
                // curl_setopt($curl, CURLOPT_POST, TRUE);
                // curl_setopt($curl, CURLOPT_POSTFIELDS, $fields_string);
                // $data = curl_exec($curl);
        
                // dump($data);
                // curl_close($curl);
        
        
        
            //     $url = "https://api.pdf.co/v1/file/upload/get-presigned-url" . 
            // "?name=" . "dfdfgdfg" .
            // "&contenttype=application/octet-stream";
            
            //     // Create request
            //     $curl = curl_init();
            //     curl_setopt($curl, CURLOPT_HTTPHEADER, array("x-api-key: " . $apy_key));
            //     curl_setopt($curl, CURLOPT_URL, $url);
            //     curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            //     // Execute request
            //     $result = curl_exec($curl);
        
        
        
        
        
                
        
                $url = "https://api.pdf.co/v1/pdf/edit/add";
        
        // Prepare requests params
        // See documentation: https://apidocs.pdf.co
        $parameters = array();
        
        // Direct URL of source PDF file.
        $parameters["url"] = "bytescout-com.s3-us-west-2.amazonaws.com/files/demo-files/cloud-api/pdf-form/f1040.pdf";
        
        // Name of resulting file
        $parameters["name"] = "f1040-form-filled";
        
        // If large input document, process in async mode by passing true
        $parameters["async"] = false;
        
        // Field Strings
        $fields =   '[{
            "fieldName": "topmostSubform[0].Page1[0].FilingStatus[0].c1_01[1]",
            "pages": "1",
            "text": "True"
        },
        {
            "fieldName": "topmostSubform[0].Page1[0].f1_02[0]",
            "pages": "1",
            "text": "John A."
        },        
        {
            "fieldName": "topmostSubform[0].Page1[0].f1_03[0]",
            "pages": "1",
            "text": "Doe"
        },        
        {
            "fieldName": "topmostSubform[0].Page1[0].YourSocial_ReadOrderControl[0].f1_04[0]",
            "pages": "1",
            "text": "123456789"
        },
        {
            "fieldName": "topmostSubform[0].Page1[0].YourSocial_ReadOrderControl[0].f1_05[0]",
            "pages": "1",
            "text": "Joan B."
        },
        {
            "fieldName": "topmostSubform[0].Page1[0].YourSocial_ReadOrderControl[0].f1_05[0]",
            "pages": "1",
            "text": "Joan B."
        },
        {
            "fieldName": "topmostSubform[0].Page1[0].YourSocial_ReadOrderControl[0].f1_06[0]",
            "pages": "1",
            "text": "Doe"
        },
        {
            "fieldName": "topmostSubform[0].Page1[0].YourSocial_ReadOrderControl[0].f1_07[0]",
            "pages": "1",
            "text": "987654321"
        }]';// JSON string
        
        // Convert JSON string to Array
        $fieldsArray = json_decode($fields, true);
        
        $parameters["fields"] = $fieldsArray;
        
        // Create Json payload
        $data = json_encode($parameters);
        
        // Create request
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("x-api-key: " . $this->apy_key, "Content-type: application/json"));
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        
        // Execute request
        $result = curl_exec($curl);
        
        if (curl_errno($curl) == 0)
        {
            $status_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            
            if ($status_code == 200)
            {
                $json = json_decode($result, true);
                
                if ($json["error"] == false)
                {
                    $resultFileUrl = $json["url"];
                    
                    // Display link to the file with conversion results
                    echo "<div><h2>Result:</h2><a href='" . $resultFileUrl . "' target='_blank'>" . $resultFileUrl . "</a></div>";
                }
                else
                {
                    // Display service reported error
                    echo "<p>Error: " . $json["message"] . "</p>"; 
                }
            }
            else
            {
                // Display request error
                echo "<p>Status code: " . $status_code . "</p>"; 
                echo "<p>" . $result . "</p>";
            }
        }
        else
        {
            // Display CURL error
            echo "Error: " . curl_error($curl);
        }
        
        // Cleanup
        curl_close($curl);
        
        
        
        
                dd($result);
        
                
        
            }
        
}

